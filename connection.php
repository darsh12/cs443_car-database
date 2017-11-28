<?php
$localhost=getenv('MYSQL_LOCAL');
$user=getenv('MYSQL_USER');
$pass=getenv('MYSQL_PASSWORD');
$db=getenv('MYSQL_DATABASE');
$dsn=getenv('MYSQL_DSN');

$conn =  mysqli_connect($localhost, $user, $pass, $db);
// $connection = new mysqli(null, $user, $pass, $db, null, $dsn);  Template
//  $conn = mysqli_connect(null, $user, $pass, $db, null, $dsn);

if (!$conn) {
    echo("Something wrong\n".mysqli_connect_error());
}
