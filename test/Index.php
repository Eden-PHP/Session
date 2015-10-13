<?php //-->
/**
 * This file is part of the Eden PHP Library.
 * (c) 2014-2016 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */
class EdenSessionIndexTest extends PHPUnit_Framework_TestCase
{
    public function testClear()
    {
        $data   = array('name' => 'juan', 'surname' => 'dela cruz');
        $class  = eden('session')->start()->set($data)->clear();
        $this->assertInstanceOf('Eden\\Session\\Index', $class);
        $this->assertEmpty($class->get());
    }

    public function testGet()
    {
        $data   = array('name' => 'juan', 'surname' => 'dela cruz');
        $class  = eden('session')->start()->set($data);
        foreach ($data as $key => $value) {
            $this->assertEquals($value, $class->get($key));
        }
    }

    public function testGetId()
    {
        $class  = eden('session')->start();
        $this->assertEquals(session_id(), $class->getId());
    }

    public function testRemove()
    {
        $data   = array('name' => 'juan', 'surname' => 'dela cruz');
        $class  = eden('session')->start()->set($data)->remove('name');
        $this->assertInstanceOf('Eden\\Session\\Index', $class);
        $this->assertArrayNotHasKey('name', $class->get());
    }

    public function testSet()
    {
        $data   = array('name' => 'juan', 'surname' => 'dela cruz');
        $class  = eden('session')->start()->set($data);
        $this->assertInstanceOf('Eden\\Session\\Index', $class);
        foreach ($data as $key => $value) {
            $this->assertEquals($value, $class->get($key));
        }
    }

    public function testStart()
    {
        $class  = eden('session')->start();
        $this->assertInstanceOf('Eden\\Session\\Index', $class);
    }

    public function testArrayAccess()
    {
        $class = eden('session')->start();

        $class[] = array('name' => 'John', 'age' => 31);
        $class[] = array('name' => 'Jane', 'age' => 28);

        $this->assertFalse(isset($class[2]));

        $this->assertEquals('Jane', $class[1]['name']);
    }

    public function testIterable()
    {
        $class[]    = eden('session')->start();
        $class[]    = array('name' => 'John', 'age' => 31);
        $class[]    = array('name' => 'Jane', 'age' => 28);
        $class[]    = array('name' => 'Jack', 'age' => 35);

        foreach($class as $key => $value) {
            $this->assertEquals($class[$key]['name'], $value['name']);
        }
    }
}