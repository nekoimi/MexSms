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
 * #     19-6-21  下午10:19
 * #                            ------
 * #    「 涙の雨が頬をたたくたびに美しく 」
 **/
namespace MexSms\Gateways;
use MexSms\Contracts\CacheHandlerInterface;
use MexSms\Contracts\GatewayInterface;
use MexSms\Contracts\LogHandlerInterface;
use MexSms\Contracts\SmsSendInterface;
use MexSms\Contracts\SmsVerifyInterface;
use MexSms\Exceptions\CacheHandlerNotExistsException;
use MexSms\Exceptions\LogHandlerNotExistsException;
use MexSms\Support\Cache;
use MexSms\Support\Config;
use MexSms\Traits\HttpRequestTrait;
/**
 * Class AbstractGateway
 *
 * @package MexSms\Gateways
 */
abstract class AbstractGateway implements GatewayInterface, SmsSendInterface, SmsVerifyInterface
{
    use HttpRequestTrait;

    /**
     *
     * @var Config
     */
    protected $config;

    /**
     *
     * @var int
     */
    protected $timeout;

    /**
     * Get log handler
     *
     * @return LogHandlerInterface
     * @throws LogHandlerNotExistsException
     */
    protected function log(): LogHandlerInterface {
        $logCls = $this->getConfig()->get('log_handler');
        if (is_object($logCls)) {
            $logHandler = $logCls;
        } else {
            if (is_null($logCls) || !class_exists($logCls)) {
                throw new LogHandlerNotExistsException();
            }
            $logHandler = new $logCls;
        }
        if (! $logHandler instanceof LogHandlerInterface) {
            throw new LogHandlerNotExistsException();
        }
        return $logHandler;
    }


    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param Config $config
     * @return AbstractGateway
     */
    public function setConfig(Config $config): self
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return float
     */
    public function getTimeout(): float
    {
        return $this->timeout ?? $this->config->get('timeout', self::$DEFAULT_TIME_OUT);
    }

    /**
     * @param int $timeout
     * @return AbstractGateway
     */
    public function setTimeout(int $timeout): self
    {
        $this->timeout = intval($timeout);

        return $this;
    }


}
