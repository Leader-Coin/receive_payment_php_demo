<?php

include 'include.php';

$invoice_id = 9001;
$price_in_usd = 50;
$product_url = 'nutbolt.jpg';
$price_in_btc = 0.5;
$dbconnect = new PDO("mysql:host=" . $mysql_host .  ";dbname=" . $mysql_database, $mysql_username, $mysql_password);

//mysql_select_db($mysql_database) or die( "Unable to select database. Run setup first.");

//Add the invoice to the database
$result = $dbconnect->query("replace INTO invoices (invoice_id, price_in_usd, price_in_btc, product_url) values($invoice_id,'$price_in_usd','$price_in_btc','$product_url')");
    
/*if (!$result) {
    die(__LINE__ . ' Invalid query: ' . $dbconnect->errorInfo());
}*/

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../templates/assets/css/bootstrap.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $blockchain_root ?>Resources/wallet/pay-now-button-v2.js"></script>
    
    <script type="text/javascript">
	$(document).ready(function() {
		$('.stage-paid').on('show', function() {
			window.location.href = './order_status.php?invoice_id=<?php echo $invoice_id; ?>';
		});
	});
	</script>
    <style>body{ padding-top:80px;}</style>
</head>
    <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Exemple</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
         
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <div class="starter-template">
      
        <div class="blockchain-btn" style="width:auto" data-create-url="create.php?invoice_id=<?=$invoice_id?>"> 
            <div class="blockchain stage-begin">
             <h1>Buy Nuts and Bolts</h1>
            <img src="nutbolt.jpg" width="600" height="425" alt=""/>
            <button class="btn btn-success" style="min-width:250px"><img src="../Resources/leader_coin_cartoon.png" width="64" height="64" alt=""/> Pay Now </button> 
                
            </div>
            <div class="blockchain stage-loading" style="text-align:center">
                <img src="<?php echo $blockchain_root ?>Resources/loading.gif">
            </div>
            <div class="blockchain stage-ready" style="text-align:center">
                Please send <?php echo $price_in_btc ?> LDC to <br /> <b>[[address]]</b> <br /> 
                <div class="qr-code">
                <img style="margin:5px" id="qrsend" src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=<?=$my_bitcoin_address?>&message=Pay-Demo&amount=<?=$price_in_btc?>" alt=""/>
                </div>
            </div>
            <div class="blockchain stage-paid">
                Payment Received <b>[[value]] LDC</b>. Thank You.
            </div>
            <div class="blockchain stage-error">
                <font color="red">[[error]]</font>
            </div>
        </div>
    </div>
  </div>
    </body>
</html>
