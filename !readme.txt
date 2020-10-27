


каждые 5 мин
Запуск для очереди
cd /home/admin/web/collection.webjet.net.ua/public_html && php artisan queue:work --stop-when-empty>> /dev/null 2>&1
каждые 30 мин
Запуск для очистки очереди - для защиты переполнения памяти
cd /home/admin/web/collection.webjet.net.ua/public_html && php artisan queue:restart >> /dev/null 2>&1