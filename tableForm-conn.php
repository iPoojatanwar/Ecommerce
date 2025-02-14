<?php
require "connection.php";

// $dbase = "CREATE DATABASE user";

// $result = mysqli_query($database_conn, $dbase);
//  echo $result ? "created" : "not created";

$table_data= "CREATE TABLE tdata(
Sr_no INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
First_name VARCHAR(67) NOT NULL ,
Last_name VARCHAR(80) NOT NULL,
E_mail VARCHAR(255) NOT NULL UNIQUE,
Phone_no INT NOT NULL UNIQUE,
Pasword VARCHAR(255) NOT NULL 
)";
$result = mysqli_query( $database_conn , $table_data);
// echo $result ? "yes" : "no";
?>