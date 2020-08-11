#!/usr/bin/env bash

brand="SolarPi"

# Check that the script is running as root. If not, then prompt for the sudo
# password and re-execute this script with sudo.
if [ "$(id -nu)" != "root" ]; then
    sudo -k
    pass=$(whiptail --backtitle "$brand Installer" --title "Authentication required" --passwordbox "Installing $brand requires administrative privilege. Please authenticate to begin the installation.\n\n[sudo] Password for user $USER:" 12 50 3>&2 2>&1 1>&3-)
    exec sudo -S -p '' "$0" "$@" <<< "$pass"
    exit 1
fi

sudo apt-get update
sudo apt-get upgrade

sudo apt-get install socat 

sudo apt install apache2 -y
sudo apt install libapache2-mod-php -y
#sudo apt install ./mysql-apt-config_0.8.13-1_all.deb
sudo apt install mysql-server
python pi-solar-tracer/db/create_database.py

chmod 755 /var/www/html/pi-solar-tracer
lsusb
ls /dev/ttyXRUSB0
sudo chmod 777 /dev/ttyXRUSB0


echo "!!! The App is currently now running !!!"



