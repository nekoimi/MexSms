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
 * #     19-6-22  上午7:55
 * #                            ------
 * #    「 涙の雨が頬をたたくたびに美しく 」
 **/
namespace MexSms\Gateways;
use MexSms\Contracts\MessageInterface;
use MexSms\Gateway;
use MexSms\Support\Config;
/**
 * Class AliyunGateway
 *
 * @package MexSms\Gateways
 */
class AliyunGateway extends AbstractGateway
{

    const SMS_API = 'http://dysmsapi.aliyuncs.com';
    const SMS_ACTION = 'SendSms';
    const SMS_FORMAT = 'JSON';

    /**
     *
     * @param string $toPhoneNumber
     * @param MessageInterface $message
     * @param Config $config
     * @return bool
     */
    public function send(string $toPhoneNumber, MessageInterface $message, Config $config) : bool
    {
        $templateData = $message->getTemplateDate($this);

        $signName = $config->get($this->getName() . '.sign_name');

        $params = array(
            'RegionId' => 'cn-hangzhou',
            'PhoneNumbers'  =>  $toPhoneNumber,
            'TemplateCode'  =>  $message->getTemplate($this),
            'TemplateParam' =>  json_encode($templateData, JSON_FORCE_OBJECT),
            'AccessKeyId'   =>  $config->get($this->getName() . '.access_key_id'),
            'Action'        =>  self::SMS_ACTION,
            'Format'        =>  self::SMS_FORMAT,
            'Version'       => '2017-05-25',
            'SignName'      =>  $signName,
            'SignatureMethod'   => 'HMAC-SHA1',
            'SignatureVersion'  => '1.0',
            'SignatureNonce'    => uniqid(),
            'Timestamp'         => gmdate('Y-m-d\TH:i:s\Z'),
        );

        $params['Signature'] = $this->generateSign($params);

        $result = $this->doGet(self::SMS_API, $params);

        if ('OK' != $result['Code']) {
            app('log')->error(__CLASS__ . " : 短信发送失败! [ $toPhoneNumber ]  ===> Code : {$result['Code']}  Des: [ {$result['Message']} ] ");
            return false;
        }

        app('log')->info(__CLASS__ . " : 短信发送成功! [ $toPhoneNumber ] ");

        return true;
    }

    /**
     *
     * @return string
     */
    public function getName(): string
    {
        return Gateway::SMS_ALIYUN;
    }

    protected function generateSign($params)
    {
        ksort($params);
        $accessKeySecret = $this->config->get($this->getName() . '.access_key_secret');
        $stringToSign = 'GET&%2F&'.urlencode(http_build_query($params, null, '&', PHP_QUERY_RFC3986));

        return base64_encode(hash_hmac('sha1', $stringToSign, $accessKeySecret.'&', true));
    }

}
