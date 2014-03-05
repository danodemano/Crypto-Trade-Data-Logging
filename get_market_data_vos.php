<?php
//Enable debugging - disable when going live
$debug_mode = false;

//All the data arrays we need to fill
$btc_usd = array();
$ltc_usd = array();
$ppc_usd = array();
$doge_usd = array();
$xpm_usd = array();

//Get all the ticker data
$btc_usd['ticker'] = json_decode(file_get_contents("https://api.vaultofsatoshi.com/public/ticker?order_currency=BTC&payment_currency=USD"), true);
$ltc_usd['ticker'] = json_decode(file_get_contents("https://api.vaultofsatoshi.com/public/ticker?order_currency=LTC&payment_currency=USD"), true);
$ppc_usd['ticker'] = json_decode(file_get_contents("https://api.vaultofsatoshi.com/public/ticker?order_currency=PPC&payment_currency=USD"), true);
$doge_usd['ticker'] = json_decode(file_get_contents("https://api.vaultofsatoshi.com/public/ticker?order_currency=DOGE&payment_currency=USD"), true);
$xpm_usd['ticker'] = json_decode(file_get_contents("https://api.vaultofsatoshi.com/public/ticker?order_currency=XPM&payment_currency=USD"), true);

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
if ((isset($btc_usd['ticker']['data']['max_price']['value'])) AND ($btc_usd['ticker']['data']['max_price']['value']<>0) AND ($btc_usd['ticker']['data']['max_price']['value']<>'')) {
	$sql =  "INSERT INTO `vos_btc_usd_ticker` (`date`, `opening_price`, `closing_price`, `units_traded`, `max_price`, `min_price`, `average_price`, `volume_1day`, `volume_7day`) ".
			"VALUES ('".$btc_usd['ticker']['data']['date']."', '".$btc_usd['ticker']['data']['opening_price']['value']."', ".
			"'".$btc_usd['ticker']['data']['closing_price']['value']."', '".$btc_usd['ticker']['data']['units_traded']['value']."', ".
			"'".$btc_usd['ticker']['data']['max_price']['value']."', '".$btc_usd['ticker']['data']['min_price']['value']."', ".
			"'".$btc_usd['ticker']['data']['average_price']['value']."', '".$btc_usd['ticker']['data']['volume_1day']['value']."', ".
			"'".$btc_usd['ticker']['data']['volume_7day']['value']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($btc_usd['ticker']['data']['max_price']['value'])) AND ($btc_usd['ticker']['data']['max_price']['value']<>0) AND ($btc_usd['ticker']['data']['max_price']['value']<>'')) {

if ((isset($ltc_usd['ticker']['data']['max_price']['value'])) AND ($ltc_usd['ticker']['data']['max_price']['value']<>0) AND ($ltc_usd['ticker']['data']['max_price']['value']<>'')) {
	$sql =  "INSERT INTO `vos_ltc_usd_ticker` (`date`, `opening_price`, `closing_price`, `units_traded`, `max_price`, `min_price`, `average_price`, `volume_1day`, `volume_7day`) ".
			"VALUES ('".$ltc_usd['ticker']['data']['date']."', '".$ltc_usd['ticker']['data']['opening_price']['value']."', ".
			"'".$ltc_usd['ticker']['data']['closing_price']['value']."', '".$ltc_usd['ticker']['data']['units_traded']['value']."', ".
			"'".$ltc_usd['ticker']['data']['max_price']['value']."', '".$ltc_usd['ticker']['data']['min_price']['value']."', ".
			"'".$ltc_usd['ticker']['data']['average_price']['value']."', '".$ltc_usd['ticker']['data']['volume_1day']['value']."', ".
			"'".$ltc_usd['ticker']['data']['volume_7day']['value']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($ltc_usd['ticker']['data']['max_price']['value'])) AND ($ltc_usd['ticker']['data']['max_price']['value']<>0) AND ($ltc_usd['ticker']['data']['max_price']['value']<>'')) {

if ((isset($ppc_usd['ticker']['data']['max_price']['value'])) AND ($ppc_usd['ticker']['data']['max_price']['value']<>0) AND ($ppc_usd['ticker']['data']['max_price']['value']<>'')) {
	$sql =  "INSERT INTO `vos_ppc_usd_ticker` (`date`, `opening_price`, `closing_price`, `units_traded`, `max_price`, `min_price`, `average_price`, `volume_1day`, `volume_7day`) ".
			"VALUES ('".$ppc_usd['ticker']['data']['date']."', '".$ppc_usd['ticker']['data']['opening_price']['value']."', ".
			"'".$ppc_usd['ticker']['data']['closing_price']['value']."', '".$ppc_usd['ticker']['data']['units_traded']['value']."', ".
			"'".$ppc_usd['ticker']['data']['max_price']['value']."', '".$ppc_usd['ticker']['data']['min_price']['value']."', ".
			"'".$ppc_usd['ticker']['data']['average_price']['value']."', '".$ppc_usd['ticker']['data']['volume_1day']['value']."', ".
			"'".$ppc_usd['ticker']['data']['volume_7day']['value']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($ppc_usd['ticker']['data']['max_price']['value'])) AND ($ppc_usd['ticker']['data']['max_price']['value']<>0) AND ($ppc_usd['ticker']['data']['max_price']['value']<>'')) {

if ((isset($doge_usd['ticker']['data']['max_price']['value'])) AND ($doge_usd['ticker']['data']['max_price']['value']<>0) AND ($doge_usd['ticker']['data']['max_price']['value']<>'')) {
	$sql =  "INSERT INTO `vos_doge_usd_ticker` (`date`, `opening_price`, `closing_price`, `units_traded`, `max_price`, `min_price`, `average_price`, `volume_1day`, `volume_7day`) ".
			"VALUES ('".$doge_usd['ticker']['data']['date']."', '".$doge_usd['ticker']['data']['opening_price']['value']."', ".
			"'".$doge_usd['ticker']['data']['closing_price']['value']."', '".$doge_usd['ticker']['data']['units_traded']['value']."', ".
			"'".$doge_usd['ticker']['data']['max_price']['value']."', '".$doge_usd['ticker']['data']['min_price']['value']."', ".
			"'".$doge_usd['ticker']['data']['average_price']['value']."', '".$doge_usd['ticker']['data']['volume_1day']['value']."', ".
			"'".$doge_usd['ticker']['data']['volume_7day']['value']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($doge_usd['ticker']['data']['max_price']['value'])) AND ($doge_usd['ticker']['data']['max_price']['value']<>0) AND ($doge_usd['ticker']['data']['max_price']['value']<>'')) {

if ((isset($xpm_usd['ticker']['data']['max_price']['value'])) AND ($xpm_usd['ticker']['data']['max_price']['value']<>0) AND ($xpm_usd['ticker']['data']['max_price']['value']<>'')) {
	$sql =  "INSERT INTO `vos_xpm_usd_ticker` (`date`, `opening_price`, `closing_price`, `units_traded`, `max_price`, `min_price`, `average_price`, `volume_1day`, `volume_7day`) ".
			"VALUES ('".$xpm_usd['ticker']['data']['date']."', '".$xpm_usd['ticker']['data']['opening_price']['value']."', ".
			"'".$xpm_usd['ticker']['data']['closing_price']['value']."', '".$xpm_usd['ticker']['data']['units_traded']['value']."', ".
			"'".$xpm_usd['ticker']['data']['max_price']['value']."', '".$xpm_usd['ticker']['data']['min_price']['value']."', ".
			"'".$xpm_usd['ticker']['data']['average_price']['value']."', '".$xpm_usd['ticker']['data']['volume_1day']['value']."', ".
			"'".$xpm_usd['ticker']['data']['volume_7day']['value']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($xpm_usd['ticker']['data']['max_price']['value'])) AND ($xpm_usd['ticker']['data']['max_price']['value']<>0) AND ($xpm_usd['ticker']['data']['max_price']['value']<>'')) {

//Close the database connection
if (!$debug_mode) {
	mysqli_close($conn);
} //end if (!$debug_mode) {
?>
