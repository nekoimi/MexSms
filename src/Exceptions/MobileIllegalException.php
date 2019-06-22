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
 * #     19-6-22  上午9:51
 * #                            ------
 * #    「 涙の雨が頬をたたくたびに美しく 」
 **/
namespace MexSms\Exceptions;
/**
 * Class MobileIllegalException
 *
 * @package MexSms\Exceptions
 */
class MobileIllegalException extends Exception
{

    protected $code = 40401;

    protected $message = '非法手机号.';

    /**
     * MobileIllegalException constructor.
     * @param string $phoneNumber
     */
    public function __construct($phoneNumber = "")
    {
        $this->message = $this->message . " ===> [ $phoneNumber ] ";
    }

}
