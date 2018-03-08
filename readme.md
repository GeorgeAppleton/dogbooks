## Build
cp .env.example .env

configure .env variables, set up your hosts file, configure vhosts etc (below might help)

`<VirtualHost dogbooks.local>
  ServerName dogbooks.local
  ServerAlias dogbooks.local
  DocumentRoot "${INSTALL_DIR}/www/dog-books/public"
  <Directory "${INSTALL_DIR}/www/">
    Options +Indexes +Includes +FollowSymLinks +MultiViews
    AllowOverride All
    Require local
  </Directory>
</VirtualHost>`


composer install

npm install

gulp build

If you have any issues with version compatability:
I used npm version 5.3.0, composer version 1.6.3, gulp cli 3.9.1
