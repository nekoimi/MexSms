# MexSms —— Laravel / Lumen

LeanCloud 挂了。。。。。所有的短信业务都用不了了....

加一个阿里备用...

LeanCloud 和 阿里云的短信验证有很大的区别...

目前支持的短信服务:

- 阿里云

- LeanCloud

### 安装

```bash
composer require yprisoner/mexsms -vvv
```

- php >= 7.0

- 将 config 下面的 mexsms.php Copy 到项目的 `config` 目录下

Laravel :

config/app.php 中`providers`添加

```php
MexSms\Providers\MexsmsServiceProvider::class,
```

Lumen :

bootstrap/app.php 添加

```php
$app->configure('mexsms');
```

```php
$app->register(MexSms\Providers\MexsmsServiceProvider::class);
```


### 使用

```php
// 发送短信验证码
app('mexsms')->send('17300000000', '233233');
// 指定 LeanCloud 短信平台 验证短信验证码
$bool = app('mexsms')->verify(\MexSms\Gateway::SMS_LEANCLOUD, '17300000000', '233233');
if ($bool) {
    // 验证成功.
} else {
    // 验证失败...
}
```


