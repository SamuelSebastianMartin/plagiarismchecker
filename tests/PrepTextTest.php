<?php

//require_once('prepare_texts.php');

use \PHPUnit\Framework\TestCase;
class PrepTextTest extends TestCase{

    protected function setUp(): void {
        $this->text = "Capitals, punctuation. 'quotes'? sam@email www.soas.ac.uk 197 (Smith, 2018)";
        $this->prepObject = new PrepText($this->text);
    }

    public function testIsLower(){
        $expected = "capitals, punctuation. 'quotes'? sam@email www.soas.ac.uk 197 (smith, 2018)";
        $result = $this->prepObject->lower($this->text);
        $this->assertTrue($result == $expected);
        $this->assertNotRegExp('/[A-Z]/', $result);
    }

    /** Note spaces are preserved, punctuation deleted (not made into spaces).*/
    public function testNoPunctuationInner(){
        $innerPunct = "string, 'with?' -punctuation";
        $result = $this->prepObject->stripPunct($innerPunct);
        $expected = "string with punctuation";
        $this->assertEquals($result, $expected);
    }

    public function testNoPunctuationOuter(){
        $outerPunct = "(string), 'with?' -punctuation!";
        $result = $this->prepObject->stripPunct($outerPunct);
        $expected = "string with punctuation";
        $this->assertEquals($result, $expected);
    }
}
