<?php

use http\helper;
use component\media;
use component\bot       as App;
use component\module    as Bot;

App::get(['req' => 'halo', 'session' => 'create'], function ($bot, $session) {
    $bot->middleware(true)->send(['halo juga', 'ok'], [
        'loading'   => true,
        'keyboard'  => [
            ['ok', 'cancel']
        ]
    ])->isNot(function ($bot) {
        helper::get('https://api.banghasan.com/quran/format/json/surat/1/ayat/1', function ($data) use ($bot) {
            $bot->send($data);
        });
    });

    $session->set('cek');
});

App::group(['middleware' => true, 'method' => 'get'], function () {
    Bot::route(['req' => 'halo kak', 'session' => 'create'], function ($bot, $session) {
        $bot->send('halo juga kak', [
            'loading'   => true,
            'keyboard'  => [
                ['ok', 'cancel']
            ]
        ]);

        $session->set('ok');
    });

    Bot::session('create', function () {
        // $image = media::image('http://img.google.com/img.png', 'png')
        //         ->caption('ini gambar internet');

        // Bot::route('hi', function ($bot, $session) use ($image) {
        //     $bot->send(['hi juga', $image->get()]);
    
        //     $session->set('ok');
        // });

        Bot::route('hi', function ($bot, $session) {
            $bot->send('hi juga');
    
            $session->set('ok');
        });
    });
});

App::fallback(function ($bot) {

    Bot::session('create', function () use ($bot) {
        $bot->send('Command Not Found');
    });
});
