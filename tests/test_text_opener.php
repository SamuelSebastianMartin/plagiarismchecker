<?php

require '/home/sam/Programs/php/plagcheck/text_opener.php';

class TextOpenerTest extends \PHPUnit_Framework_TestCase
{
    protected $allTexts;
    protected function setUp(): void {
        $this->allTexts = new Texts('~/Programs/php/plagcheck/dummy_input/text1.txt');
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
}

