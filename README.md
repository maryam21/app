# app

run this script in your terminal to install Composer

    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('SHA384', 'composer-setup.php') ===     '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else {    echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
    
https://getcomposer.org/download/

 move composer to in your path:
    
    sudo mv composer.phar /usr/bin/composer
    
https://getcomposer.org/doc/00-intro.md#globally

PHP requirements:
==================
     sudo add-apt-repository ppa:ondrej/php
     sudo apt-get update
     sudo apt-get remove php5-common -y
     sudo apt-get install php7.2 php7.2-fpm php7.2-mysql -y
     sudo apt-get --purge autoremove -y
     sudo a2enmod proxy_fcgi setenvif
     sudo a2enconf php7.2-fpm  
     sudo service apache2 reload
https://askubuntu.com/questions/705880/how-to-install-php-7

In case php doesn't work with apache server:
     
     sudo apt-get install apache2 php7.2 libapache2-mod-php7.2
     a2query -m php7.2
     sudo a2enmod php7.2  
     sudo service apache2 restart
https://askubuntu.com/questions/451708/php-script-not-executing-on-apache-server
     
Install Themosis framework:
===========================
    composer create-project themosis/themosis app
    
https://framework.themosis.com/docs/1.3/installation/#install-composer

if this error shows up:
  
     [ErrorException]
     proc_open(): fork failed - Cannot allocate memory
     
Verify if you have Swap space enabled:

     free -m

     total used free shared buffers cached
     Mem: 2048 357 1690 0 0 237
     -/+ buffers/cache: 119 1928
     Swap: 0 0 0
    
enable the swap:
     
     /bin/dd if=/dev/zero of=/var/swap.1 bs=1M count=1024
     /sbin/mkswap /var/swap.1
     /sbin/swapon /var/swap.1
    
https://getcomposer.org/doc/articles/troubleshooting.md#proc-open-fork-failed-errors

if you get this error:

    Your requirements could not be resolved to an installable set of packages.
    

then do:
    
    sudo apt-get install php-xml

https://laracasts.com/discuss/channels/servers/problems-with-missing-php-extensions

and then :
     
      sudo apt-get install php7.2-mbstring

https://stackoverflow.com/questions/44891013/the-requested-php-extension-mbstring-is-missing-from-your-system

fill in your credentials in .env.local

replace the value of host in environment.php with the hostname, we can get the hostname by running:
           
       hostname
       
Apache configuration:
=====================
add to /etc/apache2/sites-enabled/000-default.conf

    <VirtualHost *:80>
    DocumentRoot /*your_workspace_directory*/app/htdocs
    <Directory "/*your_workspace_directory*/app/htdocs">
        Options FollowSymlinks Indexes MultiViews
        AllowOverride All
    </Directory>
    </VirtualHost>   
https://stackoverflow.com/questions/35314640/themosis-doesnt-run-on-localhost

and then in /etc/apache2/apache2.conf:

    <Directory /*your_workspace_directory*/app/htdocs/>
        Options Indexes FollowSymLinks
        AllowOverride None
        Require all granted
    </Directory>
https://stackoverflow.com/questions/10873295/error-message-forbidden-you-dont-have-permission-to-access-on-this-server

Wordpress installation:
=======================

    $ wget -c http://wordpress.org/latest.tar.gz
    $ tar -xzvf latest.tar.gz

move extracted files to Apache default root directory:
    
    $ sudo rsync -av wordpress/* /*your_workspace_directory*/app/htdocs/cms/
    
set permissions:

    $ sudo chown -R www-data:www-data /*your_workspace_directory*/app/htdocs/cms/
    $ sudo chmod -R 755 /**local_directory**/app/htdocs/cms/
    
create database:

    $ mysql -u root -p 
    mysql> CREATE DATABASE wp_db;
    mysql> GRANT ALL PRIVILEGES ON wp_db.* TO 'your_username_here'@'localhost' IDENTIFIED BY 'your_chosen_password_here';
    mysql> FLUSH PRIVILEGES;
    mysql> EXIT;
    
restart web server and mysql:

    sudo service apache2 restart
    sudo service mysql restart

https://www.tecmint.com/install-wordpress-on-ubuntu-16-04-with-lamp/

might need to install MySQL extension:
      
     sudo apt-get update
     sudo apt-get install php7.2-mysql

setup: 

    http://localhost/wp-admin/install.php?step=1
    
https://www.digitalocean.com/community/tutorials/how-to-install-wordpress-with-lamp-on-ubuntu-16-04

Seed data:
==========
Create seed.php file into project root directory and put the following:

     <?php
     require_once "vendor/autoload.php";

     $conn = mysqli_connect("localhost", "root", getenv('DB_PASSWORD'), "wp_db");

     $faker = Faker\Factory::create();

    for ($i=0; $i < 50; $i++) { 
       $sql = "INSERT INTO wp_users (user_nicename, user_email, user_pass, user_registered, user_login) VALUES ('" . $faker->name . "',        '" . $faker->email . "', '" . md5($faker->password) . "', '" . date('Y-m-d H:i:s', strtotime($faker->iso8601)) . "', '" . $faker-        >userName ."' )";
    mysqli_query($conn, $sql);
    }

    for ($i=0; $i < 20; $i++){
    $sql = "INSERT INTO wp_posts (post_author, post_date, post_content, post_title) VALUES ('". $faker->userName . "','" . date('Y-m-d       H:i:s', strtotime($faker->iso8601)) . "', '" . $faker->text . "', '" . $faker->sentence . "')";
    mysqli_query($conn, $sql);
    }
    ?>

Run:
    
    php seed.php

VueJs FrontEnd:
=============
Install Vuejs:

    npm install -g @vue/cli
    
Create project:

    vue create frontend
