<?php
	// Start Session
	session_start();
	
	//connecting to SQL server
	$conn = mysqli_connect("localhost","root","");
	// Create database
	$query= "CREATE DATABASE IF NOT EXISTS training";
   	
   	// Executing Query
   	if(!mysqli_query($conn,$query)){
	 echo "Error creating database: " . mysqli_error($conn);
	}

	$conn = mysqli_connect("localhost","root","","training");
	//check connection
	if(!$conn) {die("connection falied: " . mysqli_connect_error()); }
	
	// Create Table
	$query = "CREATE TABLE IF NOT EXISTS `registration` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(50) NOT NULL,
	  `gender` varchar(10)  NOT NULL,
	  `college` varchar(200) NOT NULL,
	  `email` varchar(80)  NOT NULL,
	  `password` varchar(200) NOT NULL,
	  `mobile` bigint(20) NOT NULL,
	  `state` varchar(50) NOT NULL,
	  `address` varchar(200) NOT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE (`email`)
	) AUTO_INCREMENT=1" ;
	
	// Executing creating table query
	if(!mysqli_query($conn,$query)){
	 echo "Error creating table: " . mysqli_error($conn);
	}

	$query = "CREATE TABLE IF NOT EXISTS `sem1` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `subject1` int(3),
	  `subject2` int(3),
	  `subject3` int(3),
	  `subject4` int(3),
	  `user_id` int(11),
      FOREIGN KEY (user_id) REFERENCES registration(id),
 	  PRIMARY KEY (`id`)
	)AUTO_INCREMENT=1" ;

	// Executing creating table query
	if(!mysqli_query($conn,$query)){
	 echo "Error creating table: " . mysqli_error($conn);
	}


	$query = "CREATE TABLE IF NOT EXISTS `sem2` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `subject1` int(3),
	  `subject2` int(3),
	  `subject3` int(3),
	  `subject4` int(3),
	  `user_id` int(11),
      FOREIGN KEY (user_id) REFERENCES registration(id),
 	  PRIMARY KEY (`id`)
	)AUTO_INCREMENT=1" ;

	// Executing creating table query
	if(!mysqli_query($conn,$query)){
	 echo "Error creating table: " . mysqli_error($conn);
	}

?>