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
 * #     19-6-21  下午8:57
 * #                            ------
 * #    「 涙の雨が頬をたたくたびに美しく 」
 **/
namespace MexSms;
use MexSms\Contracts\GatewayInterface;
use MexSms\Support\Config;
use MexSms\Support\Message;
use MexSms\Traits\HelperTrait;

/**
 * Class MexSms
 *
 * @package MexSms
 */
class MexSms
{
    use HelperTrait;

    /**
     * Gateway List
     * @var array
     */
    protected static $gateways = [
        Gateway::SMS_ALIYUN    =>  \MexSms\Gateways\AliyunGateway::class,
        Gateway::SMS_LEANCLOUD =>  \MexSms\Gateways\LeanCloudGateway::class,
    ];

    /**
     * @param string $toPhoneNumber
     * @param int $smsCode
     * @throws Exceptions\MobileIllegalException
     */
    public function send(string $toPhoneNumber, int $smsCode = -1) {
        self::checkPhoneNumber($toPhoneNumber);

        $config = new Config(
            app('config')->get('mexsms')
        );

        $allows = self::formatGateways($config);

        $message = new Message(array(
            'code'  =>  $smsCode
        ));

        foreach ($allows as $allow) {
            /**@var GatewayInterface $gateway*/
            $gateway = app($allow);
            $gateway->setConfig($config);
            if ($gateway->send($toPhoneNumber, $message, $config)){
                break;
            }
        }
    }


    /**
     *
     * @param Config $config
     * @return array
     */
    protected function formatGateways(Config $config) {
        $gateways = $config->get('gateways');
        $allows = array();
        array_walk($gateways, function ($gatewayName) use (&$allows) {
            if (in_array($gatewayName, array_keys(self::$gateways))) {
                $allows[] = self::$gateways[$gatewayName];
            }
        });
        return $allows;
    }

}
