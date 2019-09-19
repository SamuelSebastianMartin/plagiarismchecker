<?php

require '/home/sam/Programs/php/plagcheck/text_opener.php';

class TextOpenerTest extends \PHPUnit_Framework_TestCase
{
    protected $allTexts;

    protected function setUp(): void {
        $fp = fopen('test_data.txt', 'w');
        fwrite($fp, 'this is the first line\n');
        fwrite($fp, '');
        fwrite($fp, 'this is the last line');
        fclose($fp);

        $this->allTexts = new Texts('test_data.txt');
        var_dump($this->allTexts);
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
    protected function tearDown(){
        unlink('test_data.txt');
    }
}

