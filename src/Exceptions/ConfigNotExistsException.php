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
 * #     19-6-21  下午10:15
 * #                            ------
 * #    「 涙の雨が頬をたたくたびに美しく 」
 **/

namespace MexSms\Exceptions;


use Throwable;

class ConfigNotExistsException extends Exception
{

    public function __construct($name = "")
    {
        $this->message = "Config $name not exists.";
    }

}
