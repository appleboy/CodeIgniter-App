# CodeIgniter-App


Integrate RESTfull API, Base Model, Ion Auth module and template module.

## Setup

add new virtual hostname on `hosts` file (`/etc/hosts`)

```
127.0.0.1 ci.localhost
```

create `.htaccess` for apache

```
RewriteEngine on
RewriteBase /
RewriteCond $1 !^(index\.php|assets|robots\.txt|$)
RewriteRule ^(.*)$ index.php/$1 [L,QSA]
```

please add the following to virtualhost config for nginx.

```
location / {
  try_files $uri $uri/ /index.php;
}
```
