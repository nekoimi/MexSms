<?php
/**
 * # ------------Oooo---
 * # -----------(----)---
 * # ------------)--/----
 * # ------------(_/-
 * # ----oooO----
 * # ----(---)----
 * # -----\--(--
 * # ------\_)-
 * # ----
 * #     author : Yprisoner <yyprisoner@gmail.com>
 * #     19-6-21  下午8:57
 * #                            ------
 * #    「 涙の雨が頬をたたくたびに美しく 」
 **/

return array(

    // Max Limit
    // 'max_limit' => env('SMS_MAX_LIMIT', 5),

    // request timeout
    'timeout' => env('SMS_TIMEOUT', 5),

    // 允许使用的短信平台列表 按照顺序来
    'gateways'  =>  [
        \MexSms\Gateway::SMS_LEANCLOUD,
        \MexSms\Gateway::SMS_ALIYUN
    ],

    // LeanCloud配置
    'leancloud' => [
        'sms_app_id'        =>  env('MEXSMS_LEANCLOUD_APP_ID', ''),
        'sms_lc_id'         =>  env('MEXSMS_LEANCLOUD_LC_ID', ''),
        'sms_lc_key'        =>  env('MEXSMS_LEANCLOUD_LC_KEY', '')
    ],

    // 阿里云配置
    'aliyun'    =>  [
        'sign_name'         =>  env('MEXSMS_ALIYUN_SIGN_NAME', ''),
        'access_key_id'     =>  env('MEXSMS_ALIYUN_ACCESS_KEY_ID', ''),
        'access_key_secret' =>  env('MEXSMS_ALIYUN_ACCESS_KEY_SECRET', ''),
        'template_code'     =>  env('MEXSMS_ALIYUN_TEMPLATE_CODE', ''),
        'verify_handler'    =>  null,  // Verify Class
    ],


);
