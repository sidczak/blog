<?php

namespace BlogBundle\Utils;

class Blog
{
    static public function slugify($text)
    {
	$polish_chars = array('Ą', 'Ć', 'Ę', 'Ł', 'Ń', 'Ó', 'Ś', 'Ż', 'Ź', 'ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ż', 'ź');
	$replace     = array('A', 'C', 'E', 'L', 'N', 'O', 'S', 'Z', 'Z', 'a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z');
	$text = str_replace($polish_chars, $replace, $text);
        
        $text = strip_tags($text);
   
    	// replace all non letters or digits by -
        $text = preg_replace('/\W+/', '-', $text);
 
        // trim and lowercase
        $text = strtolower(trim($text, '-'));
 
        return $text;
    }
}