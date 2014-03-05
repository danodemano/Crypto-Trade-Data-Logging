<?php
//Enable debugging - disable when going live
$debug_mode = false;

//All the data arrays we need to fill
$btc_usd = array();

//Get all the ticker/trade data
$btc_usd['ticker'] = json_decode(file_get_contents("https://www.bitstamp.net/api/ticker/"), true);
$btc_usd['trades'] = json_decode(file_get_contents("https://www.bitstamp.net/api/transactions/"), true);

//Database configurations
if (!$debug_mode) {
	require_once('dbinfo.php');
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

	//Make sure we are able to connect to the server
	if (!$conn) {
		die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	} //end if (!$conn) {

	//Set the database
	mysqli_select_db($conn, $dbname);
} //end if (!$debug_mode) {

//Insert all the ticker data into the database
//Checking to make sure we have data from the API call
if ((isset($btc_usd['ticker']['high'])) AND ($btc_usd['ticker']['high']<>0) AND ($btc_usd['ticker']['high']<>'')) {
	$sql =  "INSERT INTO `bitstamp_btc_usd_ticker` (`high`, `last`, `timestamp`, `bid`, `volume`, `low`, `ask`) ".
			"VALUES ('".$btc_usd['ticker']['high']."', '".$btc_usd['ticker']['last']."', ".
			"'".$btc_usd['ticker']['timestamp']."', '".$btc_usd['ticker']['bid']."', ".
			"'".$btc_usd['ticker']['volume']."', '".$btc_usd['ticker']['low']."', ".
			"'".$btc_usd['ticker']['ask']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($btc_usd['ticker']['high'])) AND ($btc_usd['ticker']['high']<>0) AND ($btc_usd['ticker']['high']<>'')) {

//Inserting the trade data into the database
foreach ($btc_usd['trades'] as $trade) {
	$sql =  "INSERT INTO `bitstamp_trades` (`date`, `tid`, `price`, `amount`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['tid']."', '".$trade['price']."', '".$trade['amount']."', ".
			"'USD', 'BTC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($btc_usd['trades'] as $trade) {

//Close the database connection
if (!$debug_mode) {
	mysqli_close($conn);
} //end if (!$debug_mode) {
?>
