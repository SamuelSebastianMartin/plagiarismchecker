<?php

/**
 * This currently opens text files (.txt) and makes the contents
 * available as a single string, or as an array with one paragraph
 * per index.
 * It takes one argument: the path to the the required file. For
 * example Texts('/PATH/TO/DIRECTORY/file.txt');
 *
 * Soon, it will have to open docx and pdf files.
 */
class Texts{

    /** This is the text of the file, returned as a single string*/
    public $text = null;

    /** This is the text as an array of paragraphs. */
    public $paras = null;

    public function __construct($text_path){
        $this->text = $this->open_as_text($text_path);
        $this->paras = $this->open_as_paragraphs($text_path);
    }

    /** Reads the file into a single string. */
    public function open_as_text($filepath){
        return file_get_contents('./dummy_data_input/text1.txt'); //Why does this fail with $filepath as argument?
    }

    /** Reads the file into an array of paragraphs. */
    public function open_as_paragraphs($filepath){
        return file('./dummy_data_input/text1.txt', FILE_IGNORE_NEW_LINES); //Why does this fail with $filepath as argument?
    }
}



$all_texts = new Texts('./dummy_data_input/text1.txt');
var_dump($all_texts);
