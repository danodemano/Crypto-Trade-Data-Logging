<?php
//Function to get control data from the database
//********************************************************************************
//Inputs:
//$control - The control value to get
//********************************************************************************
//Returns the value or 'unknown' if the config isn't found in the database
function get_control($control, $conn, $exchange) {
	//The query string
	$query = "SELECT `value` FROM `".$exchange."_control` WHERE `field`='$control'";
	
	//Run the query to get the value
	$res = mysqli_query($conn, $query) or die('Error, query failed. ' . mysqli_error($conn) . "<br>Line: ".__LINE__ ."<br>File: ".__FILE__);
	
	//If the query returned a result, we will use that
	//Otherwise we have to return unknown
	if(mysqli_num_rows($res) <> 0) {
		//Use the value from the query
		$array = mysqli_fetch_array($res);
		$return_value = $array[0];
	}else{
		//We cannot determine the value, return unknown
		$return_value = 'unknown';
	} //end if(mysqli_num_rows($result) <> 0) {
	return $return_value;
} //end function get_control($control) {

//Function to set control data in the database
//********************************************************************************
//Inputs:
//$field - The control value to set
//$value - The value to set it to
//********************************************************************************
//There is nothing returned
function set_control($field, $value, $conn, $exchange) {
	//Simple query to set the control value in the database
	$sql = "INSERT INTO `".$exchange."_control` (`field`, `value`) VALUES ('$field', '$value') ON DUPLICATE KEY UPDATE `field`='$field', `value`='$value'";
	//$sql = "UPDATE `".$exchange."_control` SET `value`='$value' WHERE `field`='$field'";
	mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . "<br>Line: ".__LINE__ ."<br>File: ".__FILE__);
} //end function set_control($field, $value) {
?>
