<h1 align="center">Coming Soon</h1>

<h2 align="center">bot-telegram-native</h2>
<p align="center">
<img src="https://img.shields.io/github/issues/AnoOnion/bot-telegram-native"> <img src="https://img.shields.io/github/forks/AnoOnion/bot-telegram-native"> <img src="https://img.shields.io/github/stars/AnoOnion/bot-telegram-native"> <img src="https://img.shields.io/github/license/AnoOnion/bot-telegram-native"> <img src="https://app.codacy.com/project/badge/Grade/70a5b32e1d044816ab57a8236b4d2191">
</p>
  
### Description
Telegram bot framework that is easy to apply and simpler

### Install
**1. Download atau clone library bot telegram**
```bash
git clone https://github.com/AnoOnion/bot-telegram-native
```

**2. Masuk ke file `main.php` dan atur sesuai kebutuhan bot**
```php
<?php

include_once __DIR__."/autoload.php";
use config\request;

request::config([
    'app'               => 'resource/config/app.php', // file route app
    'key'               => 'AnoOnion', // key url
    'session'           => 'true', // set session
    'custom_request'    => 'halo', // custom request hook

    'db' => [
        'url'   => 'localhost',
        'user'  => 'root',
        'pass'  => '',
        'db'    => 'db_telegram'
    ],

    'telegram' => [
        'key' => '23214619846397409327940' // token telegram bot
    ]
]);
```

**3. Masuk ke file route app : `resource/config/app.php`**
```php
<?php

use component\bot       as App;

App::get('halo', function ($bot) {
    $bot->send('halo juga');
});
```

**4. Set webhook telegram ke file library tersebut**
```
https://api.telegram.org/bot [TOKEN_TELEGRAM] /setWebhook?url= [DOMAIN]/main.php
```

### Author

- Website  : <a href="https://dev.husni.or.id">Husni Official</a>
- Facebook : <a href="https://www.facebook.com/husni2id">Muh Husni Mubarok</a>
- LinkedIn : <a href="https://www.linkedin.com/in/anoonion">Muh Husni Mubarok</a>

### License

- Copyright © 2020 Muh Husni Mubarok.
- **Bot Telegram is open-sourced software licensed under the MIT license.**
