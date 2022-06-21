# Rooftop Career Switch: Proposed Challenge Solution 


The proposed solution was coded using modern PHP and best practices such as OOP with heavy use of interfaces, dependency injection, PSR7 for http transport and messages handling, static checks and CI integration at github repository level on each push throug github actions.

## Runtime requirements

Runtime requirements are specified at `composer.json` but briefly you'll need :

- PHP `>= 8.0`
- Composer `>= 2.0`

## Configuration

In order to bootstrap the application some required runtime parameters are needed. As an example, an environment file is located `app/config/.env.example`. You should make a copu and tweak it accordingly:

>  cp -p app/config/.env.example app/config/.env

## Run steps
 
After defining environment variables you'll need to populate project dependencies using composer

> $ composer install

Then to run provided example:

> $ php test.php

## Unit Tests

Unit tests can be run using phpunit:

> $ vendor/bin/phpunit 


## Statics checks

Static code checks are enforced using `psalm`

> $ vendor/bin/psalm 