<?php

namespace config;

class request
{
    public static $result;

    public static function config ($data)
    {
        if (isset($data['custom_request'])) {
            self::$result['try'] = $data['custom_request'];
        } else {
            self::$result['data'] = file_get_contents('php://input');
        }

        if (isset($data['telegram'])) {
            self::$result['token'] = $data['telegram']['key'];
        }

        if (isset($data['app'])) {
            include_once __DIR__."/../../".$data['app'];
        }
    }

    public static function __callStatic ($method, $param)
	{
        $action 	= isset(self::$result['message']);
        $group 		= isset(self::$result['message']['chat']['type']) == 'group';

        $url_bot    = [
            'telegram'  => 'https://api.telegram.org/bot'
        ];
        
        $methodList = [
            "url"           => $url_bot['telegram'].self::$result['token'],

            "privilage"		=> 'admin',
            "session"		=> 'create',

            "typeMessage"	=> isset($action) ? 'get' : 'post',
            "typeBot"		=> isset(self::$result['message']['chat']['type']),

            "name"			=> isset(self::$result[$action ? 'message' : 'callback_query']['from']['first_name']),
            "username"		=> isset(self::$result['message']['from']['username']),

            "updateID"		=> isset(self::$result['update_id']),
            "userID"		=> !($action) ?: self::$result['message']['from']['id'],
            "chatID"		=> $group ? isset(self::$result['message']['chat']['id']) : isset(self::$result[$action ? 'message' : 'callback_query']['from']['id']),
            "messageID"		=> $action ? isset(self::$result['result']['message']['message_id']) : isset(self::$result['callback_query']['message']['message_id']),

            "message"		=> $action ? self::$result['try'] : self::$result['try'],
            // ['message']['text'] / ['callback_query']['message']['text']

            "date"			=> $action ? isset(self::$result['message']['date']) : isset(self::$result['callback_query']['message']['date'])
        ];

		if(in_array($method, array_keys($methodList))){
            if ($param) {
                return $methodList[$method] == $param[0];
            }
            
			return $methodList[$method];
		}
	}

}
