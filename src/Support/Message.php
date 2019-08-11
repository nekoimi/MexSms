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
 * #     19-6-22  上午8:07
 * #                            ------
 * #    「 涙の雨が頬をたたくたびに美しく 」
 **/
namespace MexSms\Support;
use MexSms\Contracts\GatewayInterface;
use MexSms\Contracts\MessageInterface;
/**
 * Class Message
 *
 * @package MexSms\Support
 */
class Message implements MessageInterface
{
    /**
     *
     * @var string
     */
    protected $content;

    /**
     *
     * @var string
     */
    protected $template;

    /**
     *
     * @var int
     */
    protected $code = -1;


    /**
     * Message constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $property => $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }

    /**
     *
     * @param GatewayInterface|null $gateway
     * @return mixed
     */
    public function getTemplate(GatewayInterface $gateway = null)
    {
        return $gateway->getConfig()->get($gateway->getName())['template_code'];
    }

    /**
     *
     * @param GatewayInterface|null $gateway
     * @return mixed
     */
    public function getTemplateDate(GatewayInterface $gateway = null)
    {
        return array(
            "code"  =>  "$this->code"
        );
    }
}
