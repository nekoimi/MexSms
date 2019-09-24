<?php
/**
 * # ----
 * #     Yprisoner <yyprisoner@gmail.com>
 * #               19-8-3  上午7:52
 * #                            ------
 **/

namespace MexSms\Contracts;
use MexSms\Support\Config;

interface SmsVerifyInterface {

    /**
     *
     * @param string $phoneNumber
     * @param $smsCode
     * @param Config $config
     * @return bool
     */
    public function verify(string $phoneNumber, $smsCode, Config $config): bool ;

}
