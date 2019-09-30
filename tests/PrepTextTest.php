<?php

//require_once('PrepText.php');

use \PHPUnit\Framework\TestCase;
class PrepTextTest extends TestCase{

    protected function setUp(): void {
        $this->text = "...Capitals, punctuation. 'quotes'? sam@email.co.uk www.soas.ac.uk 197 (Smith, 2018)";
        $this->prepObject = new PrepText($this->text);
    }

    public function testConstructIsNotNull(){
        $prepObject = new PrepText($this->text);
        $this->assertNotNull($prepObject->getText());
    }
    public function testTextIsAccurate(){
        $expected = $this->text;
        $result = $this->prepObject->getText();
        $this->assertEquals($result, $expected);
    }
    public function testIsLower(){
        $expected = "capitals";
        $result = $this->prepObject->getWords();
        $this->assertTrue($result[0] == $expected);
        $this->assertNotRegExp('/[A-Z]/', $result[0]);
    }

    /** Note spaces are preserved, punctuation deleted (not made into spaces).*/
    public function testNoPunctuationInner(){
        $result = $this->prepObject->getWords()[2];
        $expected = "quotes";
        $this->assertEquals($result, $expected);
    }

    public function testNoPunctuationOuter(){
        $array = $this->prepObject->getWords();
        $result = $array[count($array) -1];
        $expected = "2018";
        $this->assertEquals($result, $expected);
    }

    public function testEmailsPreserved(){
        $expected = "sam@email.co.uk";
        $result = $this->prepObject->getWords()[3];
        $this->assertEquals($result, $expected);
    }

    public function testURLsPreserved(){
        $expected = "www.soas.ac.uk";
        $result = $this->prepObject->getWords()[4];
        $this->assertEquals($result, $expected);
    }

    public function testNumbersPreserved(){
        $expected = "197";
        $result = $this->prepObject->getWords()[5];
        $this->assertEquals($result, $expected);
    }
    public function testMultiSpacesNotInArray(){
        $obj = new PrepText('this   world');  // Multiple spaces.
        $this->assertEquals(count($obj->getWords()), 2);
    }

    public function testWordsIsArray(){
        $this->assertIsArray($this->prepObject->getWords());
    }
}
