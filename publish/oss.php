<?php

declare(strict_types=1);

return [
    //选择oss服务商
    'default' => 'aliyun',
    //阿里云配置
    'aliyun' => [
        'accessKeyId' => 'yourAccessKeyId',
        'accessKeySecret' => 'yourAccessKeySecret',
        // Endpoint以杭州为例，其它Region请按实际情况填写。
        'endpoint' => 'https://oss-cn-hangzhou.aliyuncs.com',
        'bucket' => [
            'default' => 'test'
        ],
        'adapter' => \Gone\Oss\Adapter\AliyunAdapter::class
    ],
    //七牛云配置
    'qiniuyun' => [
        'accessKeyId' => 'yourAccessKeyId',
        'accessKeySecret' => 'yourAccessKeySecret',
        'bucket' => [
            'default' => 'test'
        ],
        'adapter' => \Gone\Oss\Adapter\QiniuyunAdapter::class
    ]
];