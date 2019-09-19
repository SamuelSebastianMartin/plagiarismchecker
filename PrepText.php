<?php

class PrepText{
    public $text;

    public function __constuct($text){
        $this->text = $text;
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
}
