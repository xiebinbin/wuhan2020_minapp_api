<?php

/*
 * This file is part of the leonis/easysms-notification-channel.
 * (c) yangliulnn <yangliulnn@163.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

return [
    'timeout' => 5.0,
    
    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,
        
        // 默认可用的发送网关
        'gateways' => [
            'aliyun',
            'errorlog',
        ],
    ],
    
    // 可用的网关配置
    'gateways' => [
        // 失败日志
        'errorlog' => [
            'file' => storage_path('logs').'error_sms.log',
        ],
        
        'aliyun' => [
            'access_key_id' => env('ALIYUN_ACCESS_KEY_ID', ''),
            'access_key_secret' => env('ALIYUN_ACCESS_KEY_SECRET',''),
            'sign_name' => "新冠援助",
        ],
        
        // ...
    ],
    
    'custom_gateways' => [
        'errorlog' => \Leonis\Notifications\EasySms\Gateways\ErrorLogGateway::class,
        'winic' => \Leonis\Notifications\EasySms\Gateways\WinicGateway::class,
    ],
];
