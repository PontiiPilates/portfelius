# Portfelius
Помощник в составлениия портфеля

![multiplicators](preview.png)

### Команды

```shell
# Скачивание списка компаний
php artisan msfo:download-list 

# Создаёт таблицу компаний на освнове полученного списка, за исключением нежелательных компаний
php artisan msfo:parse-list

# Скачивает отчётность полученных компаний, если она у них есть
php artisan msfo:download-msfo

# Анализирует отчётность каждой компании и сохраняет полученные мультипликаторы в таблицу
php artisan msfo:parse-msfo
```
