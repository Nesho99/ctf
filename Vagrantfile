# -*- mode: ruby -*-
# vi: set ft=ruby :


Vagrant.configure("2") do |config|

  config.vm.box = "ubuntu/focal64"
  config.vm.network "public_network"


  config.vm.synced_folder ".", "/vagrant", disabled: true

  
     config.vm.provider "virtualbox" do |vb|
  
      vb.gui = true
  
  
       vb.memory = "4096"
       vb.cpus="4"
       vb.name="CTF"
     end
     config.vm.provision "file", source: "./www/", destination: "/tmp/"
     config.vm.provision "file", source: "./automated-user/", destination: "/tmp/automated-user"

  config.vm.provision "shell", inline: <<-SHELL
    sudo loadkeys hr
    apt-get update
    apt-get install -y apache2
    sudo mv  /tmp/www/* /var/www/html/
    sudo touch /var/www/html/ctf.db
    sudo chown -R www-data:www-data /var/www/html
    sudo chmod -R 755 /var/www/html
    sudo apt-get install software-properties-common
    sudo add-apt-repository ppa:ondrej/php
    sudo apt-get update
    sudo apt-get install php8.2  libapache2-mod-php8.2 -y
    sudo apt install sqlite3 -y
    sudo apt install php8.2-sqlite3 -y
    sudo sqlite3 /var/www/html/ctf.db "CREATE TABLE contact(name text, subject text, message text);"
    sudo sqlite3 /var/www/html/ctf.db "CREATE TABLE user(username text, password text, role integer);"
    PLAINTEXT_PASSWORD="mrroboto"
    HASHED_PASSWORD=$(php -r "echo password_hash('$PLAINTEXT_PASSWORD', PASSWORD_BCRYPT);")
    sudo sqlite3 /var/www/html/ctf.db "INSERT INTO user VALUES ('admin','$HASHED_PASSWORD',2);"
    PLAINTEXT_PASSWORD="Y0uShallN0tP455!"
    HASHED_PASSWORD=$(php -r "echo password_hash('$PLAINTEXT_PASSWORD', PASSWORD_BCRYPT);")
    sudo sqlite3 /var/www/html/ctf.db "INSERT INTO user VALUES ('moderator','$HASHED_PASSWORD',1);"
    sudo sqlite3 /var/www/html/ctf.db "CREATE TABLE flag(flag text);"
    FLAG="CTF{223797ae419b4189128f2895c44252c8}"
    sudo sqlite3 /var/www/html/ctf.db "INSERT INTO flag VALUES ('$FLAG');"
    sudo service apache2 start
    sudo ufw allow 80 
    yes | sudo ufw enable
    sudo service apache2 restart
    sudo update-rc.d apache2 defaults



    sudo mv /tmp/automated-user /home/
    sudo chown -R root:root /home/automated-user
    sudo apt-get update
    sudo apt-get install -y python3-pip
    snap install chromium
    sudo -H pip3 install -r /home/automated-user/requirements.txt
    sudo sh -c '(crontab -u root -l; echo "*/5 * * * * /usr/bin/python3 /home/automated-user/main.py") | crontab -u root -'
    echo 'www-data ALL=(ALL) NOPASSWD: /usr/bin/awk' > /tmp/www-data-awk
    visudo -c -f /tmp/www-data-awk && mv /tmp/www-data-awk /etc/sudoers.d/
    sudo mkdir -p /home/www-data/
    sudo echo "CTF{d60b3309622970d9151d521e75f1d6a5}" >/home/www-data/flag4.txt
    sudo chown -R www-data:www-data /home/www-data/flag4.txt
    sudo echo "CTF{35a5b0fb193f83e480ab8153f0471cdd}" >/home/flag5.txt
    sudo chown -R root:root /home/flag5.txt
    echo 'vagrant:Dadasada123' | sudo chpasswd




    
  SHELL
end



