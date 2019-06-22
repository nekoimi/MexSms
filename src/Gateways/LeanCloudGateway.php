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
 * #     19-6-22  上午10:06
 * #                            ------
 * #    「 涙の雨が頬をたたくたびに美しく 」
 **/
namespace MexSms\Gateways;
use MexSms\Contracts\MessageInterface;
use MexSms\Gateway;
use MexSms\Support\Config;
/**
 * Class LeanCloudGateway
 *
 * @package MexSms\Gateways
 */
class LeanCloudGateway extends AbstractGateway
{

    /**
     *
     * @param string $toPhoneNumber
     * @param MessageInterface $message
     * @param Config $config
     * @return bool
     */
    public function send(string $toPhoneNumber, MessageInterface $message, Config $config): bool
    {
        // TODO: Implement send() method.
    }

    /**
     *
     * @return string
     */
    public function getName(): string
    {
        return Gateway::SMS_LEANCLOUD;
    }
}
