#!/bin/bash

#checks for arguments when the script is ran
status="pendingTest"

if [ $# -lt 1 ] ; then
	#if more than 2 arguments script stops
	echo "Please provide version number"
	#echo $heckStatus
	exit
elif [ $# -ge 2 ] ; then
	#if more than 2 arguments script stops
	echo "Too many arguments, only one argument accepted"
	#echo $heckStatus
	exit
fi

#sets the version variable to the current date/time
version=$1;
echo "Version: "$version

#bundles the two directories into a .tar file and appends the version variable to the file name
cd /home/$USER/Documents
tar -cf fe_$version.tar it490-zomato

#/var/www/html/it490-zomato

#directory of bundle created
tardir=/home/jay/bundles/fe_$version.tar
echo "Directory: "$tardir

pwd
ls

#send .tar file to deployment server
sshpass -p "12345" scp fe_$version.tar jay@192.168.1.11:/home/jay/bundles
rm -rf fe_$version.tar

#runs php script with 4 arguments php /home/$USER/bin/deployFunctions.php "package" "$tardir" "$heckStatus" "latest"
sshpass -p "12345" ssh jay@192.168.1.11 "php -f /home/jay/Documents/deployment/php/functions.php 'bundle' '$tardir' '$status' 'fe'"


ls