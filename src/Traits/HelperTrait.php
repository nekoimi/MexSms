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
 * #     19-6-21  下午10:58
 * #                            ------
 * #    「 涙の雨が頬をたたくたびに美しく 」
 **/
namespace MexSms\Traits;
use MexSms\Exceptions\MobileIllegalException;

/**
 * Trait HelperTrait
 *
 * @package MexSms\Traits
 */
trait HelperTrait
{

    static $REGEX_PHONE_NUMBER = '/^[1](([3][0-9])|([4][5-9])|([5][0-3,5-9])|([6][5,6])|([7][0-8])|([8][0-9])|([9][1,8,9]))[0-9]{8}$/';

    /**
     *
     * @param string $phoneNumber
     * @throws MobileIllegalException
     */
    protected static function checkPhoneNumber(string $phoneNumber) {
        if (!preg_match(static::$REGEX_PHONE_NUMBER, $phoneNumber)) {
            throw new MobileIllegalException($phoneNumber);
        }
    }

}
