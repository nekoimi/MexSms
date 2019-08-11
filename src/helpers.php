    <?php
/**
 * # ----
 * #     Yprisoner <yyprisoner@gmail.com>
 * #                   2019/8/11 9:20
 * #                            ------
 **/ 

if (! function_exists('maxsms')) {

    /**
     * @return \MexSms\Contracts\SmsSendInterface|\MexSms\Contracts\SmsVerifyInterface
     */
    function mexsms() {
        return app('mexsms');
    }
}
