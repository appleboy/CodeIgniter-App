# CodeIgniter App

Integrate RESTfull API, Base Model, Ion Auth module and Template module.

## Features

* [CodeIgniter-Ion-Auth][1]: Simple and Lightweight Auth System for CodeIgniter
* [Codeigniter-restserver][2]: A fully RESTful server implementation for CodeIgniter using one library, one config file and one controller.
* [codeigniter-base-model][3]: CodeIgniter base CRUD model to remove repetition and increase productivity
* [CodeIgniter-Template][4]: A Lightweight Codeigniter Template Libray
* [CodeIgniter-i18n][5]: i18n library for CodeIgniter 2.1.x
* [CodeIgniter-Native-Session][6]: codeigniter native session
* [Handlebars.js][7]: Minimal Templating on Steroids

[1]: https://github.com/benedmunds/CodeIgniter-Ion-Auth
[2]: https://github.com/chriskacerguis/codeigniter-restserver
[3]: https://github.com/appleboy/Codeigniter-Base-Model
[4]: https://github.com/appleboy/CodeIgniter-Template
[5]: https://github.com/appleboy/CodeIgniter-i18n
[6]: https://github.com/appleboy/CodeIgniter-Native-Session
[7]: http://handlebarsjs.com/

## Installtaion

add new virtual hostname on `hosts` file (`/etc/hosts`)

```
127.0.0.1 ci.localhost
```

[Apache](http://httpd.apache.org/): create `.htaccess`.

```
RewriteEngine on
RewriteBase /
RewriteCond $1 !^(index\.php|assets|robots\.txt|$)
RewriteRule ^(.*)$ index.php/$1 [L,QSA]
```

[Nginx](http://nginx.org/): please add the following to virtualhost config.

```
location / {
  try_files $uri $uri/ /index.php;
}
```

Import the SQL structure

```
$ mysql -u root -p app < sql/app.sql
```

## Installtaion with [Homestead](http://laravel.com/docs/4.2/homestead)

Please read [Chinese Blog](http://blog.wu-boy.com/2014/12/codeigniter-with-homestead-development/) or refer the following steps.

Clone the project init `/home/git` foloder.

```bash
$ git clone https://github.com/appleboy/CodeIgniter-App.git /home/git/CodeIgniter-App
```

Update `~/.homestead/Homestead.yaml` setting.

```ruby
folders:
  - map: /home/appleboy/newProject
    to: /home/vagrant/Code
  - map: /home/git/CodeIgniter-App
    to: /home/vagrant/codeigniter-app
 
sites:
  - map: homestead.app
    to: /home/vagrant/Code/public
  - map: codeigniter.app
    to: /home/vagrant/codeigniter-app/public
 
databases:
  - homestead
  - app
```

Update `after.sh` as the following:

```
#!/bin/sh
 
# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.
 
mysql -uhomestead -psecret app < /home/vagrant/codeigniter-app/sql/app.sql
```

Start the virtual machine.

```
$ homestead up --provision
```

open youre browser url: http://codeigniter.app:8000
## Screenshot

<img src="https://raw.githubusercontent.com/appleboy/CodeIgniter-App/master/screenshot/screenshot.png" alt="screenshot" />

