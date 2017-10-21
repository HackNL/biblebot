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