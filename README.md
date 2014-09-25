# CodeIgniter App


Integrate RESTfull API, Base Model, Ion Auth module and template module.

## Setup

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
