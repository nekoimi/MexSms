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

    // request timeout
    'timeout' => 5,

    // 允许使用的短信平台列表 按照顺序来
    'gateways'  =>  [
        \MexSms\Gateway::SMS_LEANCLOUD,
        \MexSms\Gateway::SMS_ALIYUN
    ],

    // LeanCloud配置
    'leancloud' => [
        'sms_request_url'   =>  env('MEXSMS_REQUEST_URL', 'https://bfujvuqa.api.lncld.net/1.1/requestSmsCode'),
        'sms_verify_url'    =>  env('MEXSMS_VERIFY_URL', 'https://bfujvuqa.api.lncld.net/1.1/verifySmsCode'),

        'sms_app_id'        =>  env('MEXSMS_LEANCLOUD_APP_ID', 'bfujvuqa'),
        'sms_lc_id'         =>  env('MEXSMS_LEANCLOUD_LC_ID', 'BFUjvUQaqBKSd7ssrjvlbgxy-gzGzoHsz'),
        'sms_lc_key'        =>  env('MEXSMS_LEANCLOUD_LC_KEY', 'LBquKn8IIKCe23nH3GGi81SB')
    ],

    // 阿里云配置
    'aliyun'    =>  [
        'sign_name'         =>  env('MEXSMS_ALIYUN_SIGN_NAME', '桜十玖'),
        'access_key_id'     =>  env('MEXSMS_ALIYUN_ACCESS_KEY_ID', 'LTAIpp90ilA2elhz'),
        'access_key_secret' =>  env('MEXSMS_ALIYUN_ACCESS_KEY_SECRET', 'wuFWdv7b63DN0DUqOAsoo9g59ni45G'),
        'template_code'     =>  env('MEXSMS_ALIYUN_TEMPLATE_CODE', 'SMS_168586548'),
    ],


);
