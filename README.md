# Rooftop Career Switch: Proposed Challenge Solution 


The proposed solution was coded using modern PHP and best practices such as OOP with heavy use of interfaces, dependency injection, PSR7 for http transport and messages handling, static checks and CI integration at github repository level on each push throug github actions.

## 🗄️  Configuration

In order to bootstrap the application some required runtime parameters are needed. As an example, an environment file is located `app/config/.env.example`. You should make a copu and tweak it accordingly:

```bash
cp -p app/config/.env.example app/config/.env
```

## 🤖 Runtime requirements

Runtime requirements are specified at `composer.json` but briefly you'll need :

- PHP `>= 8.0`
- Composer `>= 2.0`

## 🏃‍♂️ Run steps

### Dockerized environment (preferred method)

Step 1: Build image
```bash
$ docker build -t defi-challenge docker
```

Step 2: Run it
```bash
$ docker run -t -v ${PWD}:/mnt/app defi-challenge
```

And that's it! 🎉 .. You should be hitting those API endpoints righaway! 🔥

### Manual way (a.k.a old school)

As an alternative, you can have a great time installing and pre-configuring the runtime stack to run the whole project on bare metal. If you happen to be such an old fashioned dev then you will need: 

Populate project dependencies using composer:

```bash
$ composer install
```

Run provided example as follows:

```bash
$ php test.php
```

That was fun, isn't it?

## ✅ Unit Testing

Although tests continuously run on every repo change as part of designed CI pipeline, Unit tests can be run manually using `phpunit`:

```bash
$ vendor/bin/phpunit 
```

## 🔍 Statics analysis checks

Static code checks are enforced using `psalm` on every code change at repo level. Manual run can be also run by executing:

```bash
$ vendor/bin/psalm 
```