<?php

class PrepText{

    public $text = null;
    public $words = null;

    public function __construct($inputText){
        $this->text = $inputText;
        $this->words = $this->getWords();
    }

    public function getWords(){
        $textLower = $this->lower($this->text);
        $textNoPunct = $this->stripPunct($textLower);
        $textSplit = $this->splitIntoWords($textNoPunct);
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

    public function splitIntoWords($string){
        $words = preg_split('/\s*/', $string, PREG_SPLIT_NO_EMPTY);
        return $words;
    }
}
