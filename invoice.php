<?php 
session_start();
require "header.php";
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <p style="width:100%; max-width:300px;">CEDCAB</p>
                            </td>
                            
                            <td>
                                Invoice #: 110<br>
                                Ride Date: <?php print_r(date("Y/m/d")); ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <h4>Pickup</h4>
                                <?php print_r($_SESSION['from']); ?><br>
                                
                            </td>
                            
                            <td>
                                <h4>Drop</h4>
                                <?php print_r($_SESSION['to']); ?><br>
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            
            <tr class="heading">
                <td>
                    CabType
                </td>
                
                <td>
                    Fare
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    <?php print_r($_SESSION['class']); ?>
                </td>
                
                <td>
                    <?php print_r($_SESSION['fare']); ?>
                </td>
            </tr>
            
            
            <tr class="total">
                <td></td>
                
                <td>
                   Total: <?php print_r($_SESSION['fare']); ?>
                </td>
            </tr>
        </table>
    </div>
    <center>
    <a href="invoice.php?p=1" type="button" class="btn btn-warning" onclick="alert('booking confirmed please wait for it to be confirmed')">Confirm Booking</a>
    <a href="invoice.php?p=2" type="button" class="btn btn-danger" onclick="alert('booking has been cancelled')">Cancel</a>
    </center>
</body>
</html>
            <?php
                if(isset($_GET['p'])){
                    if($_GET['p']==1){
                    require_once "ride_Class.php";
                    $users= new RIDE();
                    $sql=$users->ride_data($_SESSION['from'],$_SESSION['to'],$_SESSION['distance'],$_SESSION['luggage'],$_SESSION['fare'],$_SESSION['id'],$_SESSION['class']);
                    echo "<script> alert('booking confirmed ') </script>";
                    
                    echo "<script>window.location.href = 'user_dashboard.php'; </script>";
                }
                elseif($_GET['p']==2){
                    unset($_SESSION['from']);
                    unset($_SESSION['to']);
                    unset($_SESSION['distance']);
                    unset($_SESSION['luggage']);
                    unset($_SESSION['fare']);
                    unset($_SESSION['class']);
                    unset($_SESSION['status']);
                    echo "<script>window.location.href = 'user_dashboard.php'; </script>";
                }

                }
            ?>