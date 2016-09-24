vuela is a laravel 5.3 test application utilizing laravel scout.

use **php artisan queue:work redis** 
or **supervisor** (apt-get install ) to create redis worker queues for elasticsearch:

to install supervisor use: 'apt-get install supervisor' on ubuntu

---
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d

command=php /var/www/your_app_name/artisan queue:work redis --sleep=3 --tries=3

autostart=true

autorestart=true

user=some_username

numprocs=8

redirect_stderr=true

stdout_logfile=/var/www/your_app_name/storage/logs/worker.log

---

sudo service supervisord start

sudo supervisorctl reread

sudo supervisorctl update

sudo supervisorctl start laravel-worker:*