<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
header('Content-type: text/html; charset=utf-8');
require_once 'config.php';

if( isset( $_GET['start'] ) && isset( $_GET['limit'] ) && !empty( $_GET['start'] ) && !empty( $_GET['limit'] ) ){
	$start = $_GET['start'];
	$limit = $_GET['limit'];
	$query = "SELECT * FROM timeline limit $start, $limit";
	$result = mysqli_query($con, $query) or die('Error: ' . mysqli_error($con));
	$data = array();
	$rowcount = mysqli_num_rows($result);
	$data['count'] = $rowcount;
	while($row = mysqli_fetch_assoc($result)) {
            $row= array_map('utf8_encode', $row);
		$data['content'][] = $row;
	}
        //print_r (($data));
	mysqli_close($con);
	echo json_encode($data);
        //exit;	
}