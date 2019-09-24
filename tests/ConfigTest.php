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
 * #     19-6-22  上午10:59
 * #                            ------
 * #    「 涙の雨が頬をたたくたびに美しく 」
 **/
namespace MexSms\Tests;
use MexSms\Support\Config;

class ConfigTest extends TestCase
{

    public function testConfig () {

        $config = new Config(array(
            'name'  =>  '张三',
            'age'   =>  18,
            'friends'   =>  array(
                'name'  =>  '李四',
                'age'   =>  18
            )
        ));


        $this->assertEquals($config->get('name')
        , '张三');
        $this->assertEquals($config->get('age')
            , 18);
        $this->assertEquals($config->get('friends.name')
            , '李四');
    }

}
