# Biblebot

## Introduction
A laravel-based chatbot with botman as it's foundation.

The enduser may ask for Bibleverse(s) (eg. John 3:16) or will somehow execute a searchterm that the bot will try to interpret. Next, it will miraculously provide a suitable (biblical) answer.

The proof of concept uses API endpoints of a dutch NBV translation.

## Requirements
- Webserver;
- PHP 7.1 (as module in the webserver);
- PHP 7.1 (cli)

## Install
- Clone this github repo;
- Run `composer install`
- Run `cp .env.example .env`
- Run `php artisan key:generate`

## Documentation
- https://botman.io/2.0/botman-studio
- https://dialogflow.com/

## Function flow
1. Facebook messenger user input [question] --> 
2. Botman InputHandler--> 
3. Dialogflow --> 
4. Botman IntentHandler [answer]--> 
5. Facebook messenger

### Botman
passes user input to Dialogflow, 
- botman: public/biblebot/routes/botman.php

### Dialogflow 
Analyses user input and gives an intent back. 

### Inputhandler 
instantiates the appropriate IntentHandler.
- Inputhandler: public/biblebot/app/InputHandler.php

### Intenthandler
Get an answer form an external API. 
- Intenthandlers: public/biblebot/app/IntentHandlers/*

### Api's
- https://bijbel.eo.nl/api
- https://onesignal.com/api
(public/biblebot/app/ApiHandler.php)

## testing
- http://dev-server.nl/botman/tinker

# Server configuration
On Amazon, some CentOS host: https://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/CHAP_Tutorials.WebServerDB.CreateWebServer.html
Configure port forwarding on port 22/80/443.

Search latest version of PHP
`yum search php7`

Install latest version
`yum install php71`

Search modssl
`yum search all mod_ssl`

Install modssl
`yum install mod24_ssl`

Obtain a free Let's Encrypt SSL certificate from https://www.sslforfree.com/ and place certificates in /etc/ssl/certs/

Configure /etc/httpd/conf.d/ssl.conf (Highlighted certificates are obtained from Let's Encrypt)
`<VirtualHost _default_:443>
...
ServerName hacknl.arrishuijgen.nl:443
...
SSLCertificateFile /etc/ssl/certs/certificate.crt
...
SSLCertificateKeyFile /etc/ssl/certs/private.key
...
SSLCACertificateFile /etc/ssl/certs/ca_bundle_letsencrypt.crt`

## Miscellaneous
Install composer
`curl -sS https://getcomposer.org/installer | php
chmod +x composer.phar
mv composer.phar /usr/bin/composer
composer -V`

PHP mb_string
`yum install php71-mbstring`

Fix permissions
`chown -R apache:apache /var/www/html/storage/botman`
