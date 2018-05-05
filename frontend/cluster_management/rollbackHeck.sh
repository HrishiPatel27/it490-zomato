#!/bin/bash

#runs php script with 1 argument
sshpass -p "pc329pw" ssh pc329@192.168.1.46 "php /home/pc329/bin/deployFunctions.php 'rollback' '' '' ''"

#changes to where all the bundles are stored
#cd /home/$USER/bundles

#gets the directory of the latest file and prints it
data=$(sshpass -p "pc329pw" ssh pc329@192.168.1.46 "cat /home/pc329/bin/latest")
echo $data

#creates temporary folder to store extractions
rm -rf /tmp/data
mkdir /tmp/data

#downloads the .tar file
#cd /home/$USER/bundles
sshpass -p "pc329pw" scp pc329@192.168.1.46:$data /tmp/data

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

