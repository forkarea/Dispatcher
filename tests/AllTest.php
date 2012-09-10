<?php

use Dispatcher\Generator,
    AllTest\Route,
    AllTest\Request;

class AllTest extends \phpunit_framework_testcase
{
    public function testCompile()
    {
        $gen  = new Generator;
        $file = __DIR__ . '/generated/' . __CLASS__ . '.php';
        $this->assertFalse(file_Exists($file));
        $gen->addDirectory(__DIR__ . '/input');
        $gen->setNamespace(__CLASS__);
        $gen->setOutput($file);
        $gen->generate();

        $this->assertTrue(file_Exists($file));

        require ($file);
    }

    /** @depends testCompile */
    public function testUrlSorting()
    {
        $route = new Route;
        $req   = new Request;
        $req->set('phpunit', $this);
        $out = $route->doRoute($req, array('REQUEST_URI' => '/function/reverse'));
        $this->assertEquals($out, 'some_function');
        $this->assertEquals(NULL, $req->get('reverse'));

        $out = $route->doRoute($req, array('REQUEST_URI' => '/function/esrever'));
        $this->assertEquals($out, 'some_function');
        $this->assertEquals('esrever', $req->get('reverse'));
    }

    /** @depends testCompile */
    public function testSetIfEmpty()
    {
        $route = new Route;
        $req   = new Request;
        $req->set('phpunit', $this);
        $out = $route->doRoute($req, array('REQUEST_URI' => '/ifempty/algo'));
        $this->assertEquals('ALGO', $req->get('algo-alias'));
    }

}
