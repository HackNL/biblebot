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


