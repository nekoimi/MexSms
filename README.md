# MexSms —— Laravel / Lumen

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
$result = mexsms()->send('17300000000', '233233');
if (false === $result) {
    // 发送短信失败
    return;
}
echo $result . PHP_EOL;  // 运营商名称
// 指定 LeanCloud 短信平台 验证短信验证码
$bool = mexsms()->verify(\MexSms\Gateway::SMS_LEANCLOUD, '17300000000', '233233');
if ($bool) {
    // 验证成功.
} else {
    // 验证失败...
}
```


