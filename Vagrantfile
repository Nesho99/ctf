# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://vagrantcloud.com/search.
  config.vm.box = "ubuntu/focal64"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # NOTE: This will enable public access to the opened port
  # config.vm.network "forwarded_port", guest: 80, host: 8080

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine and only allow access
  # via 127.0.0.1 to disable public access
  # config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  # config.vm.network "private_network", ip: "192.168.33.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  # config.vm.synced_folder "../data", "/vagrant_data"

  # Disable the default share of the current code directory. Doing this
  # provides improved isolation between the vagrant box and your host
  # by making sure your Vagrantfile isn't accessible to the vagrant box.
  # If you use this you may want to enable additional shared subfolders as
  # shown above.
  config.vm.synced_folder ".", "/vagrant", disabled: true

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
     config.vm.provider "virtualbox" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
      vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
       vb.memory = "2048"
       vb.cpus="2"
       vb.name="CTF"
     end
     config.vm.provision "file", source: "./www/", destination: "/tmp/"
     config.vm.provision "file", source: "./automated-user/", destination: "/tmp/automated-user"
  # View the documentation for the provider you are using for more
  # information on available options.

  # Enable provisioning with a shell script. Additional provisioners such as
  # Ansible, Chef, Docker, Puppet and Salt are also available. Please see the
  # documentation for more information about their specific syntax and use.
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
    sudo sqlite3 /var/www/html/ctf.db "CREATE TABLE user(username text, password text);"
    PLAINTEXT_PASSWORD="MrR0b0t15Th3B3st"
    HASHED_PASSWORD=$(php -r "echo password_hash('$PLAINTEXT_PASSWORD', PASSWORD_BCRYPT);")
    sudo sqlite3 /var/www/html/ctf.db "INSERT INTO user VALUES ('admin','$HASHED_PASSWORD');"
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
    sudo echo "CTF{d60b3309622970d9151d521e75f1d6a5}" >/home/www-data/flag2.txt
    sudo chown -R www-data:www-data /home/www-data/flag2.txt
    sudo echo "CTF{35a5b0fb193f83e480ab8153f0471cdd}" >/home/flag3.txt
    sudo chown -R root:root /home/flag3.txt
    echo 'vagrant:Dadasada123' | sudo chpasswd




    
  SHELL
end



