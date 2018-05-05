<?php

global $argv;
//connect to db
$mysqli = new mysqli("127.0.0.1","root","pc329pw","packages");//Your DB info here (localhost, mysql root, mysql pass, database)

//connection status

if ($mysqli->connect_errno) {
	die("Connection failed: " . $mysqli->connect_error);
}
echo "Connected Successfully"."\r\n";

$statement="";

//takes arguments from bash scripts
	//Takes in arguments given by packageHeck
	if ($argv[1] == "package"){
	//inserts new path name and status of new version into database	
	$statement = "INSERT INTO packageTable(path, status) VALUES ('$argv[2]', '$argv[3]');";
	echo "New record created successfully"."\r\n";
	}
	//Takes in arguments given by installHeck if most recent version is wanted
	elseif ($argv[1] == "extract" && $argv[4] == "latest"){
	//pulls path name from database of most recent WORKING version		
	$statement = "SELECT path FROM packageTable WHERE status='working' ORDER BY version DESC LIMIT 1;";
	echo "Extracted latest file"."\r\n";
	}
	//Takes in arguments given by installHeck if a QA version is wanted 
	elseif ($argv[1] == "extract" && $argv[4] == "QA"){
	//pulls path name of the latest version where its status is QA
	$statement = "SELECT path FROM packageTable WHERE status='QA' ORDER BY version DESC LIMIT 1;";
	echo "Extracted latest QA file"."\r\n";
	}
	//Takes in arguments given by installHeck with specified version wanted
	elseif ($argv[1] == "extract" && $argv[4] == "V"){
	//pulls path name of the specificed version given in the arguments by installHeck
	$statement = "SELECT path FROM packageTable WHERE version='$argv[5]';";
	}
	//Takes in arguments given by rollbackHeck
	elseif ($argv[1] == "rollback"){
	//pulls path name of most recent working version
	$statement = "SELECT path FROM packageTable WHERE status='working' ORDER BY version DESC LIMIT 1;";
	}
	else {
	//something went wrong
	echo "Unrecognized Instruction"."\r\n";
	}
//inserts data in to db or quits
$result = $mysqli->query($statement);
//confirmation if-else statement for testing
if ($result === TRUE) {
	echo "Query sent successfully"."\r\n";
}
elseif ($result->num_rows > 0) {
	echo "Query sent successfully"."\r\n";
	while($row = mysqli_fetch_assoc($result)) {
        	//echo "path: ".$row["path"]."\r\n";
		$pathdir = $row["path"];
		file_put_contents("/home/pc329/bin/latest",$pathdir);

		
	}
}
else {
	echo "Error: " . $statement . "\r\n" . $mysqli->connect_error;
}


//disconnects from db
$mysqli->close();

?>
