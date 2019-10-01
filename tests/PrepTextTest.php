<?php

//require_once('PrepText.php');

use \PHPUnit\Framework\TestCase;
class PrepTextTest extends TestCase{

    protected function setUp(): void {
        $this->text = "...Capitals, punctuation. 'quotes'? sam@email.co.uk www.soas.ac.uk 197 (Smith, 2018)";
        $this->pObj = new PrepText($this->text);
    }

    public function testConstructIsNotNull(){
        $pObj = new PrepText($this->text);
        $this->assertNotNull($pObj->getText());
    }

    public function testTextIsAccurate(){
        $expected = $this->text;
        $result = $this->pObj->getText();
        $this->assertEquals($result, $expected);
    }

    public function testStrippedIsString(){
        $this->assertTrue(is_string($this->pObj->stripText()));
    }

    public function testStrippedIsLower(){
        $result = $this->pObj->stripText();
        $this->assertNotRegExp('/[A-Z]/', $result);
    }

    public function testWordsIsLower(){
        $expected = "capitals";
        $result = $this->pObj->getWords();
        $this->assertTrue($result[0] == $expected);
        $this->assertNotRegExp('/[A-Z]/', $result[0]);
    }

    /** Note spaces are preserved, punctuation deleted (not made into spaces).*/
    public function testWordsNoPunctuationInner(){
        $result = $this->pObj->getWords()[2];
        $expected = "quotes";
        $this->assertEquals($result, $expected);
    }

    public function testWordsNoPunctuationOuter(){
        $array = $this->pObj->getWords();
        $result = $array[count($array) -1];
        $expected = "2018";
        $this->assertEquals($result, $expected);
    }

    public function testEmailsPreserved(){
        $expected = "sam@email.co.uk";
        $result = $this->pObj->getWords()[3];
        $this->assertEquals($result, $expected);
    }

    public function testURLsPreserved(){
        $expected = "www.soas.ac.uk";
        $result = $this->pObj->getWords()[4];
        $this->assertEquals($result, $expected);
    }

    public function testNumbersPreserved(){
        $expected = "197";
        $result = $this->pObj->getWords()[5];
        $this->assertEquals($result, $expected);
    }
    public function testMultiSpacesNotInArray(){
        $obj = new PrepText('this   world');  // Multiple spaces.
        $this->assertEquals(count($obj->getWords()), 2);
    }

    public function testWordsIsArray(){
        $this->assertIsArray($this->pObj->getWords());
    }

/** Tests for KEYWORDS  */
    public function testKeywordsIsArray(){
        $this->assertIsArray($this->pObj->getKeywords());
    }

    public function testKeywordsLength(){
        $keyLen = count($this->pObj->getKeywords());
        $worLen = count($this->pObj->getWords());
        $this->assertTrue($keyLen <= $worLen);
    }

    public function testKeywordsRemoved(){
        $stpObj = new PrepText('the and cat');
        $expected = 'cat';
        $result = $stpObj->getKeywords()[0];
        $this->assertEquals($result, $expected);
    }
}
