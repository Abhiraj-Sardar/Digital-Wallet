<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #4B4FED;
            min-height: 100vh;
        }

        .extend-btn{
            position: absolute;
            z-index: 1000;
            cursor: pointer;
            background-color:#1B1A39;
            padding:1rem;
        }

        .container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        .sidebar {
            width: 30%;
            background-color: #1B1A39;
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            min-width: 300px;
        }

        .sidebar.collapsed {
            width: 0;
            min-width: 0;
            overflow: hidden;

        }

        .toggle-btn {
            position: absolute;
            right: -40px;
            top: 20px;
            width: 40px;
            height: 40px;
            background: #667eea;
            border: none;
            border-radius: 0 8px 8px 0;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: background 0.3s ease;
            z-index: 100;
        }

        .toggle-btn:hover {
            background: #764ba2;
        }

        .filter-content {
            padding: 20px;
            height: 100vh;
            overflow-y: auto;
        }

        .filter-section {
            margin-bottom: 30px;
        }

        .filter-section h3 {
            color: #fff;
            margin-bottom: 15px;
            font-size: 18px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 5px;
        }

        .filter-group {
            margin-bottom: 20px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: #667eea;
        }

        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-item input[type="checkbox"] {
            width: auto;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: white;
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
        }

        .crypto-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .crypto-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .crypto-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .crypto-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .crypto-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 18px;
        }

        .crypto-info h3 {
            color: #333;
            font-size: 18px;
            margin-bottom: 2px;
        }

        .crypto-info .symbol {
            color: #666;
            font-size: 14px;
            font-weight: 500;
        }

        .crypto-price {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .crypto-change {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .change-percent {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
        }

        .positive {
            background: #e8f5e8;
            color: #2e8b2e;
        }

        .negative {
            background: #ffeaea;
            color: #d32f2f;
        }

        .crypto-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 15px;
        }

        .stat-item {
            text-align: center;
            padding: 8px;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 8px;
        }

        .stat-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 2px;
        }

        .stat-value {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .apply-filters-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .apply-filters-btn:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                min-width: 100%;
            }
            
            .sidebar.collapsed {
                width: 0;
                height: 0;
            }
            
            .crypto-grid {
                grid-template-columns: 1fr;
            }
        }

        .cart{
            position: absolute;
            z-index:1000;
            right: 25px;
        }

        .cart::before{
            position: absolute;
            height:100px;
            width:100px;
            background-color:red;
            content:1;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .receipt {
            background: #f9f7f1;
            width: 320px;
            padding: 30px 20px;
            border-radius: 4px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: slideIn 0.4s ease;
            font-family: 'Courier New', monospace;
        }

        .receipt::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 0;
            right: 0;
            height: 10px;
            background: linear-gradient(90deg, 
                transparent 0%, transparent 45%, 
                #f9f7f1 45%, #f9f7f1 55%, 
                transparent 55%, transparent 100%);
            background-size: 20px 100%;
        }

        .receipt-header {
            text-align: center;
            border-bottom: 2px dashed #999;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .store-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .store-info {
            font-size: 11px;
            color: #666;
            line-height: 1.4;
        }

        .receipt-body {
            margin-bottom: 15px;
        }

        .receipt-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .item-name {
            flex: 1;
        }

        .item-price {
            font-weight: bold;
        }

        .receipt-divider {
            border-top: 1px dashed #999;
            margin: 12px 0;
        }

        .receipt-total {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 2px solid #333;
        }

        .receipt-footer {
            text-align: center;
            font-size: 11px;
            color: #666;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px dashed #999;
        }

        .close-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            transition: background 0.3s ease;
        }

        .close-btn:hover {
            background: #5568d3;
        }

    </style>
</head>
        <?php include "./navbar.php";

        $amt = $_SESSION['amt'];
        $list = array();
        ?>
