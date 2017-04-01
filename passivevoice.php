#!/usr/bin/env php
<?php

include 'startup.php';

Class PassiveHandler {
	private static $words = [];
	private static $irragulaRexExp = 'am|are|were|being|is|been|was|be';

	private static function appendWords(array $words){
		self::$words = array_merge(self::$words, $words);
	}

	public static function appendWordsFromFile($fileName){
		$lines = file($fileName);
		$words = array_filter(
					array_map(
						function($var){return strtok($var, ' ');}, 
						array_map('trim', $lines)
					), 
					function($line){return !empty($line) ? true : false;}
		);

		self::appendWords($words);
	}

	public static function getWords(){
		return implode('|', self::$words);
	}

	public static function getRegularExpression(){
		return '/\s+(' . self::$irragulaRexExp .')\s+(' . PassiveHandler::getWords() . ')/i';
	}
}


Class Passive extends LineCallBack{

	public function pushLine($content, $lineNumber){
		$pattern = PassiveHandler::getRegularExpression();
		preg_match($pattern, $content, $matches);
		if(!empty($matches)){

			$this->output(
				'Found on line ' . $this->colors->getColoredString($lineNumber, 'blue') . ': ' .
				preg_replace($pattern, $this->colors->getColoredString('${0}', 'light_red'), $content)
			);
		}
	}
}

$passive = (new Passive())->setMessenger($messenger);

$messenger->output('Find passive words');
PassiveHandler::appendWordsFromFile('data/locales/en/passive-words.txt');
FileHandler::setCallback($passive);
FileHandler::handle($fileName);
$messenger->output('----');