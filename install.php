<?php
	/*
	 *
	 *
	 *
	 *
	 */

define('BASEPATH', ''); // Defined to gain access to database.php

require_once('./application/config/database.php');

// MySQL connection
$link = mysqli_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password']);

if($link->connect_error)
	die("Failed to connect : " . $link->connect_error);
else
	echo "Successfully connected to MySQL.<br/>";


// If a previous version of the database exists it is removed
$sql = "DROP DATABASE IF EXISTS askaround";

if(!$link->query($sql))
	die("An error occured while removing the database.<br/>");
else
	echo "Previous database successfully removed.<br/>";



// Database creation
$sql = "CREATE DATABASE askaround";

if(!$link->query($sql))
	die("An error occured while creating the database.<br/>");
else
	echo "Database successfully created.<br/>";

$link->close();




// MySQL connection
$link = mysqli_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);

if($link->connect_error)
	die("Failed to connect : " . $link->connect_error);
else
	echo "Successfully connected to MySQL.<br/>";

// Table aa_ask creation
$sql = 
	"CREATE TABLE aa_ask (
	 id int(11) NOT NULL AUTO_INCREMENT,
 	 id_quest int(11) NOT NULL,
  	 title text NOT NULL,
  	 text text NOT NULL,
  	 date int(11) NOT NULL,
  	 author_id int(11) NOT NULL,
  	 PRIMARY KEY (id)
	 ) ENGINE=InnoDB  DEFAULT CHARSET=latin1";

if(!$link->query($sql))
	die("An error occured while creating the table aa_ask.<br/>");
else
	echo "Table aa_ask successfully created.<br/>";

// Table aa_users creation
$sql = 
	"CREATE TABLE aa_users (
  	id int(11) NOT NULL AUTO_INCREMENT,
  	pseudo varchar(100) NOT NULL,
  	email varchar(100) NOT NULL,
  	password varchar(32) NOT NULL,
  	color varchar(6) NOT NULL,
  	PRIMARY KEY (id)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1";

if(!$link->query($sql))
	die("An error occured while creating the table aa_users.<br/>");
else
	echo "Table aa_users successfully created.<br/>";

// Table aa_views creation
$sql = 
	"CREATE TABLE aa_views (
  	id int(11) NOT NULL AUTO_INCREMENT,
  	id_quest int(11) NOT NULL,
  	id_user int(11) NOT NULL,
  	time int(11) NOT NULL,
  	PRIMARY KEY (id)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1";

if(!$link->query($sql))
	die("An error occured while creating the table aa_views.<br/>".$link->sta);
else
	echo "Table aa_views successfully created.<br/>";

// Table aa_votes creation
$sql = 
	"CREATE TABLE aa_votes (
  	id int(11) NOT NULL AUTO_INCREMENT,
  	id_ask int(11) NOT NULL,
  	id_voting_user int(11) NOT NULL,
  	value int(11) NOT NULL,
  	PRIMARY KEY (id)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if(!$link->query($sql))
	die("An error occured while creating the table aa_votes.<br/>".$link->sta);
else
	echo "Table aa_votes successfully created.<br/>";


// First entries

$sql = 
	"INSERT INTO `aa_users` (`id`, `pseudo`, `email`, `password`, `color`) VALUES
	(1, 'max', 'max@max.max', '".md5('maxmax')."', 'c82c2f'),
	(2, 'bob', 'bob@bob.bob', '".md5('bobbob')."', '0096fd')";

if(!$link->query($sql))
	die("An error occured while adding data to the aa_users table.<br/>".$link->sta);
else
	echo "Data successfully added to the table aa_users.<br/>";

$sql = 
	"INSERT INTO `aa_ask` (`id`, `id_quest`, `title`, `text`, `date`, `author_id`) VALUES
	(1, -1, 'Hello ?', 'Hello ?', 1400547124, 1),
	(2, 1, '', 'Hello !', 1400547134, 2)";

if(!$link->query($sql))
	die("An error occured while adding data to the aa_ask table.<br/>".$link->sta);
else
	echo "Data successfully added to the table aa_ask.<br/>";

$sql = 
	"INSERT INTO `aa_votes` (`id`, `id_ask`, `id_voting_user`, `value`) VALUES
	(1, 2, 1, 1)";

if(!$link->query($sql))
	die("An error occured while adding data to the aa_votes table.<br/>".$link->sta);
else
	echo "Data successfully added to the table aa_votes.<br/>";
?>