<body>
    <div class="container">
        <!-- id="ct" -->
        <a class="cart"><i  id="openModal" class="fa-solid fa-cart-shopping" style="color: #FFD43B; font-size:24px;"></i></a>
        
        <div class="extend-btn" id="toggleBtn">
            <i class="fa-solid fa-sliders" style="color: #f7f7f7; font-size:24px;"></i>
        </div>
        <div class="sidebar" id="sidebar">
            <button class="toggle-btn">
                <span id="toggleIcon">‹</span>
            </button>
            
            <div class="filter-content">
                <div class="filter-section">
                    <h3>🔍 Search & Sort</h3>
                    <div class="filter-group">
                        <label for="searchCrypto">Search Cryptocurrency:</label>
                        <input type="text" id="searchCrypto" placeholder="Bitcoin, Ethereum, etc.">
                    </div>
                    <div class="filter-group">
                        <label for="sortBy">Sort By:</label>
                        <select id="sortBy">
                            <option value="rank">Market Cap Rank</option>
                            <option value="price-high">Price (High to Low)</option>
                            <option value="price-low">Price (Low to High)</option>
                            <option value="change-high">24h Change (High to Low)</option>
                            <option value="change-low">24h Change (Low to High)</option>
                        </select>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>💰 Price Range</h3>
                    <div class="filter-group">
                        <label for="minPrice">Min Price ($):</label>
                        <input type="number" id="minPrice" placeholder="0" min="0" step="0.01">
                    </div>
                    <div class="filter-group">
                        <label for="maxPrice">Max Price ($):</label>
                        <input type="number" id="maxPrice" placeholder="100000" min="0" step="0.01">
                    </div>
                </div>

                <div class="filter-section">
                    <h3>📊 Market Cap</h3>
                    <div class="filter-group">
                        <label for="marketCap">Market Cap Category:</label>
                        <select id="marketCap">
                            <option value="all">All Categories</option>
                            <option value="large">Large Cap (>$10B)</option>
                            <option value="mid">Mid Cap ($1B - $10B)</option>
                            <option value="small">Small Cap (<$1B)</option>
                        </select>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>📈 Performance</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="gainers" value="gainers">
                            <label for="gainers">Top Gainers (24h)</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="losers" value="losers">
                            <label for="losers">Top Losers (24h)</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="stable" value="stable">
                            <label for="stable">Stable Coins</label>
                        </div>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>⭐ Categories</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="defi" value="defi">
                            <label for="defi">DeFi</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="nft" value="nft">
                            <label for="nft">NFT</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="gaming" value="gaming">
                            <label for="gaming">Gaming</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="layer1" value="layer1">
                            <label for="layer1">Layer 1</label>
                        </div>
                    </div>
                </div>

                <button class="apply-filters-btn" onclick="applyFilters()">
                    Apply Filters
                </button>
            </div>
        </div>

        <div class="main-content" id="mainContent">
            <div class="header">
                <h1>🚀 Crypto Dashboard</h1>
                <p>Real-time cryptocurrency market data and insights</p>
            </div>

            <div class="crypto-grid" id="cryptoGrid">
                <!-- Crypto cards will be populated by JavaScript -->
                 
            </div>
        </div>
    </div>


     <div class="modal-overlay" id="modalOverlay">
        <div class="receipt">
            <div class="receipt-header">
                <div class="store-name">WELCOME TO CRYPTO STORE</div>
                <div class="store-info">
                    123 Main Street<br>
                    Anytown, ST 12345<br>
                    Tel: (555) 123-4567
                </div>
            </div>

            <div class="receipt-body">
                <div style="font-size: 11px; margin-bottom: 10px;">
                    DATE: 10/23/2025 14:32<br>
                    CASHIER: PayGo<br>
                    RECEIPT #: 0045892
                </div>

                <div class="receipt-divider"></div>

                <div class="receipt-item">
                    <span class="item-name">Total Digital Coins</span>
                    $<span id='tdc' class="item-price">3.50</span>
                </div>

                <div class="receipt-divider"></div>

                <div class="receipt-item">
                    <span class="item-name">Total Bill</span>
                    $<span id='tb' class="item-price">3.50</span>
                </div>
                <!-- <div class="receipt-item">
                    <span class="item-name">Croissant</span>
                    <span class="item-price">$4.25</span>
                </div> -->
                <!-- <div class="receipt-item">
                    <span class="item-name">Orange Juice</span>
                    <span class="item-price">$2.99</span>
                </div>
                <div class="receipt-item">
                    <span class="item-name">Muffin - Blueberry</span>
                    <span class="item-price">$3.75</span>
                </div> -->

                <div class="receipt-divider"></div>

                <div class="receipt-item">
                    <span class="item-name">SUBTOTAL:</span>
                    $<span id='st' class="item-price">3.50</span>
                </div>
                <div class="receipt-item">
                    <span class="item-name">TAX (8%):</span>
                    <span class="item-price">$1.00</span>
                </div>

                <div class="receipt-total">
                    <span>TOTAL:</span>
                    $<span id='gt'>4.66</span>
                </div>

                <div style="margin-top: 15px; font-size: 12px;">
                    PAYMENT METHOD: Online<br>
                    **** **** **** 4532<br>
                    AUTH CODE: 847291
                </div>
            </div>

            <div class="receipt-footer">
                THANK YOU FOR YOUR PURCHASE!<br>
                VISIT US AGAIN SOON<br><br>
                www.cornerstore.com
            </div>

            <center>
                <a><button onClick=submitHandler() class="close-btn" id="closeModal">Buy Now !!!</button></a>
            </center>
        </div>
    </div>

    <?php require "./footer.php";?>


    <script>
        // Sample cryptocurrency data

        function submitHandler(){
            location.href=`../Controller/crypto_payment_handler.php?cnt=${cnt}&tot=${sum}`;
        }

        var cryptoData = [
            {
                name: "Bitcoin",
                symbol: "BTC",
                price: 400.00,
                change: 2.45,
                marketCap: 847000000000,
                volume: 12500000000,
                rank: 1,
                category: "layer1",
                color: "#F7931A"
            },
            {
                name: "Ethereum",
                symbol: "ETH",
                price: 680.50,
                change: -1.23,
                marketCap: 322000000000,
                volume: 8900000000,
                rank: 2,
                category: "layer1",
                color: "#627EEA"
            },
            {
                name: "Tether",
                symbol: "USDT",
                price: 1.00,
                change: 0.01,
                marketCap: 91000000000,
                volume: 15200000000,
                rank: 3,
                category: "stable",
                color: "#26A17B"
            },
            {
                name: "BNB",
                symbol: "BNB",
                price: 315.75,
                change: 3.67,
                marketCap: 47000000000,
                volume: 1200000000,
                rank: 4,
                category: "layer1",
                color: "#F3BA2F"
            },
            {
                name: "Solana",
                symbol: "SOL",
                price: 98.23,
                change: 5.12,
                marketCap: 42000000000,
                volume: 2100000000,
                rank: 5,
                category: "layer1",
                color: "#9945FF"
            },
            {
                name: "XRP",
                symbol: "XRP",
                price: 110.62,
                change: -2.87,
                marketCap: 33000000000,
                volume: 1800000000,
                rank: 6,
                category: "layer1",
                color: "#23292F"
            },
            {
                name: "USDC",
                symbol: "USDC",
                price: 11.00,
                change: 0.00,
                marketCap: 25000000000,
                volume: 4500000000,
                rank: 7,
                category: "stable",
                color: "#2775CA"
            },
            {
                name: "Cardano",
                symbol: "ADA",
                price: 1.485,
                change: 4.23,
                marketCap: 17000000000,
                volume: 890000000,
                rank: 8,
                category: "layer1",
                color: "#0033AD"
            },
            {
                name: "Uniswap",
                symbol: "UNI",
                price: 7.34,
                change: -3.45,
                marketCap: 5500000000,
                volume: 180000000,
                rank: 15,
                category: "defi",
                color: "#FF007A"
            },
            {
                name: "Axie Infinity",
                symbol: "AXS",
                price: 12.67,
                change: 8.92,
                marketCap: 1200000000,
                volume: 95000000,
                rank: 45,
                category: "gaming",
                color: "#0055D4"
            }
        ];

        var price=0;
        var cnt=0;
        var tot=0;
        
        var cartCnt = document.querySelector("#openModal");
        var gt = document.querySelector("#gt");
        var tb = document.querySelector("#tb");
        var st = document.querySelector("#st");
        var tdc = document.querySelector("#tdc");
        
        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            renderCryptoCards(cryptoData);
            setupSidebarToggle();
        });

        // Sidebar toggle functionality
        function setupSidebarToggle() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleBtn');
            const toggleIcon = document.getElementById('toggleIcon');
            const mainContent = document.getElementById('mainContent');

            toggleBtn.addEventListener('click', function() {
                
                sidebar.classList.toggle('collapsed');
                if (!sidebar.classList.contains('collapsed')) {
                    toggleIcon.textContent = '›';
                } else {
                    toggleIcon.textContent = '‹';
                    
                }
            });
        }

        // Render crypto cards
        function renderCryptoCards(data) {
            const cryptoGrid = document.getElementById('cryptoGrid');
            cryptoGrid.innerHTML = '';

            data.forEach(crypto => {
                const card = createCryptoCard(crypto);
                cryptoGrid.appendChild(card);
            });
        }

        // Create individual crypto card
        function createCryptoCard(crypto) {
            const card = document.createElement('div');
            card.className = 'crypto-card';

            const changeClass = crypto.change >= 0 ? 'positive' : 'negative';
            const changeSymbol = crypto.change >= 0 ? '+' : '';

            card.innerHTML = `
                <div class="crypto-header">
                    <div class="crypto-icon" style="background-color: ${crypto.color}">
                        ${crypto.symbol.charAt(0)}
                    </div>
                    <div class="crypto-info">
                        <h3>${crypto.name}</h3>
                        <div class="symbol">${crypto.symbol}</div>
                    </div>
                </div>
                
                <div class="crypto-price">
                    $${crypto.price.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}
                </div>
                
                <div class="crypto-change">
                    <span class="change-percent ${changeClass}">
                        ${changeSymbol}${crypto.change.toFixed(2)}%
                    </span>
                    <span style="color: #666; font-size: 12px;">24h</span>
                </div>
                
                <div class="crypto-stats">
                    <div class="stat-item">
                        <div class="stat-label">Market Cap</div>
                        <div class="stat-value">$${formatLargeNumber(crypto.marketCap)}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Volume 24h</div>
                        <div class="stat-value">$${formatLargeNumber(crypto.volume)}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Rank</div>
                        <div class="stat-value">#${crypto.rank}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Category</div>
                        <div class="stat-value">${crypto.category.toUpperCase()}</div>
                    </div>

                    

                </div>
                
                <button id='crypto-btn' onClick=update(${crypto.price}) style="width:100%;padding: 12px 0; margin-top:12px;color:white; border-radius:10px; ${(crypto.price<<?php echo $amt?>)?"background-color:#63E6BE;":"background-color:red;"};">
                        ${(crypto.price<<?php echo $amt?>)?"Grab It":"Sorry U Don't Have Sufficient Amount"}
                <button>
            `;

            return card;
        }
        
        function update(p){
            if(price < <?php echo $amt;?>){
                price+=p;
                sum=price+1;
                cnt+=1;
                cartCnt.innerText=cnt;
                tdc.innerText=cnt;
                tb.innerText=price;
                st.innerText=price;
                gt.innerText=sum;
            }
            else{
                alert("doesn't have Money!!");
                console.log(cart);
            }
        }

        // Format large numbers
        function formatLargeNumber(num) {
            if (num >= 1e12) {
                return (num / 1e12).toFixed(2) + 'T';
            } else if (num >= 1e9) {
                return (num / 1e9).toFixed(2) + 'B';
            } else if (num >= 1e6) {
                return (num / 1e6).toFixed(2) + 'M';
            } else if (num >= 1e3) {
                return (num / 1e3).toFixed(2) + 'K';
            } else {
                return num.toLocaleString();
            }
        }

        // Apply filters function
        function applyFilters() {
            let filteredData = [...cryptoData];
            
            // Search filter
            const searchTerm = document.getElementById('searchCrypto').value.toLowerCase();
            if (searchTerm) {
                filteredData = filteredData.filter(crypto => 
                    crypto.name.toLowerCase().includes(searchTerm) || 
                    crypto.symbol.toLowerCase().includes(searchTerm)
                );
            }

            // Price range filter
            const minPrice = parseFloat(document.getElementById('minPrice').value) || 0;
            const maxPrice = parseFloat(document.getElementById('maxPrice').value) || Infinity;
            filteredData = filteredData.filter(crypto => 
                crypto.price >= minPrice && crypto.price <= maxPrice
            );

            // Market cap filter
            const marketCapCategory = document.getElementById('marketCap').value;
            if (marketCapCategory !== 'all') {
                filteredData = filteredData.filter(crypto => {
                    if (marketCapCategory === 'large') return crypto.marketCap > 10e9;
                    if (marketCapCategory === 'mid') return crypto.marketCap >= 1e9 && crypto.marketCap <= 10e9;
                    if (marketCapCategory === 'small') return crypto.marketCap < 1e9;
                    return true;
                });
            }

            // Category filters
            const selectedCategories = [];
            ['defi', 'nft', 'gaming', 'layer1'].forEach(category => {
                if (document.getElementById(category).checked) {
                    selectedCategories.push(category);
                }
            });

            if (selectedCategories.length > 0) {
                filteredData = filteredData.filter(crypto => 
                    selectedCategories.includes(crypto.category)
                );
            }

            // Performance filters
            if (document.getElementById('gainers').checked) {
                filteredData = filteredData.filter(crypto => crypto.change > 5);
            }
            if (document.getElementById('losers').checked) {
                filteredData = filteredData.filter(crypto => crypto.change < -5);
            }
            if (document.getElementById('stable').checked) {
                filteredData = filteredData.filter(crypto => crypto.category === 'stable');
            }

            // Sorting
            const sortBy = document.getElementById('sortBy').value;
            filteredData.sort((a, b) => {
                switch (sortBy) {
                    case 'rank':
                        return a.rank - b.rank;
                    case 'price-high':
                        return b.price - a.price;
                    case 'price-low':
                        return a.price - b.price;
                    case 'change-high':
                        return b.change - a.change;
                    case 'change-low':
                        return a.change - b.change;
                    default:
                        return a.rank - b.rank;
                }
            });

            // Render filtered results
            renderCryptoCards(filteredData);

            // Show feedback
            const gridElement = document.getElementById('cryptoGrid');
            if (filteredData.length === 0) {
                gridElement.innerHTML = '<div style="text-align: center; color: white; font-size: 18px; grid-column: 1 / -1;">No cryptocurrencies match your filters.</div>';
            }
        }

        const openBtn = document.getElementById('openModal');
        const closeBtn = document.getElementById('closeModal');
        const modalOverlay = document.getElementById('modalOverlay');

        openBtn.addEventListener('click', () => {
            modalOverlay.classList.add('active');
        });

        closeBtn.addEventListener('click', () => {
            modalOverlay.classList.remove('active');
        });

        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                modalOverlay.classList.remove('active');
            }
        });

        // Add event listeners for real-time filtering
        document.getElementById('searchCrypto').addEventListener('input', applyFilters);
        document.getElementById('sortBy').addEventListener('change', applyFilters);
    </script>
</body>
</html>