Установка:
1. git clone https://github.com/babaSveta/testTask.git
2. настраиваем nginx:

////////////////////****СОДЕРЖИМОЕ****////////////////////
server {
    charset utf-8;
    client_max_body_size 128M;

    listen 80; ## listen for ipv4
    #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

    server_name test.dev;
    root        /home/xzibit260995/SERVER/test.dev/;
    index       index.php;

    location /out/front {
        alias  /home/xzibit260995/SERVER/test.dev/frontend/web;
        rewrite  ^(/out/front)/$ $1 permanent;
        try_files  $uri /frontend/web/index.php?$args;
    }


    location ~ \.php$ {

         fastcgi_pass unix:/var/run/php/php7.1-fpm.sock;

        #fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;

        proxy_buffer_size          128k;
        proxy_buffers              4 256k;
        proxy_busy_buffers_size    256k;

        #try_files  $uri =404;

    }
}
////////////////****КОНЕЦ СОДЕРЖИМОГО****////////////////

3. создаём базу данных test
4. подключаемся к ней и через php yii migrate, накатываем изменения



На сайте изначально присутствует одни пользователь, администратор с большим количеством денег:
Логин: admin@mail.ru
Пароль: 123456

backend: http://test.dev/backend/web/index.php?r=site%2Flogin
frontend: http://test.dev/frontend/web/


