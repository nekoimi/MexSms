<?php
/**
 * # ----
 * #     Yprisoner <yyprisoner@gmail.com>
 * #                   19-8-14 上午10:28
 * #                            ------
 **/

namespace MexSms\Contracts;
/**
 * Interface LogHandlerInterface
 * @package MexSms\Contracts
 *
 * 日志外部扩展
 */
interface LogHandlerInterface {

    /**
     * Debug
     *
     * @param string $log
     */
    public function debug(string $log);


    /**
     * Info
     *
     * @param string $log
     */
    public function info(string $log);

    /**
     * Error
     *
     * @param string $log
     */
    public function error(string $log);

}
