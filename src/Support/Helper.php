<?php
/**
 * # ----
 * #     Yprisoner <yyprisoner@gmail.com>
 * #                   19-8-14 上午11:09
 * #                            ------
 **/

namespace MexSms\Support;

class Helper {

    /**
     * @param string $mobile
     * @param Config $config
     * @return bool
     */
    public static function checkSendLimit(string $mobile, Config $config): bool {
        $max_limit = $config->get('max_limit');
        if (is_null($max_limit) || (string)$max_limit === "") {
            return true;
        }
        if (!Cache::instance()->has($mobile)) {
            return true;
        }
        if ((int)Cache::instance()->get($mobile) <= intval($max_limit)) {
            return true;
        }
        return false;
    }


    /**
     * @param string $mobile
     */
    public static function increment(string $mobile) {
        $new = 1;
        if (Cache::instance()->has($mobile)) {
            $new = (int)Cache::instance()->has($mobile) + 1;
        }
        Cache::instance()->set($mobile, $new, 60 * 60);
    }

}
