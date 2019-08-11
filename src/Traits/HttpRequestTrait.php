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
 * #     19-6-21  下午10:40
 * #                            ------
 * #    「 涙の雨が頬をたたくたびに美しく 」
 **/
namespace MexSms\Traits;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use MexSms\Support\Request;
use Psr\Http\Message\ResponseInterface;

/**
 * Trait HttpRequestTrait
 *
 * @package MexSms\Traits
 */
trait HttpRequestTrait
{

    /**
     *
     * @var int
     */
    static $DEFAULT_TIME_OUT = 5;


    /***
     *
     * @param string $request_uri
     * @param array $query
     * @param array $headers
     * @return mixed
     */
    protected function doGet(string $request_uri, array $query = [], array $headers = []) {
        return $this->doRequest(Request::METHOD_GET, $request_uri, array(
            'headers'   =>  $headers,
            'query'     =>  $query
        ));
    }

    /**
     *
     * @param string $request_uri
     * @param array $data
     * @param array $headers
     * @return mixed
     */
    protected function doPost(string $request_uri, array $data = [], array $headers = []) {
        return $this->doRequest(Request::METHOD_POST, $request_uri, array(
            'headers'   =>  $headers,
            'form_params'   =>  $data
        ));
    }

    /**
     *
     * @param string $method
     * @param string $request_uri
     * @param array $options
     * @return mixed
     */
    protected function doRequest(string $method, string $request_uri, $options = []) {
        return $this->clearResponse(
            $this->newClient(
                $this->getDefaultOptions()
            )->{$method}($request_uri, $options)
        );
    }

    /**
     * default options
     * @return array
     */
    protected function getDefaultOptions() {
        return array(
            'base_uri' => method_exists($this, 'getBaseUri') ? $this->getBaseUri() : '',
            'timeout'  => method_exists($this, 'getTimeout') ? $this->getTimeout() : static::$DEFAULT_TIME_OUT,
        );
    }

    /**
     *
     * @param array $options
     * @return Client
     */
    protected function newClient(array $options = array()) {
        return new Client($options);
    }


    /***
     *
     * @param ResponseInterface $response
     * @return mixed|string
     */
    protected function clearResponse (ResponseInterface $response) {
        $contentType = $response->getHeaderLine('Content-Type');
        $contents = $response->getBody()->getContents();

        if (Str::contains($contentType,'json')) {
            return json_decode($contents, true);
        } elseif (Str::contains($contentType, 'xml')) {
            return $this->xmlToArray($contents);
        }

        return $contents;
    }

    /**
     *
     * @param string $xml
     * @return mixed
     */
    protected function xmlToArray(string $xml) {
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $xml_string = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        return json_decode(json_encode($xml_string),true);
    }

}
