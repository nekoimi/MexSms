<?php
/**
 * # ----
 * #     Yprisoner <yyprisoner@gmail.com>
 * #                   2019/8/11 9:23
 * #                            ------
 **/

namespace MexSms\Contracts;
use MexSms\Support\Config;

interface SmsSendInterface {

    /**
     *
     * @param string $toPhoneNumber
     * @param MessageInterface $message
     * @param Config $config
     * @return bool|string
     */
    public function send(string $toPhoneNumber, MessageInterface $message, Config $config);

}
