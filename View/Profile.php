<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayFlow Dashboard</title>
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
            color: #333;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.15);
        }

        .balance-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .balance-amount {
            font-size: 36px;
            font-weight: bold;
            margin: 15px 0;
        }

        .balance-label {
            opacity: 0.9;
            margin-bottom: 10px;
        }

        .quick-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-primary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .btn-success {
            background: #4ecdc4;
            color: white;
        }

        .btn-success:hover {
            background: #45b7aa;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #ff6b6b;
            color: white;
        }

        .btn-danger:hover {
            background: #ff5252;
            transform: translateY(-2px);
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        #spendingChart {
            width: 100%;
            height: 100%;
        }

        .transaction-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            transition: background 0.3s ease;
        }

        .transaction-item:hover {
            background: rgba(102, 126, 234, 0.05);
            border-radius: 10px;
            padding: 15px 10px;
        }

        .transaction-item:last-child {
            border-bottom: none;
        }

        .transaction-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .transaction-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }

        .transaction-icon.income {
            background: #4ecdc4;
        }

        .transaction-icon.expense {
            background: #ff6b6b;
        }

        .transaction-details h4 {
            margin-bottom: 5px;
            color: #333;
        }

        .transaction-details p {
            color: #666;
            font-size: 14px;
        }

        .transaction-amount {
            font-weight: bold;
            font-size: 16px;
        }

        .transaction-amount.income {
            color: #4ecdc4;
        }

        .transaction-amount.expense {
            color: #ff6b6b;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-value {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 15px;
            text-decoration: none;
            color: #333;
            border-radius: 12px;
            transition: all 0.3s ease;
            gap: 12px;
        }

        .nav-link:hover, .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateX(5px);
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            background: #f0f0f0;
            color: #666;
        }

        .nav-link:hover .nav-icon, .nav-link.active .nav-icon {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            backdrop-filter: blur(5px);
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            position: relative;
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #999;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .quick-actions {
                flex-direction: column;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4ecdc4;
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transform: translateX(400px);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .notification.show {
            transform: translateX(0);
            opacity: 1;
        }

        .card-number {
            font-family: 'Courier New', monospace;
            font-size: 18px;
            letter-spacing: 2px;
            margin: 15px 0;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .payment-card {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            height: 180px;
            position: relative;
            overflow: hidden;
        }

        .payment-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
        }

        .card-type {
            font-size: 14px;
            opacity: 0.8;
            margin-bottom: 20px;
        }

        .card-balance {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .card-details {
            display: flex;
            justify-content: space-between;
            align-items: end;
        }

        .progress-bar {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            height: 8px;
            margin-top: 10px;
            overflow: hidden;
        }

        .progress-fill {
            background: linear-gradient(90deg, #4ecdc4, #44a08d);
            height: 100%;
            border-radius: 10px;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
    <?php
       include "./navbar.php";
       $uname=$_SESSION['uname'];
       $amt=$_SESSION['amt'];
    ?>
    <div class="container">
        <header class="header">
            <div class="logo">💳 PayFlow</div>
            <div class="user-info">
                <span>Welcome back, <?php
                    echo $uname;
                ?></span>
                <div class="user-avatar">JD</div>
            </div>
        </header>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value" id="totalBalance"><?php echo '₹'.$amt; ?></div>
                <div class="stat-label">Total Balance</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="monthlySpending">$2,384.50</div>
                <div class="stat-label">This Month</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="totalTransactions">47</div>
                <div class="stat-label">Transactions</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="savedAmount"> Share & Earn</div>
                <div class="stat-label">Referral</div>
            </div>
        </div>

        

        <div class="main-content">
            <div class="sidebar">
                <div class="card">
                    <h3 style="margin-bottom: 20px; color: #333;">Navigation</h3>
                    <nav>
                        <ul class="nav-menu">
                            <li class="nav-item">
                                <a href="#" class="nav-link active" data-section="overview">
                                    <span class="nav-icon">📊</span>
                                    Overview
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-section="transactions">
                                    <span class="nav-icon">💸</span>
                                    Transactions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-section="cards">
                                    <span class="nav-icon">💳</span>
                                    My Cards
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-section="analytics">
                                    <span class="nav-icon">📈</span>
                                    Analytics
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-section="settings">
                                    <span class="nav-icon">⚙️</span>
                                    Settings
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="card balance-card">
                    <div class="balance-label">Available Balance</div>
                    <div class="balance-amount">$8,234.67</div>
                    <div class="quick-actions">
                        <button class="btn btn-primary" onclick="openModal('sendMoney')">Send</button>
                        <button class="btn btn-primary" onclick="openModal('requestMoney')">Request</button>
                    </div>
                </div>
            </div>

            <div class="main-panel">
                <div class="card">
                    <div class="chart-title">Spending Analytics</div>
                    <div class="chart-container">
                        <canvas id="spendingChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="sidebar">
                <div class="card">
                    <h3 style="margin-bottom: 20px; color: #333;">Recent Transactions</h3>
                    <div id="transactionsList">
                        <div class="transaction-item">
                            <div class="transaction-info">
                                <div class="transaction-icon expense">🛒</div>
                                <div class="transaction-details">
                                    <h4>Amazon Purchase</h4>
                                    <p>Today, 2:30 PM</p>
                                </div>
                            </div>
                            <div class="transaction-amount expense">-$89.99</div>
                        </div>
                        <div class="transaction-item">
                            <div class="transaction-info">
                                <div class="transaction-icon income">💰</div>
                                <div class="transaction-details">
                                    <h4>Salary Deposit</h4>
                                    <p>Yesterday, 9:00 AM</p>
                                </div>
                            </div>
                            <div class="transaction-amount income">+$3,200.00</div>
                        </div>
                        <div class="transaction-item">
                            <div class="transaction-info">
                                <div class="transaction-icon expense">☕</div>
                                <div class="transaction-details">
                                    <h4>Coffee Shop</h4>
                                    <p>Yesterday, 8:15 AM</p>
                                </div>
                            </div>
                            <div class="transaction-amount expense">-$4.50</div>
                        </div>
                        <div class="transaction-item">
                            <div class="transaction-info">
                                <div class="transaction-icon expense">⛽</div>
                                <div class="transaction-details">
                                    <h4>Gas Station</h4>
                                    <p>2 days ago, 6:45 PM</p>
                                </div>
                            </div>
                            <div class="transaction-amount expense">-$45.20</div>
                        </div>
                        <div class="transaction-item">
                            <div class="transaction-info">
                                <div class="transaction-icon income">🏦</div>
                                <div class="transaction-details">
                                    <h4>Interest Payment</h4>
                                    <p>3 days ago, 12:00 PM</p>
                                </div>
                            </div>
                            <div class="transaction-amount income">+$15.67</div>
                        </div>
                    </div>
                </div>

                <div class="card" id="cardsSection" style="display: none;">
                    <h3 style="margin-bottom: 20px; color: #333;">My Cards</h3>
                    <div class="cards-grid">
                        <div class="payment-card">
                            <div class="card-type">VISA DEBIT</div>
                            <div class="card-number">**** **** **** 4521</div>
                            <div class="card-details">
                                <div>
                                    <div style="font-size: 12px; opacity: 0.8;">EXPIRES</div>
                                    <div>12/28</div>
                                </div>
                                <div>
                                    <div style="font-size: 12px; opacity: 0.8;">CVV</div>
                                    <div>***</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success" style="margin-top: 20px;" onclick="openModal('addCard')">Add New Card</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="color: #333;">Quick Actions</h3>
                <button class="btn btn-success" onclick="openModal('sendMoney')">New Transaction</button>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <button class="btn btn-success" onclick="openModal('sendMoney')">Send Money</button>
                <button class="btn btn-primary" onclick="openModal('requestMoney')" style="background: #667eea; color: white;">Request Money</button>
                <button class="btn btn-primary" onclick="openModal('addCard')" style="background: #764ba2; color: white;">Add Card</button>
                <button class="btn btn-danger" onclick="showNotification('Bills reminder set!')">Pay Bills</button>
            </div>
        </div>
    </div>

    <!-- Send Money Modal -->
    <div id="sendMoneyModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Send Money</h3>
                <button class="close-btn" onclick="closeModal('sendMoney')">&times;</button>
            </div>
            <form onsubmit="handleSendMoney(event)">
                <div class="form-group">
                    <label for="recipient">Recipient Email/Phone</label>
                    <input type="text" id="recipient" placeholder="Enter email or phone number" required>
                </div>
                <div class="form-group">
                    <label for="amount">Amount ($)</label>
                    <input type="number" id="amount" placeholder="0.00" step="0.01" min="0.01" required>
                </div>
                <div class="form-group">
                    <label for="note">Note (Optional)</label>
                    <input type="text" id="note" placeholder="What's this for?">
                </div>
                <button type="submit" class="btn btn-success" style="width: 100%;">Send Money</button>
            </form>
        </div>
    </div>

    <!-- Request Money Modal -->
    <div id="requestMoneyModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Request Money</h3>
                <button class="close-btn" onclick="closeModal('requestMoney')">&times;</button>
            </div>
            <form onsubmit="handleRequestMoney(event)">
                <div class="form-group">
                    <label for="requestRecipient">From (Email/Phone)</label>
                    <input type="text" id="requestRecipient" placeholder="Enter email or phone number" required>
                </div>
                <div class="form-group">
                    <label for="requestAmount">Amount ($)</label>
                    <input type="number" id="requestAmount" placeholder="0.00" step="0.01" min="0.01" required>
                </div>
                <div class="form-group">
                    <label for="requestNote">Reason</label>
                    <input type="text" id="requestNote" placeholder="What's this request for?" required>
                </div>
                <button type="submit" class="btn btn-success" style="width: 100%;">Send Request</button>
            </form>
        </div>
    </div>

    <!-- Add Card Modal -->
    <div id="addCardModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Card</h3>
                <button class="close-btn" onclick="closeModal('addCard')">&times;</button>
            </div>
            <form onsubmit="handleAddCard(event)">
                <div class="form-group">
                    <label for="cardNumber">Card Number</label>
                    <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" required>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="expiryDate">Expiry Date</label>
                        <input type="text" id="expiryDate" placeholder="MM/YY" maxlength="5" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" placeholder="123" maxlength="3" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cardName">Cardholder Name</label>
                    <input type="text" id="cardName" placeholder="John Doe" required>
                </div>
                <button type="submit" class="btn btn-success" style="width: 100%;">Add Card</button>
            </form>
        </div>
    </div>

    <div id="notification" class="notification"></div>
    </body>
    </html>
   