<?php
//Enable debugging - disable when going live
$debug_mode = false;

//All the data arrays we need to fill
$ltc_btc = array();
$doge_btc = array();
$nmc_btc = array();
$nxt_btc = array();
$ppc_btc = array();
$vtc_btc = array();

//Get all the ticker data
$ltc_btc['ticker'] = json_decode(file_get_contents("http://data.bter.com/api/1/ticker/ltc_btc"), true);
$doge_btc['ticker'] = json_decode(file_get_contents("http://data.bter.com/api/1/ticker/doge_btc"), true);
$nmc_btc['ticker'] = json_decode(file_get_contents("http://data.bter.com/api/1/ticker/nmc_btc"), true);
$nxt_btc['ticker']  = json_decode(file_get_contents("http://data.bter.com/api/1/ticker/nxt_btc"), true);
$ppc_btc['ticker'] = json_decode(file_get_contents("http://data.bter.com/api/1/ticker/ppc_btc"), true);
$vtc_btc['ticker'] = json_decode(file_get_contents("http://data.bter.com/api/1/ticker/vtc_btc"), true);

//Get all the trade data
$ltc_btc['trades'] = json_decode(file_get_contents("http://data.bter.com/api/1/trade/ltc_btc"), true);
$doge_btc['trades'] = json_decode(file_get_contents("http://data.bter.com/api/1/trade/doge_btc"), true);
$nmc_btc['trades'] = json_decode(file_get_contents("http://data.bter.com/api/1/trade/nmc_btc"), true);
$nxt_btc['trades'] = json_decode(file_get_contents("http://data.bter.com/api/1/trade/nxt_btc"), true);
$ppc_btc['trades'] = json_decode(file_get_contents("http://data.bter.com/api/1/trade/ppc_btc"), true);
$vtc_btc['trades'] = json_decode(file_get_contents("http://data.bter.com/api/1/trade/vtc_btc"), true);

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
if ((isset($ltc_btc['ticker']['high'])) AND ($ltc_btc['ticker']['high']<>0) AND ($ltc_btc['ticker']['high']<>'')) {
	$sql =  "INSERT INTO `bter_ltc_btc_ticker` (`last`, `high`, `low`, `avg`, `sell`, `buy`, `vol_ltc`, `vol_btc`) ".
			"VALUES ('".$ltc_btc['ticker']['last']."', '".$ltc_btc['ticker']['high']."', ".
			"'".$ltc_btc['ticker']['low']."', '".$ltc_btc['ticker']['avg']."', ".
			"'".$ltc_btc['ticker']['sell']."', '".$ltc_btc['ticker']['buy']."', ".
			"'".$ltc_btc['ticker']['vol_ltc']."', '".$ltc_btc['ticker']['vol_btc']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($ltc_btc['ticker']['high'])) AND ($ltc_btc['ticker']['high']<>0) AND ($ltc_btc['ticker']['high']<>'')) {

if ((isset($doge_btc['ticker']['high'])) AND ($doge_btc['ticker']['high']<>0) AND ($doge_btc['ticker']['high']<>'')) {
	$sql =  "INSERT INTO `bter_doge_btc_ticker` (`last`, `high`, `low`, `avg`, `sell`, `buy`, `vol_doge`, `vol_btc`) ".
			"VALUES ('".$doge_btc['ticker']['last']."', '".$doge_btc['ticker']['high']."', ".
			"'".$doge_btc['ticker']['low']."', '".$doge_btc['ticker']['avg']."', ".
			"'".$doge_btc['ticker']['sell']."', '".$doge_btc['ticker']['buy']."', ".
			"'".$doge_btc['ticker']['vol_ltc']."', '".$doge_btc['ticker']['vol_btc']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($doge_btc['ticker']['high'])) AND ($doge_btc['ticker']['high']<>0) AND ($doge_btc['ticker']['high']<>'')) {

if ((isset($nmc_btc['ticker']['high'])) AND ($nmc_btc['ticker']['high']<>0) AND ($nmc_btc['ticker']['high']<>'')) {
	$sql =  "INSERT INTO `bter_nmc_btc_ticker` (`last`, `high`, `low`, `avg`, `sell`, `buy`, `vol_nmc`, `vol_btc`) ".
			"VALUES ('".$nmc_btc['ticker']['last']."', '".$nmc_btc['ticker']['high']."', ".
			"'".$nmc_btc['ticker']['low']."', '".$nmc_btc['ticker']['avg']."', ".
			"'".$nmc_btc['ticker']['sell']."', '".$nmc_btc['ticker']['buy']."', ".
			"'".$nmc_btc['ticker']['vol_ltc']."', '".$nmc_btc['ticker']['vol_btc']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($nmc_btc['ticker']['high'])) AND ($nmc_btc['ticker']['high']<>0) AND ($nmc_btc['ticker']['high']<>'')) {

if ((isset($nxt_btc['ticker']['high'])) AND ($nxt_btc['ticker']['high']<>0) AND ($nxt_btc['ticker']['high']<>'')) {
	$sql =  "INSERT INTO `bter_nxt_btc_ticker` (`last`, `high`, `low`, `avg`, `sell`, `buy`, `vol_nxt`, `vol_btc`) ".
			"VALUES ('".$nxt_btc['ticker']['last']."', '".$nxt_btc['ticker']['high']."', ".
			"'".$nxt_btc['ticker']['low']."', '".$nxt_btc['ticker']['avg']."', ".
			"'".$nxt_btc['ticker']['sell']."', '".$nxt_btc['ticker']['buy']."', ".
			"'".$nxt_btc['ticker']['vol_ltc']."', '".$nxt_btc['ticker']['vol_btc']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($nxt_btc['ticker']['high'])) AND ($nxt_btc['ticker']['high']<>0) AND ($nxt_btc['ticker']['high']<>'')) {

if ((isset($ppc_btc['ticker']['high'])) AND ($ppc_btc['ticker']['high']<>0) AND ($ppc_btc['ticker']['high']<>'')) {
	$sql =  "INSERT INTO `bter_ppc_btc_ticker` (`last`, `high`, `low`, `avg`, `sell`, `buy`, `vol_ppc`, `vol_btc`) ".
			"VALUES ('".$ppc_btc['ticker']['last']."', '".$ppc_btc['ticker']['high']."', ".
			"'".$ppc_btc['ticker']['low']."', '".$ppc_btc['ticker']['avg']."', ".
			"'".$ppc_btc['ticker']['sell']."', '".$ppc_btc['ticker']['buy']."', ".
			"'".$ppc_btc['ticker']['vol_ltc']."', '".$ppc_btc['ticker']['vol_btc']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($ppc_btc['ticker']['high'])) AND ($ppc_btc['ticker']['high']<>0) AND ($ppc_btc['ticker']['high']<>'')) {

if ((isset($vtc_btc['ticker']['high'])) AND ($vtc_btc['ticker']['high']<>0) AND ($vtc_btc['ticker']['high']<>'')) {
	$sql =  "INSERT INTO `bter_vtc_btc_ticker` (`last`, `high`, `low`, `avg`, `sell`, `buy`, `vol_vtc`, `vol_btc`) ".
			"VALUES ('".$vtc_btc['ticker']['last']."', '".$vtc_btc['ticker']['high']."', ".
			"'".$vtc_btc['ticker']['low']."', '".$vtc_btc['ticker']['avg']."', ".
			"'".$vtc_btc['ticker']['sell']."', '".$vtc_btc['ticker']['buy']."', ".
			"'".$vtc_btc['ticker']['vol_ltc']."', '".$vtc_btc['ticker']['vol_btc']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($vtc_btc['ticker']['high'])) AND ($vtc_btc['ticker']['high']<>0) AND ($vtc_btc['ticker']['high']<>'')) {

//Inserting the trade data into the database
foreach ($ltc_btc['trades']['data'] as $trade) {
	$sql =  "INSERT INTO `bter_trades` (`date`, `price`, `amount`, `tid`, `type`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['price']."', '".$trade['amount']."', '".$trade['tid']."', ".
			"'".$trade['type']."', 'BTC', 'LTC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($ltc_btc['trades'] as $trade) {

foreach ($doge_btc['trades']['data'] as $trade) {
	$sql =  "INSERT INTO `bter_trades` (`date`, `price`, `amount`, `tid`, `type`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['price']."', '".$trade['amount']."', '".$trade['tid']."', ".
			"'".$trade['type']."', 'BTC', 'DOGE');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($doge_btc['trades'] as $trade) {

foreach ($nmc_btc['trades']['data'] as $trade) {
	$sql =  "INSERT INTO `bter_trades` (`date`, `price`, `amount`, `tid`, `type`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['price']."', '".$trade['amount']."', '".$trade['tid']."', ".
			"'".$trade['type']."', 'BTC', 'NMC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($nmc_btc['trades'] as $trade) {

foreach ($nxt_btc['trades']['data'] as $trade) {
	$sql =  "INSERT INTO `bter_trades` (`date`, `price`, `amount`, `tid`, `type`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['price']."', '".$trade['amount']."', '".$trade['tid']."', ".
			"'".$trade['type']."', 'BTC', 'NXT');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($nxt_btc['trades'] as $trade) {

foreach ($ppc_btc['trades']['data'] as $trade) {
	$sql =  "INSERT INTO `bter_trades` (`date`, `price`, `amount`, `tid`, `type`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['price']."', '".$trade['amount']."', '".$trade['tid']."', ".
			"'".$trade['type']."', 'BTC', 'PPC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($ppc_btc['trades'] as $trade) {

foreach ($vtc_btc['trades']['data'] as $trade) {
	$sql =  "INSERT INTO `bter_trades` (`date`, `price`, `amount`, `tid`, `type`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['price']."', '".$trade['amount']."', '".$trade['tid']."', ".
			"'".$trade['type']."', 'BTC', 'VTC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($vtc_btc['trades'] as $trade) {

//Close the database connection
if (!$debug_mode) {
	mysqli_close($conn);
} //end if (!$debug_mode) {
?>