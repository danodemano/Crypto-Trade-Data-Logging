<?php
//Enable debugging - disable when going live
$debug_mode = false;

require_once('btce-api.php');
$BTCeAPI = new BTCeAPI(
    /*API KEY:    */    '1234', 
    /*API SECRET: */    '1234'
);

//All the data arrays we need to fill
$btc_usd = array();
$ltc_btc = array();
$ltc_usd = array();
$nmc_btc = array();
$nmc_usd = array();
$ppc_btc = array();
$ppc_usd = array();

//Getting all the ticker data
$btc_usd['ticker'] = $BTCeAPI->getPairTicker('btc_usd');
$ltc_btc['ticker'] = $BTCeAPI->getPairTicker('ltc_btc');
$ltc_usd['ticker'] = $BTCeAPI->getPairTicker('ltc_usd');
$nmc_btc['ticker'] = $BTCeAPI->getPairTicker('nmc_btc');
$nmc_usd['ticker'] = $BTCeAPI->getPairTicker('nmc_usd');
$ppc_btc['ticker'] = $BTCeAPI->getPairTicker('ppc_btc');
$ppc_usd['ticker'] = $BTCeAPI->getPairTicker('ppc_usd');

//Getting all the trade data
$btc_usd['trades'] = $BTCeAPI->getPairTrades('btc_usd');
$ltc_btc['trades'] = $BTCeAPI->getPairTrades('ltc_btc');
$ltc_usd['trades'] = $BTCeAPI->getPairTrades('ltc_usd');
$nmc_btc['trades'] = $BTCeAPI->getPairTrades('nmc_btc');
$nmc_usd['trades'] = $BTCeAPI->getPairTrades('nmc_usd');
$ppc_btc['trades'] = $BTCeAPI->getPairTrades('ppc_btc');
$ppc_usd['trades'] = $BTCeAPI->getPairTrades('ppc_usd');

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
if ((isset($btc_usd['ticker']['ticker']['high'])) AND ($btc_usd['ticker']['ticker']['high']<>0) AND ($btc_usd['ticker']['ticker']['high']<>'')) {
	$sql =  "INSERT INTO `btce_btc_usd_ticker` (`high`, `low`, `avg`, `vol`, `vol_current`, `last`, `buy`, `sell`, `updated`, `server_time`) ".
			"VALUES ('".$btc_usd['ticker']['ticker']['high']."', '".$btc_usd['ticker']['ticker']['low']."', ".
			"'".$btc_usd['ticker']['ticker']['avg']."', '".$btc_usd['ticker']['ticker']['vol']."', ".
			"'".$btc_usd['ticker']['ticker']['vol_cur']."', '".$btc_usd['ticker']['ticker']['last']."', ".
			"'".$btc_usd['ticker']['ticker']['buy']."', '".$btc_usd['ticker']['ticker']['sell']."', ".
			"'".$btc_usd['ticker']['ticker']['updated']."', '".$btc_usd['ticker']['ticker']['server_time']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($btc_usd['ticker']['ticker']['high'])) AND ($btc_usd['ticker']['ticker']['high']<>0) AND ($btc_usd['ticker']['ticker']['high']<>'')) {

if ((isset($ltc_btc['ticker']['ticker']['high'])) AND ($ltc_btc['ticker']['ticker']['high']<>0) AND ($ltc_btc['ticker']['ticker']['high']<>'')) {
	$sql =  "INSERT INTO `btce_ltc_btc_ticker` (`high`, `low`, `avg`, `vol`, `vol_current`, `last`, `buy`, `sell`, `updated`, `server_time`) ".
			"VALUES ('".$ltc_btc['ticker']['ticker']['high']."', '".$ltc_btc['ticker']['ticker']['low']."', ".
			"'".$ltc_btc['ticker']['ticker']['avg']."', '".$ltc_btc['ticker']['ticker']['vol']."', ".
			"'".$ltc_btc['ticker']['ticker']['vol_cur']."', '".$ltc_btc['ticker']['ticker']['last']."', ".
			"'".$ltc_btc['ticker']['ticker']['buy']."', '".$ltc_btc['ticker']['ticker']['sell']."', ".
			"'".$ltc_btc['ticker']['ticker']['updated']."', '".$ltc_btc['ticker']['ticker']['server_time']."');";
			
	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($ltc_btc['ticker']['ticker']['high'])) AND ($ltc_btc['ticker']['ticker']['high']<>0) AND ($ltc_btc['ticker']['ticker']['high']<>'')) {

if ((isset($ltc_usd['ticker']['ticker']['high'])) AND ($ltc_usd['ticker']['ticker']['high']<>0) AND ($ltc_usd['ticker']['ticker']['high']<>'')) {
	$sql =  "INSERT INTO `btce_ltc_usd_ticker` (`high`, `low`, `avg`, `vol`, `vol_current`, `last`, `buy`, `sell`, `updated`, `server_time`) ".
			"VALUES ('".$ltc_usd['ticker']['ticker']['high']."', '".$ltc_usd['ticker']['ticker']['low']."', ".
			"'".$ltc_usd['ticker']['ticker']['avg']."', '".$ltc_usd['ticker']['ticker']['vol']."', ".
			"'".$ltc_usd['ticker']['ticker']['vol_cur']."', '".$ltc_usd['ticker']['ticker']['last']."', ".
			"'".$ltc_usd['ticker']['ticker']['buy']."', '".$ltc_usd['ticker']['ticker']['sell']."', ".
			"'".$ltc_usd['ticker']['ticker']['updated']."', '".$ltc_usd['ticker']['ticker']['server_time']."');";

	if (!$debug_mode) {		
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($ltc_usd['ticker']['ticker']['high'])) AND ($ltc_usd['ticker']['ticker']['high']<>0) AND ($ltc_usd['ticker']['ticker']['high']<>'')) {

if ((isset($nmc_btc['ticker']['ticker']['high'])) AND ($nmc_btc['ticker']['ticker']['high']<>0) AND ($nmc_btc['ticker']['ticker']['high']<>'')) {
	$sql =  "INSERT INTO `btce_nmc_btc_ticker` (`high`, `low`, `avg`, `vol`, `vol_current`, `last`, `buy`, `sell`, `updated`, `server_time`) ".
			"VALUES ('".$nmc_btc['ticker']['ticker']['high']."', '".$nmc_btc['ticker']['ticker']['low']."', ".
			"'".$nmc_btc['ticker']['ticker']['avg']."', '".$nmc_btc['ticker']['ticker']['vol']."', ".
			"'".$nmc_btc['ticker']['ticker']['vol_cur']."', '".$nmc_btc['ticker']['ticker']['last']."', ".
			"'".$nmc_btc['ticker']['ticker']['buy']."', '".$nmc_btc['ticker']['ticker']['sell']."', ".
			"'".$nmc_btc['ticker']['ticker']['updated']."', '".$nmc_btc['ticker']['ticker']['server_time']."');";

	if (!$debug_mode) {		
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($nmc_btc['ticker']['ticker']['high'])) AND ($nmc_btc['ticker']['ticker']['high']<>0) AND ($nmc_btc['ticker']['ticker']['high']<>'')) {

if ((isset($nmc_usd['ticker']['ticker']['high'])) AND ($nmc_usd['ticker']['ticker']['high']<>0) AND ($nmc_usd['ticker']['ticker']['high']<>'')) {
	$sql =  "INSERT INTO `btce_nmc_usd_ticker` (`high`, `low`, `avg`, `vol`, `vol_current`, `last`, `buy`, `sell`, `updated`, `server_time`) ".
			"VALUES ('".$nmc_usd['ticker']['ticker']['high']."', '".$nmc_usd['ticker']['ticker']['low']."', ".
			"'".$nmc_usd['ticker']['ticker']['avg']."', '".$nmc_usd['ticker']['ticker']['vol']."', ".
			"'".$nmc_usd['ticker']['ticker']['vol_cur']."', '".$nmc_usd['ticker']['ticker']['last']."', ".
			"'".$nmc_usd['ticker']['ticker']['buy']."', '".$nmc_usd['ticker']['ticker']['sell']."', ".
			"'".$nmc_usd['ticker']['ticker']['updated']."', '".$nmc_usd['ticker']['ticker']['server_time']."');";
			
	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($nmc_usd['ticker']['ticker']['high'])) AND ($nmc_usd['ticker']['ticker']['high']<>0) AND ($nmc_usd['ticker']['ticker']['high']<>'')) {

if ((isset($ppc_btc['ticker']['ticker']['high'])) AND ($ppc_btc['ticker']['ticker']['high']<>0) AND ($ppc_btc['ticker']['ticker']['high']<>'')) {
	$sql =  "INSERT INTO `btce_ppc_btc_ticker` (`high`, `low`, `avg`, `vol`, `vol_current`, `last`, `buy`, `sell`, `updated`, `server_time`) ".
			"VALUES ('".$ppc_btc['ticker']['ticker']['high']."', '".$ppc_btc['ticker']['ticker']['low']."', ".
			"'".$ppc_btc['ticker']['ticker']['avg']."', '".$ppc_btc['ticker']['ticker']['vol']."', ".
			"'".$ppc_btc['ticker']['ticker']['vol_cur']."', '".$ppc_btc['ticker']['ticker']['last']."', ".
			"'".$ppc_btc['ticker']['ticker']['buy']."', '".$ppc_btc['ticker']['ticker']['sell']."', ".
			"'".$ppc_btc['ticker']['ticker']['updated']."', '".$ppc_btc['ticker']['ticker']['server_time']."');";

	if (!$debug_mode) {		
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($ppc_btc['ticker']['ticker']['high'])) AND ($ppc_btc['ticker']['ticker']['high']<>0) AND ($ppc_btc['ticker']['ticker']['high']<>'')) {

if ((isset($ppc_usd['ticker']['ticker']['high'])) AND ($ppc_usd['ticker']['ticker']['high']<>0) AND ($ppc_usd['ticker']['ticker']['high']<>'')) {
	$sql =  "INSERT INTO `btce_ppc_usd_ticker` (`high`, `low`, `avg`, `vol`, `vol_current`, `last`, `buy`, `sell`, `updated`, `server_time`) ".
			"VALUES ('".$ppc_usd['ticker']['ticker']['high']."', '".$ppc_usd['ticker']['ticker']['low']."', ".
			"'".$ppc_usd['ticker']['ticker']['avg']."', '".$ppc_usd['ticker']['ticker']['vol']."', ".
			"'".$ppc_usd['ticker']['ticker']['vol_cur']."', '".$ppc_usd['ticker']['ticker']['last']."', ".
			"'".$ppc_usd['ticker']['ticker']['buy']."', '".$ppc_usd['ticker']['ticker']['sell']."', ".
			"'".$ppc_usd['ticker']['ticker']['updated']."', '".$ppc_usd['ticker']['ticker']['server_time']."');";
			
	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($ppc_usd['ticker']['ticker']['high'])) AND ($ppc_usd['ticker']['ticker']['high']<>0) AND ($ppc_usd['ticker']['ticker']['high']<>'')) {

//Inserting the trade data into the database
foreach ($btc_usd['trades'] as $trade) {
	$sql =  "INSERT INTO `btce_trades` (`date`, `price`, `amount`, `tid`, `price_currency`, `item`, `trade_type`) ".
			"VALUES ('".$trade['date']."', '".$trade['price']."', '".$trade['amount']."', '".$trade['tid']."', ".
			"'".$trade['price_currency']."', '".$trade['item']."', '".$trade['trade_type']."');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($btc_usd['trades'] as $trade) {
foreach ($ltc_btc['trades'] as $trade) {
	$sql =  "INSERT INTO `btce_trades` (`date`, `price`, `amount`, `tid`, `price_currency`, `item`, `trade_type`) ".
			"VALUES ('".$trade['date']."', '".$trade['price']."', '".$trade['amount']."', '".$trade['tid']."', ".
			"'".$trade['price_currency']."', '".$trade['item']."', '".$trade['trade_type']."');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($ltc_btc['trades'] as $trade) {
foreach ($ltc_usd['trades'] as $trade) {
	$sql =  "INSERT INTO `btce_trades` (`date`, `price`, `amount`, `tid`, `price_currency`, `item`, `trade_type`) ".
			"VALUES ('".$trade['date']."', '".$trade['price']."', '".$trade['amount']."', '".$trade['tid']."', ".
			"'".$trade['price_currency']."', '".$trade['item']."', '".$trade['trade_type']."');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($ltc_usd['trades'] as $trade) {
foreach ($nmc_btc['trades'] as $trade) {
	$sql =  "INSERT INTO `btce_trades` (`date`, `price`, `amount`, `tid`, `price_currency`, `item`, `trade_type`) ".
			"VALUES ('".$trade['date']."', '".$trade['price']."', '".$trade['amount']."', '".$trade['tid']."', ".
			"'".$trade['price_currency']."', '".$trade['item']."', '".$trade['trade_type']."');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($nmc_btc['trades'] as $trade) {
foreach ($nmc_usd['trades'] as $trade) {
	$sql =  "INSERT INTO `btce_trades` (`date`, `price`, `amount`, `tid`, `price_currency`, `item`, `trade_type`) ".
			"VALUES ('".$trade['date']."', '".$trade['price']."', '".$trade['amount']."', '".$trade['tid']."', ".
			"'".$trade['price_currency']."', '".$trade['item']."', '".$trade['trade_type']."');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($nmc_usd['trades'] as $trade) {
foreach ($ppc_btc['trades'] as $trade) {
	$sql =  "INSERT INTO `btce_trades` (`date`, `price`, `amount`, `tid`, `price_currency`, `item`, `trade_type`) ".
			"VALUES ('".$trade['date']."', '".$trade['price']."', '".$trade['amount']."', '".$trade['tid']."', ".
			"'".$trade['price_currency']."', '".$trade['item']."', '".$trade['trade_type']."');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($ppc_btc['trades'] as $trade) {
foreach ($ppc_usd['trades'] as $trade) {
	$sql =  "INSERT INTO `btce_trades` (`date`, `price`, `amount`, `tid`, `price_currency`, `item`, `trade_type`) ".
			"VALUES ('".$trade['date']."', '".$trade['price']."', '".$trade['amount']."', '".$trade['tid']."', ".
			"'".$trade['price_currency']."', '".$trade['item']."', '".$trade['trade_type']."');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($ppc_usd['trades'] as $trade) {

//Close the database connection
if (!$debug_mode) {
	mysqli_close($conn);
} //end if (!$debug_mode) {
?>
