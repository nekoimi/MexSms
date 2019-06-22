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
use MexSms\Exceptions\GatewayErrorException;
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
     * 允许使用的短信平台
     * @var array
     */
    protected $allows = [];

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

        $config = $this->getConfig();

        $this->formatGateways($config);

        $message = new Message(array(
            'code'  =>  $smsCode
        ));

        foreach ($this->allows as $allow) {
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
     * @param string $gatewayName
     * @param string $phoneNumber
     * @param $smsCode
     * @return bool
     * @throws Exceptions\MobileIllegalException
     * @throws GatewayErrorException
     */
    public function verify(string $gatewayName, string $phoneNumber, $smsCode) {
        self::checkPhoneNumber($phoneNumber);

        $config = $this->getConfig();

        $this->formatGateways($config);

        if (!in_array($gatewayName, array_keys(self::$gateways))) {
            throw new GatewayErrorException();
        }

        /**@var GatewayInterface $gateway*/
        $gateway = app(self::$gateways[$gatewayName]);
        $gateway->setConfig($config);
        if (method_exists($gateway, 'verify')) {
            return $gateway->verify($phoneNumber, strval($smsCode), $config);
        }

        return false;
    }

    /**
     *
     * @param Config $config
     */
    protected function formatGateways(Config $config) {
        $gateways = $config->get('gateways');
        $allows = array();
        array_walk($gateways, function ($gatewayName) use (&$allows) {
            if (in_array($gatewayName, array_keys(self::$gateways))) {
                $allows[] = self::$gateways[$gatewayName];
            }
        });
        $this->allows = $allows;
    }


    /**
     *
     * @return Config
     */
    protected function getConfig() {
        return new Config(
            app('config')->get('mexsms')
        );
    }

}
