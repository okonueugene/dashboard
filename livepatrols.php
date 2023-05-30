<?php

include 'dbconnect.php';

//salt for password
$salt = date('Ymd');

//get user id from url
$user_id = $_GET['user_id'] ? $_GET ['user_id']-$salt : 25;
//get site id from url
$site_id = $_GET['site_id'] ? $_GET ['site_id']-$salt : 38;


//Live Patrols

$sql="SELECT * FROM patrol_histories WHERE site_id = $site_id AND status = 'checked' AND date = CURRENT_DATE ORDER BY id DESC LIMIT 5";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$patrols = mysqli_fetch_all($result, MYSQLI_ASSOC);
//free result from memory
mysqli_free_result($result);

//Attendance Summary
$sql = "SELECT * FROM `attendances` WHERE `site_id` =$site_id AND DATE(created_at) = CURRENT_DATE;
";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$records = mysqli_fetch_all($result, MYSQLI_ASSOC);
//free result from memory
mysqli_free_result($result);

//Total Hours Logged
$sql ="SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(time_out, time_in)))) AS `total_hours` FROM `attendances` WHERE `site_id` =$site_id AND DATE(created_at) = CURRENT_DATE;";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$hours = mysqli_fetch_assoc($result);
//free result from memory
mysqli_free_result($result);

// json encode the data array with hours and records as attendance
$attendance = array(
    'hours' => $hours,
    'records' => $records
);

//json encode the data array with patrols and attendance
$data = array(
    'patrols' => $patrols,
    'attendance' => $attendance
);

echo json_encode($data);
