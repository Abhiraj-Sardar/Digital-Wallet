<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color:  #4A4EED;
            min-height: 100vh;
            /* padding: 20px; */
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        

        /* .header {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 300;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        } */

        /* Dashboard Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px 25px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4);
        }

        .stat-card h3 {
            color: #333;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .stat-card .value {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .stat-card .change {
            font-size: 0.8rem;
            color: #27ae60;
            font-weight: 500;
        }

        /* Payment Form */
        .payment-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .payment-section h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .payment-form {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 15px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 500;
            color: #555;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .form-group input {
            padding: 12px 15px;
            border: 2px solid #e1e8ed;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .process-btn {
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .process-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .process-btn:active {
            transform: translateY(0);
        }

        /* Users Table */
        .users-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 20px;
        }

        .users-section h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background-color: #1B1A39;
            color: white;
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        th:first-child {
            border-top-left-radius: 15px;
        }

        th:last-child {
            border-top-right-radius: 15px;
        }

        td {
            padding: 15px 12px;
            border-bottom: 1px solid #f1f3f4;
            color: #555;
            transition: background-color 0.2s ease;
        }

        tr:hover td {
            background-color: #f8f9ff;
        }

        tr:last-child td:first-child {
            border-bottom-left-radius: 15px;
        }

        tr:last-child td:last-child {
            border-bottom-right-radius: 15px;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status.active {
            background: #d4edda;
            color: #155724;
        }

        .status.inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .status.pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .coin{
            animation: flip 2s infinite;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .payment-form {
                grid-template-columns: 1fr;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 2rem;
            }

            .stat-card .value {
                font-size: 1.8rem;
            }
        }

        @keyframes flip {
            0%{
                transform: rotateY(360deg);
            }
        }

        /* Success Animation */
        @keyframes successPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .success-animation {
            animation: successPulse 0.6s ease-in-out;
        }
        
    </style>
</head>
<body>
    <?php
        include "./navbar.php";
        require_once '../Model/db_connect.php';
        $uid=$_SESSION['uid']; //profile user id
        $uemail=$_SESSION['uemail'];
       
        try {
                $pdo = new PDO($attr, $user, $pass, $opts);
            //  echo "Connection successfull..";
        } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
        }   

        $uo = "select * from user where id LIKE '$uid'";
        $stmt=$pdo->query($uo);
        $ui = $stmt->fetch();

    ?>
    <div class="container">
        <!-- <div class="header">
            <h1>Payment Dashboard</h1>
        </div> -->

        <!-- Dashboard Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <h3>PayGo Coin</h3>
                <i class="fa-brands fa-bitcoin coin" style="color: #FFD43B; font-size:32px;"></i>
                <div class="value" id="walletCash" style='display:inline;'>₹ <?php echo $ui['amount'];?> </div>
                <div class="change">+5.2% from last month</div>
            </div>
            <div class="stat-card">
                <h3>Total Transactions</h3>
                <i class="fa-solid fa-receipt" style="color: #B197FC;font-size:32px; margin-right:10px;"></i>
                <div class="value" id="totalTransactions" style='display:inline;'>1,247</div>
                <div class="change">+12 today</div>
            </div>
            <div class="stat-card">
                <h3>Active Users</h3>
                <i class="fa-solid fa-users" style="color: #1fe02c; font-size:32px; margin-right:10px;"></i>
                <div class="value" id="activeUsers" style='display:inline;'>89</div>
                <div class="change">+3 this week</div>
            </div>
            <div class="stat-card">
                <h3>Success Rate</h3>
                <i class="fa-solid fa-circle-check" style="color: #63E6BE;font-size:32px; margin-right:10px;"></i>
                <div class="value" id="successRate" style='display:inline;'>98.5%</div>
                <div class="change">+0.3% improved</div>
            </div>
        </div>

        <!-- Payment Processing Form -->
        <div class="payment-section">
            <h2>Process Payment</h2>
            <form action="../Controller/payment_handler.php" method="post" class="payment-form" id="paymentForm">
                <div class="form-group">
                    <label for="userId">User ID</label>
                    <input type="text" id="userId" name="userId" placeholder="Enter User ID" required>
                </div>
                <div class="form-group">
                    <label for="amount">Amount (₹)</label>
                    <input type="number" id="amount" name="amount" placeholder="Enter Amount" step="0.01" required>
                </div>
                <button type="submit" class="process-btn">Process Payment</button>
            </form>
        </div>

        <!-- Users Table -->
        <div class="users-section">
            <h2>User Details</h2>
            <div class="table-container">
                <table id="usersTable">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Balance</th>
                            <th>Last Transaction</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                             $rs = "select * from user where email NOT LIKE '$uemail'";
                             $result = $pdo->query($rs);
                        ?>
                        
                            <?php
                                while($row = $result->fetch()){
                                    echo '<tr>';
                                    echo '<td>'.$row['id'].'</td>';
                                    echo '<td>'.$row['name'].'</td>';
                                    echo '<td>'.$row['email']." <i class='fa-solid fa-certificate' style='color: #2bee38;'></i>".'</td>';
                                    echo '<td>'.$row['amount'].'</td>';
                                    echo '<td>2025-09-04</td>';
                                    echo '<td><span class="status active">Active</span></td>';
                                    echo '</tr>';
                                }
                            ?>
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require "./footer.php";?>
    <script>
        // Sample data for dynamic updates



        // Process payment
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            
        });

        // Simulate real-time updates (optional)
    </script>
</body>
</html>