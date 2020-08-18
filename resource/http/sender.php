<?php

namespace http;

use http\helper;
use config\request;

class sender {

    private static function keyboard ($valueOption)
    {
        if(is_bool($valueOption)){
            $keyboard = ['hide_keyboard' => !($valueOption)];
        }else{
            $checkKeyboard = preg_split("/(@|#)/", $valueOption[0][0]);

            if(count($checkKeyboard) == 2){
                $firstKey		= 0;
                $setKeyboard	= [];
                foreach ($valueOption as $keyKeyboard => $valueKeyboard) {
                    $lastKey	= 0;
                    foreach ($valueKeyboard as $keysKeyboard => $valuesKeyboard) {
                        $keyboardCall	= explode('@', $valuesKeyboard);
                        $keyboardUrl	= explode('#', $valuesKeyboard);

                        $validateKeyboard = count($keyboardCall) == 2;

                        $setKeyboard[$firstKey][$lastKey] = [
                            'text' => $validateKeyboard ? $keyboardCall[0] : $keyboardUrl[0],
                            $validateKeyboard ? 'callback_data' : 'url' => $validateKeyboard ? $keyboardCall[1] : $keyboardUrl[1]
                        ];

                        $lastKey++;
                    }
                    $firstKey++;
                }

                $keyboard = array(
                    "inline_keyboard" => $setKeyboard
                );
            }else{
                $keyboard = array(
                    "keyboard"			=> $valueOption,
                    "one_time_keyboard" => true,
                    "resize_keyboard"	=> true
                );
            }

            return json_encode($keyboard);
        }
    }
    
    public static function message ($message, $option = null)
    {
        if (is_array($message)) {
            $postfields = [
                'chat_id'   => request::chatID()
            ];

            foreach ($message as $key => $value) {
                $postfields['text'] = $value;

                echo "<pre>";
                    print_r($postfields);
                echo "</pre>";
            }
        } else {
            $postfields = [
                'chat_id'   => request::chatID(),
                'text'      => $message
            ];

            if (isset($option['loading'])) {
                
            }

            if (isset($option['keyboard'])) {
                $postfields['reply_markup'] = self::keyboard($option['keyboard']);
            }
            
            echo "<pre>";
                print_r($postfields);
            echo "</pre>";

            // helper::curl(request::url(), $postfields);
        }
    }

}
