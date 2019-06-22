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
 * #     19-6-21  下午9:05
 * #                            ------
 * #    「 涙の雨が頬をたたくたびに美しく 」
 **/
namespace MexSms\Contracts;
use MexSms\Support\Config;

/**
 * Interface GatewayInterface
 *
 * @package MexSms\Contracts
 */
interface GatewayInterface
{

    /**
     *
     * @return string
     */
    public function getName(): string ;


    /**
     *
     * @param string $toPhoneNumber
     * @param MessageInterface $message
     * @param Config $config
     * @return bool
     */
    public function send(string $toPhoneNumber, MessageInterface $message, Config $config) : bool ;

}
