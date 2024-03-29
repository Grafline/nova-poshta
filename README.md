# Nova Poshta 1.0
Пакет для Laravel версии 5.0 и выше, создающий форму для работы с API Новой Почты.<br>
Предполагается наличие базы для работы с пакетом.

## Установка

в composer.json необходимо добавить в сецию "repositories"

```
 "repositories": [
        {
            "url": "https://github.com/Grafline/nova-poshta",
            "type": "git"
        }
    ],
```
  в секцию "require"
  ```
    "require": {
            "grafline/nova-poshta": "dev-master"
        },
  ```     
  
  и запустить из командной строки команду ``php composer install`` или ``php composer update``
  
 Добавить в config/app.php в секцию 'providers'
  ```
  \Grafline\NovaPoshta\NovaPoshtaServiceProvider::class,
   ```
 Необходимо опубликовать конфигурационный файл и внести туда изменения под свой проект
 
 ```
   php artisan vendor:publish --provider="Grafline\NovaPoshta\NovaPoshtaServiceProvider" --tag=config
 ```
   В первую очередь необходимо указать соединение с базой для работы с Новой Почтой ``db_connect``<br>
   а также указать ``delivery_id`` это id для переключения на работу с Новой Почтой.
   
   Также необходимо опубликовать файлы js и css и подключить соответствующим образом к проекту.
     
   ```
      php artisan vendor:publish --provider="Grafline\NovaPoshta\NovaPoshtaServiceProvider" --tag=css
      
      php artisan vendor:publish --provider="Grafline\NovaPoshta\NovaPoshtaServiceProvider" --tag=js
   ```
   
  В представлении пакет можно подключить таким образом:

  ```
  {!! \Grafline\NovaPoshta\Facades\NovaPoshta::getForm() !!}
  ```
  Если опубликованы представления то можно так:
  ```
    @include('nova_poshta.index')
  ```

## Настройка
Пакет идет со своим представление. Но есть возможность вносить свои правки в представение.<br>
Для этого необходимо опубликовать представления.

   ```
   php artisan vendor:publish --provider="Grafline\NovaPoshta\NovaPoshtaServiceProvider" --tag=views
   ```
   
   Также можно вносить правки по надобности в опубликованные файлы js и css
 


