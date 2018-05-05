#!/bin/bash

#checks for arguments when the script is ran
heckStatus=""
if [ $# -lt 1 ] ; then
	#no arguments defaults to "latest"
	heckStatus="latest"
	echo "Extracting latest bundle"
	#echo $heckStatus
elif [ $# -ge 2 ] ; then
	#if more than 2 arguments script stops
	echo "Too many arguments, only one argument accepted"
	#echo $heckStatus
	exit
elif [ $1 == "QA" ] ; then
	#accepts the "QA" argument
	heckStatus="QA"
	echo "Extracting latest QA bundle"
	#echo $heckStatus
elif [ $1 == "V" ] ; then
	#accepts the "V" argument (version)
	heckStatus="V"
	echo "Enter version number to extract"
	read versionNumber
	#heckStatus="$versionNumber"
	echo "Extracting bundle version: $versionNumber"
	#echo $heckStatus
elif [ $1 != "V" ] || [ $1 != "QA" ]; then
	#rejects any other argument
	echo "Not a valid argument (only 'notworking' or 'QA' are valid)"
	exit
fi

#runs php script with 2 arguments
#data=$(php -f /home/$USER/bin/deployFunctions.php "extract" "" "" "latest")
#eval $data
sshpass -p "pc329pw" ssh pc329@192.168.1.46 "php -f /home/pc329/bin/deployFunctions.php 'extract' '' '' '$heckStatus' '$versionNumber'"

#creates temporary folder to store extractions
mkdir /tmp/data

#gets the directory of the latest file
data=$(sshpass -p "pc329pw" ssh pc329@192.168.1.46 "cat /home/pc329/bin/latest")
echo $data

#downloads the .tar file
#cd /home/$USER/bundles
sshpass -p "pc329pw" scp pc329@192.168.1.46:$data /tmp/data

#gets the directory of the latest file and prints it
#latest=$(</home/$USER/bin/latest)
#echo $latest

#extracts latest bundle to temp folder
tar xvf /tmp/data/$(basename $data) -C /tmp/data

#removes old versions
rm -rf /home/$USER/git/it490f17
rm -rf /var/www/html

#moves files from temp folder to correct directories
mv /tmp/data/git/it490f17 /home/$USER/git/
mv /tmp/data/var/www/html /var/www/

#deletes temp folder
rm -rf /tmp/data

