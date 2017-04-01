<?php
include 'startup.php';


Class WeaselHandler {
  private static $words = [];
  
  private static function appendWords(array $words){
    self::$words = array_merge(self::$words, $words);
  }

  public static function appendWordsFromFile($fileName){
    $lines = file($fileName);
    $words = array_filter(
          array_map(
            function($var){return $var;}, 
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
    return '/\s+(' . self::getWords() . ')\s+/i';
  }
}


Class Weasel extends LineCallBack{

	public function pushLine($content, $lineNumber){
		$pattern = WeaselHandler::getRegularExpression();
		preg_match($pattern, $content, $matches);
		if(!empty($matches)){

			$this->output(
				'Found on line ' . $this->colors->getColoredString($lineNumber, 'blue') . ': ' .
				preg_replace($pattern, $this->colors->getColoredString('${0}', 'light_red'), $content)
			);
		}
	}
}

$passive = (new Weasel())->setMessenger($messenger);

$messenger->output('Find weasel words');
WeaselHandler::appendWordsFromFile('data/locales/en/weasel-words.txt');
FileHandler::setCallback($passive);
FileHandler::handle($fileName);
$messenger->output('----');