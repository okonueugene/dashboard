<?php

//start session
session_start();

//connect to database
include 'dbconnect.php';

//salt for password
$salt = date('Ymd');

//get user id from url
$user_id = $_GET['user_id'] ? $_GET ['user_id']-$salt : 14;
//get site id from url
$site_id = $_GET['site_id'] ? $_GET ['site_id']-$salt : 29;

//save user id and site id to session
$_SESSION['user_id'] = $user_id;
$_SESSION['site_id'] = $site_id;

//get user name
$sql = "SELECT `name` FROM users WHERE id = $user_id";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as an array//Patrol Summary

$user = mysqli_fetch_assoc($result);
//free result from memory
mysqli_free_result($result);


//Site name
$sql = "SELECT `name` FROM sites WHERE id = $site_id";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$site = mysqli_fetch_assoc($result);
//free result from memory
mysqli_free_result($result);


//Site Timezone
$sql = "SELECT `timezone` FROM sites WHERE id = $site_id";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$timezone = mysqli_fetch_assoc($result);
//free result from memory
mysqli_free_result($result);




//Total Guards for Site
$sql = "SELECT COUNT(*) FROM guards WHERE site_id = $site_id";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$guards = mysqli_fetch_assoc($result);
//free result from memory
mysqli_free_result($result);


//Patrols where start time is less than current time and end time is greater than current time
$sql = "SELECT COUNT(*) FROM patrols WHERE site_id = $site_id AND start < CURRENT_TIME AND end > CURRENT_TIME";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$elapsed = mysqli_fetch_assoc($result);
//free result from memory
mysqli_free_result($result);


//Total patrols for Site
$sql = "SELECT COUNT(*) FROM patrols WHERE site_id = $site_id";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$patrols = mysqli_fetch_assoc($result);
//free result from memory
mysqli_free_result($result);



//Total Checkpoint Summary
$sql = "SELECT COUNT(pt.id) AS tag_count FROM patrols p INNER JOIN patrol_tag pt ON p.id = pt.patrol_id WHERE p.site_id = $site_id";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$checkpoint = mysqli_fetch_assoc($result);
//free result from memory
mysqli_free_result($result);



//Scanned Checkpoints today
$sql = "SELECT COUNT(*) FROM patrol_histories WHERE site_id = $site_id AND status = 'checked' AND DATE(created_at) = CURRENT_DATE";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$scanned = mysqli_fetch_assoc($result);
//free result from memory
mysqli_free_result($result);

// //Coming Soon heckpoint
// $sql = "SELECT COUNT(*) FROM patrol_histories WHERE site_id = $site_id AND status = 'upcoming' AND DATE(created_at) = CURRENT_DATE";
// //run query
// $result = mysqli_query($conn, $sql);
// //fetch result as a string
// $upcoming = mysqli_fetch_assoc($result);
// //free result from memory
// mysqli_free_result($result);

//Missed Checkpoint
$sql = "SELECT COUNT(*) FROM patrol_histories WHERE site_id = $site_id AND status = 'missed' AND DATE(created_at) = CURRENT_DATE";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$missed = mysqli_fetch_assoc($result);
//free result from memory
mysqli_free_result($result);





//Attendance Summary
$sqt = "SELECT COUNT(*) as `attendance` FROM `attendances` WHERE `site_id` =38 AND DATE(created_at) = CURRENT_DATE;
";
//run query
$result = mysqli_query($conn, $sqt);
//fetch result as a string
$attendance = mysqli_fetch_assoc($result);
//free result from memory
mysqli_free_result($result);




//Tasks Summary


//Count completed tasks
$sql = "SELECT COUNT(*) FROM tasks WHERE site_id = $site_id AND status = 'completed'";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$completed = mysqli_fetch_assoc($result);
//free result from memory
mysqli_free_result($result);

//Count incomplete tasks
$sql = "SELECT COUNT(*) FROM tasks WHERE site_id = $site_id AND status = 'pending'";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$incomplete = mysqli_fetch_assoc($result);
//free result from memory
mysqli_free_result($result);


//Count all site tasks
$sql = "SELECT COUNT(*) FROM tasks WHERE site_id = $site_id";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$tasks = mysqli_fetch_assoc($result);
//free result from memory
mysqli_free_result($result);

//fetch all tasks as object
$sql = "SELECT * FROM tasks WHERE site_id = $site_id ORDER BY id DESC LIMIT 5";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
//free result from memory
mysqli_free_result($result);




//Incidents Summary

//get all incidents for site as object
$sql = "SELECT * FROM incidents WHERE site_id = $site_id ORDER BY id DESC LIMIT 5";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$incidents = mysqli_fetch_all($result, MYSQLI_ASSOC);
//free result from memory
mysqli_free_result($result);

//Live Patrols

$sql="SELECT * FROM patrol_histories WHERE site_id = $site_id AND status = 'checked' AND date = CURRENT_DATE ORDER BY id DESC LIMIT 5";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$livepatrols = mysqli_fetch_all($result, MYSQLI_ASSOC);
//free result from memory
mysqli_free_result($result);


//All Sites id and name as key value pair
$sql = "SELECT `id`, `name` FROM sites";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$allsites = array();
while($row = mysqli_fetch_assoc($result)) {
    $allsites[$row['id']] = $row['name'];
}
//free result from memory
mysqli_free_result($result);

//All Guards id and name as key value pair
$sql = "SELECT `id`, `name` FROM guards";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$allguards = array();
while($row = mysqli_fetch_assoc($result)) {
    $allguards[$row['id']] = $row['name'];
}

//free result from memory
mysqli_free_result($result);

//All Tag id and name as key value pair
$sql = "SELECT `id`, `name` FROM tags";
//run query
$result = mysqli_query($conn, $sql);
//fetch result as a string
$alltags = array();
while($row = mysqli_fetch_assoc($result)) {
    $alltags[$row['id']] = $row['name'];
}

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



//Miscellaneous Calculations

//Get average for checkpoints
$average =  implode('', $scanned)/implode('', $checkpoint) * 100;


//Cartegories
$categories = [['Scanned'], ['Missed'] , ['Upcoming']];

$sitename = rtrim(implode('', $site));

//upcoming

$difference = implode('', $checkpoint) - implode('', $scanned);

//if difference is negative set upcoming to 0 using ternary operator
$upcoming = $difference < 0 ? 0 : $difference;


//search query
$url = 'http://images.optitech.co.ke/api/search?q=' . urlencode($sitename);

$response = file_get_contents($url);
$data = json_decode($response, true);

//get logo url
$logo =$data['imageUrls'][1];
