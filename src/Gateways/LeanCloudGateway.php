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
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
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
        $request_uri = $this->formatRequestApi($config);
        $params = $this->formatParams($toPhoneNumber, $config);
        try{
            $result = $this->doPost($request_uri, $params);
            app('log')->info(var_export($result, true));
            app('log')->info(__CLASS__ . " : 短信发送成功! [ $toPhoneNumber ] ");
            return true;
        }catch (ClientException $ex) {
            $statusCode     =   $ex->getResponse()->getStatusCode();
            $reasonPhrase   =   $ex->getResponse()->getReasonPhrase();
            app('log')->error(__CLASS__ . " : 短信发送失败! [ {$toPhoneNumber} ] 状态码 : {$statusCode} ; 错误信息 : {$reasonPhrase} ");
            return false;
        }catch (GuzzleException $ex) {
            $reasonPhrase = $ex->getTraceAsString();
            app('log')->error(__CLASS__ . " : 短信发送失败! [ {$toPhoneNumber} ] 错误信息 : {$reasonPhrase} ");
            return false;
        }catch (\Throwable $ex) {
            $reasonPhrase = $ex->getTraceAsString();
            app('log')->error(__CLASS__ . " => CatchThrowable : 短信发送失败! [ {$toPhoneNumber} ] 错误信息 : {$reasonPhrase} ");
            return false;
        }

    }


    /**
     *
     * @param string $phoneNumber
     * @param $smsCode
     * @param Config $config
     * @return bool
     */
    public function verify(string $phoneNumber, $smsCode, Config $config): bool
    {
        $request_uri = $this->formatRequestApi($config);
        $params = $this->formatParams($phoneNumber, $config);

        try{
            $result = $this->doPost($request_uri, $params);
            app('log')->info(var_export($result, true));
            app('log')->info(__CLASS__ . " : 短信验证成功! [ $phoneNumber ] ");
            return true;
        }catch (ClientException $ex) {
            $statusCode     =   $ex->getResponse()->getStatusCode();
            $reasonPhrase   =   $ex->getResponse()->getReasonPhrase();
            app('log')->error(__CLASS__ . " : 短信验证失败! [ {$phoneNumber} ] 状态码 : {$statusCode} ; 错误信息 : {$reasonPhrase} ");
            return false;
        }catch (GuzzleException $ex) {
            $reasonPhrase = $ex->getTraceAsString();
            app('log')->error(__CLASS__ . " : 短信验证失败! [ {$phoneNumber} ] 错误信息 : {$reasonPhrase} ");
            return false;
        }catch (\Throwable $ex) {
            $reasonPhrase = $ex->getTraceAsString();
            app('log')->error(__CLASS__ . " => CatchThrowable : 短信验证失败! [ {$phoneNumber} ] 错误信息 : {$reasonPhrase} ");
            return false;
        }

    }

    /**
     *
     * @return string
     */
    public function getName(): string
    {
        return Gateway::SMS_LEANCLOUD;
    }


    /**
     *
     * @param string $toPhoneNumber
     * @param Config $config
     * @return array
     */
    protected function formatParams (string $toPhoneNumber, Config $config) {
        return array(
            'headers' => [
                'X-LC-Id' => $config->get($this->getName() . '.sms_lc_id'),
                'X-LC-Key' => $config->get($this->getName() . '.sms_lc_key'),
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'mobilePhoneNumber' => strval($toPhoneNumber)
            ]
        );
    }


    /**
     *
     * @param Config $config
     * @param string $smsCode
     * @return string
     */
    protected function formatRequestApi(Config $config, string $smsCode = ""): string {
        $app_id = $config->get($this->getName() . '.app_id');
        if (!empty($smsCode)) {
            return "https://{$app_id}.api.lncld.net/1.1/verifySmsCode/" . strval($smsCode);
        }

        return "https://{$app_id}.api.lncld.net/1.1/requestSmsCode";
    }

}
