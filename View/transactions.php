<?php session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
            /* padding: 20px; */
            overflow-x:auto;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            color: white;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 300;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            margin-bottom: 10px;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Summary Cards */
        .summary-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .summary-card:hover {
            transform: translateY(-3px);
        }

        .summary-card h3 {
            color: #555;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .summary-card .value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
        }

        /* Filters */
        .filters-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }

        .filters-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            font-weight: 500;
            color: #555;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .filter-group input, .filter-group select {
            padding: 10px 12px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: border-color 0.3s ease;
        }

        .filter-group input:focus, .filter-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        .filter-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        /* Transaction Table */
        .transactions-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 5rem;
        }

        .transactions-section h2 {
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
            min-width: 800;
        }

        th {
            background-color:#1B1A39;
            color: white;
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
            z-index: 10;
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
            vertical-align: middle;
        }

        tr:hover td {
            background-color: #f8f9ff;
        }

        .transaction-id {
            font-family: 'Courier New', monospace;
            font-weight: 600;
            color: #667eea;
        }

        .amount {
            font-weight: 700;
            font-size: 1.1rem;
        }

        .amount.debit {
            color: #e74c3c;
        }

        .amount.credit {
            color: #27ae60;
        }

        .upi-id {
            font-family: 'Courier New', monospace;
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status.success {
            background: #d4edda;
            color: #155724;
        }

        .status.pending {
            background: #fff3cd;
            color: #856404;
        }

        .status.failed {
            background: #f8d7da;
            color: #721c24;
        }

        .pdf-btn {
            padding: 8px 16px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .pdf-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        }

        .pdf-btn:active {
            transform: scale(0.98);
        }

        .date-time {
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        .recipient {
            font-weight: 500;
            color: #2c3e50;
        }

        .no-results {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
            font-style: italic;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }

            .filters-container {
                grid-template-columns: 1fr;
            }

            .summary-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .transactions-section {
                padding: 20px;
            }

            th, td {
                padding: 10px 8px;
                font-size: 0.85rem;
            }
        }

        .fa-spinner{
            animation: spin 2s infinite;
        }

        @keyframes spin {
            0%{
                transform: rotateX(30deg);
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <?php
        include "./navbar.php";
    ?>

    <?php 
            require "../Model/db_connect.php";
            $sid=$_SESSION['uid'];
            try{
                $pdo = new PDO($attr, $user, $pass, $opts);
            }
            catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }    

            $ts = "select * from transactions where sid like '$sid' or rid like '$sid'";
            $ts_result = $pdo->query($ts);
            
            $ts4= "select count(*) as count from transactions where sid like '$sid' or rid like '$sid'";
            $ts4_result = $pdo->query($ts4);
            $ts4_row = $ts4_result->fetch();

            $ts5= "select sum(amount) as ts_send from transactions where sid like '$sid' and status=1";
            $ts5_result = $pdo->query($ts5);
            $ts5_row = $ts5_result->fetch();

            $ts6= "select sum(amount) as ts_receive from transactions where rid like '$sid' and status=0";
            $ts6_result = $pdo->query($ts6);
            $ts6_row = $ts6_result->fetch();
        ?>
    <div class="container">
        <div class="header">
            <h1>Transaction History</h1>
            <p>Track all your payment transactions and generate detailed reports</p>
        </div>

        <!-- Summary Cards -->
        <div class="summary-container">
            <div class="summary-card">
                <h3>Total Transactions</h3>
                <i class="fa-solid fa-receipt" style="color: #63E6BE;font-size:32px;"></i><div class="value" id="totalTransactions" style='display:inline;'><?php echo $ts4_row['count']?></div>
            </div>
            <div class="summary-card">
                <h3>Total Sent</h3>
                <i class="fa-regular fa-paper-plane" style="color: #74C0FC;font-size:32px;"></i>
                <div class="value" id="totalSent" style='display:inline;'>$<?php echo $ts5_row['ts_send'];?></div>
            </div>
            <div class="summary-card">
                <h3>Total Received</h3>
                <i class="fa-solid fa-thumbs-up" style="color: #B197FC;font-size:32px;"></i>
                <div class="value" id="totalReceived" style='display:inline;'>$<?php echo $ts6_row['ts_receive'];?></div>
            </div>
            <div class="summary-card">
                <h3>Pending</h3>
                <i class="fa-solid fa-spinner" style="color: #c2330f;font-size:32px;"></i>
                <div class="value" id="pendingCount" style='display:inline;'>3</div>
            </div>
        </div>

        

        <!-- Transactions Table -->
        <div class="transactions-section">
            <h2>Transaction Details</h2>
            <div class="table-container">
                <table id="transactionsTable">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Date & Time</th>
                            <th>UPI ID</th>
                            <th>Amount</th>
                            <th>To/From</th>
                            <th>Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody id="transactionsBody">
                        <?php 
                            $cnt=1;
                            while($ts_row = $ts_result->fetch()){
                                echo "<tr id='ttable'>";
                                echo "<td id='tid$cnt'>TXXN".$ts_row['trans_id']."</td>";
                                echo "<td id='tdate$cnt'>".$ts_row['t_date']."</td>";
                               
                                if($ts_row['sid']==$_SESSION['uid']){
                                    echo "<td id='upi$cnt'>".$ts_row['rid']."</td>";
                                }else{
                                    echo "<td id='upi$cnt'>".$ts_row['sid']."</td>";
                                }
                                
                                if($ts_row['sid']==$_SESSION['uid']){
                                    echo "<td id='amt$cnt' style='color:red;'><b>-".$ts_row['amount']."</b></td>";
                                }else{
                                    echo "<td id='amt$cnt' style='color:green;'><b> +".$ts_row['amount']."</b></td>";
                                }
                                
                                $rid=$ts_row['rid'];
                                $sid=$ts_row['sid'];

                                if($ts_row['sid']==$_SESSION['uid']){
                                    $ts2 = "select name from user where id like '$rid'";
                                    $ts_result2=$pdo->query($ts2);
                                    $ts_row2 = $ts_result2->fetch();
                                    echo "<td id='name$cnt'>".$ts_row2['name']."</td>";
                                }else{
                                    $ts3 = "select name from user where id like '$sid'";
                                    $ts_result3=$pdo->query($ts3);
                                    $ts_row3 = $ts_result3->fetch();
                                    echo "<td id='name$cnt'>".$ts_row3['name']."</td>";
                                }
                                

                                if($ts_row['sid']==$_SESSION['uid']){
                                    echo "<td id='status$cnt' class='fa-solid fa-arrow-trend-down' style='color: #f60909;'> Send</td>";
                                }else{
                                    echo "<td id='status$cnt' class='fa-solid fa-arrow-trend-up' style='color: #63E6BE;'> Received</td>";
                                }

                                echo "<td>
                                        <button class='pdf-btn' onclick='generatePDF($cnt)'>
                                            📄 PDF
                                        </button>
                                     </td>";
                                
                                echo "</tr>";
                                $cnt+=1;
                            }
                        ?>
                        
                            
                            
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        
        function generatePDF(transactionId){
             var tid = document.querySelector(`#tid${transactionId}`).innerHTML;
             var tdate = document.querySelector(`#tdate${transactionId}`).innerHTML;
             var upi = document.querySelector(`#upi${transactionId}`).innerHTML;
             var amt = document.querySelector(`#amt${transactionId}`).innerText;
             var name = document.querySelector(`#name${transactionId}`).innerHTML;
             var status = document.querySelector(`#status${transactionId}`).innerHTML;

             setTimeout(() => {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Set up the document
                doc.setFontSize(20);
                doc.setTextColor(102, 126, 234);
                doc.text('Transaction Receipt', 105, 30, { align: 'center' });

                // draw a line
                doc.setLineWidth(0.5);
                doc.setDrawColor(102, 126, 234);
                doc.line(20, 35, 190, 35);
                
                // Transaction details
                doc.setFontSize(12);
                doc.setTextColor(0, 0, 0);

                let y = 55;
                const leftColumn = 30;
                const rightColumn = 110;

                // Left column
                doc.setFont(undefined, 'bold');
                doc.text('Transaction Details:', leftColumn, y);
                y += 10;

                doc.setFont(undefined, 'normal');
                doc.text(`Transaction ID: ${tid}`, leftColumn, y);
                y += 8;


                doc.setFont(undefined, 'normal');
                doc.text(`Transaction Date: ${tdate}`, leftColumn, y);
                y += 8;

                doc.setFont(undefined, 'normal');
                doc.text(`UPI ID: ${upi}@ibl`, leftColumn, y);
                y += 8;

                doc.setFont(undefined, 'normal');
                doc.text(`Amount: ${amt}`, leftColumn, y);
                y += 8;

                doc.setFont(undefined, 'normal');
                doc.text(`To/From: ${name}`, leftColumn, y);
                y += 8;

                doc.setFont(undefined, 'normal');
                doc.text(`Status: ${status}`, leftColumn, y);
                y += 80;

                doc.setFontSize(10);
                doc.setTextColor(128, 128, 128);
                doc.text('This is a system-generated receipt. No signature required.', 105, y, { align: 'center' });
                y -= 80;


                doc.setTextColor(46, 204, 113);
                doc.setFontSize(18);
                doc.text(status, 105, 200, { align: 'center' });


                // Save the PDF
                doc.save(`Transaction_${tid}_Receipt.pdf`);

                // Reset button state
            }, 1000);
        }
    </script>
    <?php include "./footer.php";?>
</body>
</html>