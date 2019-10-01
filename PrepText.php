<?php

/** This class takes as input a string, and
 * converts it into an array of individual
 * words from that string. All punctuation
 * is stripped, unless it occurs inside a
 * word (eg www.url.com or name@mail.com).
 * There are 3 puplic methods:
 *    getText() returns the orininal input.
 *    getWords() returns the array of words.
 *    stripText() returns the original with
 *        punctuation removed and lower case.
 */
class PrepText{

    private $text = null;
    private $stripped = null;
    private $words = null;
    private $keywords = null;

    public function __construct($inputText){
        $this->text = $inputText;
        $this->stopWords = ['the', 'and'];
    }

    /** This is merely the input text */
    public function getText(){
        return $this->text;
    }

    /** This is the original string, but in
     * lower case, with punctuation removed
     * if it is not within a word.
     */
    public function stripText(){
        $textLower = $this->lower($this->text);
        $textNoPunct = $this->stripPunct($textLower);
        $textSingleSpace = $this->singleSpace($textNoPunct);
        return $textSingleSpace;
    }

    /** This is the array of individual words
     * from the text, in lower case and with
     * punctuation removed (unless it occurs
     * inside a word boundary, like URLs etc.)
     */
    public function getWords(){
        $this->stripped = $this->stripText();
        $textSplit = $this->splitIntoWords($this->stripped);
        return $textSplit;
    }

    protected function lower($string){
        return strtolower($string);
    }

    public function getKeywords(){
        $list = $this->getWords();
        foreach($list as $k => $v){
            if (in_array($v, $this->stopWords)){
                unset($list[$k]);
            }
        }
        return $list;
    }
    /** Below are helper functions */

    protected function stripPunct($string){
        $string = preg_replace('/\W*\s\W*/', ' ', $string); // Internal Punctuation.
        $string = preg_replace('/^\W*/', '', $string); // Punct at start.
        $string = preg_replace('/\W*$/', '', $string); // Punct at end.
        return $string;
    }

    protected function singleSpace($string){
        $string = preg_replace ('/[[:blank:]]+/', ' ',$string);
        return $string;
    }
    protected function splitIntoWords($string){
        $words = explode(' ', $string);
        return $words;
    }
}
