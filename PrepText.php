<?php

class PrepText{

    private $text = null;
    private $words = null;

    public function __construct($inputText){
        $this->text = $inputText;
    }

    public function getText(){
        return $this->text;
    }

    public function getWords(){
        $textLower = $this->lower($this->text);
        $textNoPunct = $this->stripPunct($textLower);
        $textSingleSpace = $this->singleSpace($textNoPunct);
        $textSplit = $this->splitIntoWords($textSingleSpace);
        return $textSplit;
    }

    public function lower($string){
        return strtolower($string);
    }

    public function stripPunct($string){
        $string = preg_replace('/\W*\s\W*/', ' ', $string); // Internal Punctuation.
        $string = preg_replace('/^\W*/', '', $string); // Punct at start.
        $string = preg_replace('/\W*$/', '', $string); // Punct at end.
        return $string;
    }

    public function singleSpace($string){
        $string = preg_replace ('/[[:blank:]]+/', ' ',$string);
        return $string;
    }
    public function splitIntoWords($string){
        $words = explode(' ', $string);
        return $words;
    }
}
