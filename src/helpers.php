    <?php
/**
 * # ----
 * #     Yprisoner <yyprisoner@gmail.com>
 * #                   2019/8/11 9:20
 * #                            ------
 **/ 

if (! function_exists('maxsms')) {

    /**
     * @return \MexSms\MexSms
     */
    function mexsms() {
        return app('mexsms');
    }
}
