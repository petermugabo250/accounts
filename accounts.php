<?php
			
			session_start();
			
			if (!isset($_SESSION['username'])){
			header('location:index.php');
			}
			//
			?>
   <!DOCTYPE html>
<html>
    <head>
        <title>Business reporting</title>
        <link rel="stylesheet" href="mycss.css">
        <style type="text/css">
            table td{
                font-family:sans-serif;
                font-weight: normal;
            }
            a{
                text-decoration:none;
            }
        </style>
    </head>
    <body>
            
    <div class="Side-bar">
        <div class="Box-logo">My Business</div>
        <div class="Box-menu">
            <ul class="ul-menu">
                <a href="pages/addaccounts.php" target="iframe1"><li class="li-mneu Active-menu">
                   
                    <div class="title-menu">Accounts</div>
                </li></a>
                <a href="pages/record_transaction.php" target="iframe1"><li class="li-mneu">
                   
                    <div class="title-menu">Record Transaction</div>
                </li></a>
                <a href="pages/general_journal.php" target="iframe1"><li class="li-mneu">
                    
                    <div class="title-menu">Journal</div>
                </li></a>
                <a href="pages/ledger_accounts.php" target="iframe1"><li class="li-mneu">
                    
                    <div class="title-menu">Ledger</div>
                </li></a>
                <a href="pages/trial_balance.php" target="iframe1"><li class="li-mneu">
                    
                    <div class="title-menu">Trial balance</div>
                </li></a>
                </li></a>
                <a href="pages/balance_sheet.php" target="iframe1"><li class="li-mneu">
                    
                    <div class="title-menu">Balance Sheet</div>
                </li></a>
                </li></a>
                <a href="pages/income_statement.php" target="iframe1"><li class="li-mneu">
                    
                    <div class="title-menu"> Income statement</div>
                    <a href="logout.php"><li class="li-mneu logout">
                    <svg class="icon-menu" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                        <link xmlns="" type="text/css" rel="stylesheet" id="dark-mode-custom-link" />
                        <link xmlns="" type="text/css" rel="stylesheet" id="dark-mode-general-link" />
                        <style xmlns="" lang="en" type="text/css" id="dark-mode-custom-style" />
                        <style xmlns="" lang="en" type="text/css" id="dark-mode-native-style" />
                        <style xmlns="" lang="en" type="text/css" id="dark-mode-native-sheet" />
                        <path
                            d="M11.476,15a1,1,0,0,0-1,1v3a3,3,0,0,1-3,3H5a3,3,0,0,1-3-3V5A3,3,0,0,1,5,2H7.476a3,3,0,0,1,3,3V8a1,1,0,0,0,2,0V5a5.006,5.006,0,0,0-5-5H5A5.006,5.006,0,0,0,0,5V19a5.006,5.006,0,0,0,5,5H7.476a5.006,5.006,0,0,0,5-5V16A1,1,0,0,0,11.476,15Z" />
                        <path
                            d="M22.867,9.879,18.281,5.293a1,1,0,1,0-1.414,1.414L21.13,10.97,6,11a1,1,0,0,0,0,2H6l15.188-.03-4.323,4.323a1,1,0,1,0,1.414,1.414l4.586-4.586A3,3,0,0,0,22.867,9.879Z" />
                    </svg>
                    <div class="title-menu">Logout</div>
                </li></a>
            
            </ul>
        </div>
    </div>
    <div class="Page">
        <div class="Box-header">
            <div class="Box-search">
             
                <input class="input-search" placeholder="Search" type="text">
            </div>
            <div class="box-alert-infomation">
                <div class="box-alert">
                    <div class="staus-box-alert"></div>
                    
                </div>
                <div class="box-infomation">
                    <img class="info-avatar" src="img/peter.jpeg">
                    <div class="info-name">MUGABO John Peter</div>
                </div>
            </div>
        </div>
        <div class="Box-elements">
            <div class="box-element-flex">
                <div class="chart-box">
                    <div class="title-element">Activities</div>
                    <div class="chart-box-main">
                    
                    <iframe src="" frameborder="0" width="100%" height="100%" name="iframe1"></iframe>
                    
                    </div>
                </div>
                
            </div>
            <div class="box-element-flex">
                <div class="transction">
                    <div class="title-element">Transaction History</div>
                    
                    
                   
                    
                   
                
                
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>