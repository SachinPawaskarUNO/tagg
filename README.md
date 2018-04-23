<p align="center">
    <img src="./public/img/New-logo.jpg" alt="CharityQ Logo"/>
    
</p>

<p align="center">CharityQ helps caring business managers in streamlining contributions to their community, charities, non-profits, and other organizations. This allows our business partners to operate more efficiently and successfully within their community.</p>

# [CharityQ](https://tagg-uno.herokuapp.com/) 
**Build status**

master: 
[![Build Status](https://travis-ci.org/akhampariya/tagg.svg?branch=master)](https://travis-ci.org/akhampariya/tagg)
dev:
[![Build Status](https://travis-ci.org/akhampariya/tagg.svg?branch=development)](https://travis-ci.org/akhampariya/tagg)
sprint 1: [![Build Status](https://travis-ci.org/akhampariya/tagg.svg?branch=sprint1)](https://travis-ci.org/akhampariya/tagg)
sprint 2:
[![Build Status](https://travis-ci.org/akhampariya/tagg.svg?branch=sprint2)](https://travis-ci.org/akhampariya/tagg)
sprint 3:
[![Build Status](https://travis-ci.org/akhampariya/tagg.svg?branch=sprint3)](https://travis-ci.org/akhampariya/tagg)
sprint 4:
[![Build Status](https://travis-ci.org/akhampariya/tagg.svg?branch=sprint4)](https://travis-ci.org/akhampariya/tagg)


### Executive Summary

Together Achieve Greater Good (TAGG) created an application for businesses to streamline the donation request process for small and large businesses.  When individuals purchase goods and services from a participating business and then share them on social media a donation is made. To take the TAGG application a step further, the TAGG team dreamed of an additional service named CharityQ that could allow the businesses to easily process the donation requests being generated.  This would free the decision makers and business owners to focus more on the business and still support the community by providing donations.

### Setup Requirements
If
* you want to use [Docker](https://www.docker.com/)
    * visit docker development [guide](docker-dev.md)

else for windows 
* [Visual C++ Redistributable Packages](http://wampserver.aviatechno.net/files/vcpackages/all_vc_redist_x86_x64.zip) ( Install them to avoid any WAMP issues)
* [WAMP](http://http://wampserver.aviatechno.net/) ( Includes Php, MySql and Apache Server)
* [Composer](https://getcomposer.org/) ( Package manager for PHP based frameworks)
* [git](https://git-scm.com/downloads) (Version Control)
* [npm](https://docs.npmjs.com/getting-started/installing-node) ( package manager for the JavaScript based frameworks)

### Installation

To setup local environment follow below steps - 

Check [this tutorial](http://www.codovel.com/install-laravel-55-on-windows-step-by-step.html) to get familiar where to place the code.

Open git bash and set git identity as below -
```bash
git config --global user.name "John Doe"
git config --global user.email johndoe@example.com 
```
`Where user name and email is your github user name and email.`

if you are using wamp stack, run below git command within www folder created inside wamp dir -
```bash
git clone -b development --single-branch https://github.com/akhampariya/tagg.git
cd tagg
git pull
```
`checkout -b option will create development branch and switch to it and pull command will fetch latest code from github.`

`All changes are supplied to development branch from other feature branches and later merged to master.`

pull/push code for any sprint  as below -

e.g. for sprint1 

```bash
git clone -b sprint1 --single-branch https://github.com/akhampariya/tagg.git
cd tagg
git pull
```

## `for debugging the app use we are using` [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)
## `for logging we are using` [Log-viewer](https://github.com/rap2hpoutre/laravel-log-viewer)

#### Update project dependencies
We supply the environment variable through .env file. Sample setting are provided in [.env.example](.env.example).
Copy as below - 
```bash
cp .env.example .env
```
`supply environment variables as required before proceeding any further.`

```bash
composer update
npm install
```
The composer & npm commands will update and install all require dependencies to run the development environment.

#### Create Migrate database

create a new database named `tagg` (or whatever you define in .env file for later use) using `phymyadmin` web GUI. 

Once you have created database, run below php commands to create and load initial data.

```bash
php artisan migrate --seed
```
`the migrate command along with --seed tells the system to create the database table based on migration definations and seed intial data defined in seeder files immediatly.`

*Don't seed data while connected to production site.*

#### Run the app 

Before running the application server, you require to generate application key, that will appear in you .env file as `APP_KEY` value.

```bash
php artisan key:generate
php artisan serve
```
visit http://localhost:8000

Or 
`if you don't want to run php server, you can still access the application with WAMP server.`

visit http://localhost/tagg/public/

### resources
Learn more about [npm](https://docs.npmjs.com/cli/npm), [git](https://git-scm.com/docs), [composer](https://getcomposer.org/doc/03-cli.md) and [php artisan](https://laravel.com/docs/5.5/artisan) commands.

### License
TBA

Copyright (c) [University of Nebraska at Omaha](https://www.unomaha.edu/) & [TAGG](http://www.togetheragreatergood.com/)

### Contribute

Everyone ! You can help this project in many ways, such as suggestions, reporting issues and contribute in coding.
