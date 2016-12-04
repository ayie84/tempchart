# tempchart
<h3>Temperature Chart for Raspberry Pi 3</h3>

-rpi 3</br>
-highchart</br>
-php+mysql</br>
-bash script with cronjob(to get the temperature and store it into mysql every 1 hour)</br>

#bash script
<h7>#!/bin/bash</h7></br>
cpuTemp0=$(cat /sys/class/thermal/thermal_zone0/temp)</br>
cpuTemp1=$(($cpuTemp0/1000))</br>
cpuTemp2=$(($cpuTemp0/100))</br>
cpuTempM=$(($cpuTemp2 % $cpuTemp1))</br>

gpuTemp0=$(/opt/vc/bin/vcgencmd measure_temp)</br>
gpuTemp0=${gpuTemp0//\'/º}</br>
gpuTemp0=${gpuTemp0//temp=/}</br>

echo CPU Temp: $cpuTemp1"."$cpuTempM"ºC"</br>

<h7>##ref : http://stackoverflow.com/questions/17997558/bash-script-to-insert-values-in-mysql</h7></br>
echo "INSERT INTO temp_log (cpu) VALUES ($cpuTemp1.$cpuTempM);" | mysql -u[login] -p[password] [databasename];</br>


i'm using nano editor, My command is </br>
sudo nano tempsql.sh</br>
-paste the script-</br>
ctrl+o to save the script</br>
ctrl+x to exit the editor</br>
make the script executeable</br>
chmod +x tempsql.sh</br>
test your script</br>
sudo ./tempsql.sh</br>
check the data on your mysql.</br>

set the cronjob</br>
sudo crontab -e</br>
this will make the script run every 1 hour</br>
0 */1 * * * /home/pms/script/tempsql.sh >> /home/pms/script/log/templog.log &</br>




