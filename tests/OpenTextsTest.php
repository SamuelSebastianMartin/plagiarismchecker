<?php

use \PHPUnit\Framework\TestCase;

class OpenTextsTest extends TestCase{

    protected $allTexts;

    protected function setUp(): void {
        $fp = fopen('test_data.txt', 'w');
        fwrite($fp, 'this is the first line\n');
        fwrite($fp, '');
        fwrite($fp, 'this is the last line');
        fclose($fp);

        $this->allTexts = new OpenTexts('test_data.txt');
    }

    public function testTextIsLoaded(){
        $text = $this->allTexts->text;
        $this->assertNotEmpty($text, $message = 'Text not loaded');
        $this->assertNotCount(0, [$text]);
    }
    public function testParaIsLoaded(){
        $paras = $this->allTexts->paras;
        $this->assertNotEmpty($paras, $message = 'Text not loaded into paragraph array');
        $this->assertNotCount(0, [$paras]);
    }
    protected function tearDown(): void {
        unlink('test_data.txt');
    }
}

