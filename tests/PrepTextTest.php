<?php

//require_once('PrepText.php');

use \PHPUnit\Framework\TestCase;
class PrepTextTest extends TestCase{

    protected function setUp(): void {
        $this->text = "Capitals, punctuation. 'quotes'? sam@email www.soas.ac.uk 197 (Smith, 2018)";
        $this->prepObject = new PrepText($this->text);
    }

    public function testConstructIsNotNull(){
        $prepObject = new PrepText($this->text);
        $this->assertNotNull($prepObject->text);
    }
    public function testTextIsAccurate(){
        $expected = $this->text;
        $result = $this->prepObject->text;
        $this->assertEquals($result, $expected);
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

    public function testSplitYieldsAnArray(){
        $array = $this->prepObject->splitIntoWords('one two');
        $this->assertIsArray($array);
    }

    public function testMultiSpacesNotInArray(){
        $array = $this->prepObject->splitIntoWords('one   two');
        $this->assertEquals(count($array), 2);
    }
    public function testWordsIsArray(){
        $this->assertIsArray($this->prepObject->words);
    }
}
