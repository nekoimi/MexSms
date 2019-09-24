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
 * #     19-6-21  下午9:07
 * #                            ------
 * #    「 涙の雨が頬をたたくたびに美しく 」
 **/
namespace MexSms\Support;
use Illuminate\Support\Str;

/**
 * Class Config
 *
 * @package MexSms\Support
 */
class Config implements \ArrayAccess
{

    /**
     *
     * @var array
     */
    private $config;

    /**
     * Config constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     *
     * @param $name
     * @param null $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        $config = $this->config;

        if (!Str::contains($name, '.')){
            if (!isset($config[$name])) {
                return $default;
            }
            return $config[$name];
        }

        foreach (explode('.', $name) as $item) {
            if (!is_array($config) || !array_key_exists($item, $config)) {
                 return $default;
            }

            $config = $config[$item];
        }

        return $config;
    }


    /**
     * @return bool
     */
    public function offsetExists($name)
    {
        return array_key_exists($name, $this->config);
    }


    /**
     *
     * @param mixed $name
     * @return mixed
     */
    public function offsetGet($name)
    {
        return $this->get($name);
    }


    /**
     *
     * @param mixed $name
     * @param mixed $value
     */
    public function offsetSet($name, $value)
    {
        if (isset($this->config[$name])) {
            $this->config[$name] = $value;
        }
    }

    /**
     *
     * @param mixed $name
     */
    public function offsetUnset($name)
    {
        if (isset($this->config[$name])) {
            unset($this->config[$name]);
        }
    }
}
