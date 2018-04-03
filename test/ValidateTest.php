<?php

use think\Validate;
use PHPUnit\Framework\TestCase;

class ValidateTest extends TestCase
{

    public function testUploadTextFile()
    {
        $data = ['file' => new \File(dirname(__FILE__) . '/demo.txt')];

        $validate = Validate::make([
            'file' => 'safeFile:txt',
        ]);
        $check = $validate->check($data);

        $validate = Validate::make([
            'file' => 'safeFile:png',
        ]);
        $check = $validate->check($data);

        $this->assertFalse($check);
    }

    public function testAllowJpgFIle()
    {
        $data = ['file' => new \File(dirname(__FILE__) . '/jpg.jpg')];
        $validate = Validate::make([
            'file' => 'safeFile:jpg',
        ]);
        $check = $validate->check($data);

        $this->assertTrue($check);

        $validate = Validate::make([
            'file' => 'safeFile:txt',
        ]);
        $check = $validate->check($data);

        $this->assertFalse($check);
    }

    public function testAllowGifFIle()
    {
        $data = ['file' => new \File(dirname(__FILE__) . '/gif.gif')];
        $validate = Validate::make([
            'file' => 'safeFile:gif',
        ]);
        $check = $validate->check($data);

        $this->assertTrue($check);

        $validate = Validate::make([
            'file' => 'safeFile:txt',
        ]);
        $check = $validate->check($data);

        $this->assertFalse($check);
    }

    public function testAllowPngFile()
    {
        $data = ['file' => new \File(dirname(__FILE__) . '/png.png')];
        $validate = Validate::make([
            'file' => 'safeFile:png',
        ]);
        $check = $validate->check($data);

        $this->assertTrue($check);

        $validate = Validate::make([
            'file' => 'safeFile:txt,jpg',
        ]);
        $check = $validate->check($data);

        $this->assertFalse($check);
    }

    public function testMultiFileType()
    {
        $data = ['file' => new \File(dirname(__FILE__) . '/demo.txt')];

        $validate = Validate::make([
            'file' => 'safeFile:txt,jpg,png,gif',
        ]);
        $check = $validate->check($data);

        $this->assertTrue($check);
    }

}