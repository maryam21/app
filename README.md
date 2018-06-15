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

Install Themosis framework:

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

