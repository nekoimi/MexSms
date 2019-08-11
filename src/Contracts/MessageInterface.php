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
 * #     19-6-21  下午9:04
 * #                            ------
 * #    「 涙の雨が頬をたたくたびに美しく 」
 **/
namespace MexSms\Contracts;
/**
 * Interface MessageInterface
 *
 * @package MexSms\Contracts
 */
interface MessageInterface
{
    /**
     *
     * @param GatewayInterface|null $gateway
     * @return mixed
     */
    public function getTemplate(GatewayInterface $gateway = null);

    /**
     *
     * @param GatewayInterface|null $gateway
     * @return mixed
     */
    public function getTemplateDate(GatewayInterface $gateway = null);

}
