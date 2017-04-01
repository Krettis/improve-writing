<?php

include 'startup.php';

class DuplicateFinder {
	private static $lastWords = array();
	private static $listDuplicates = array();
	
	public static function check(array $words){
		$found = [];
		foreach ($words as $key => $value) {
			if(in_array($value, self::$lastWords)){
				$found[] = $value;
			}
			
			array_push(self::$lastWords, $value);
			if(count(self::$lastWords) > 2){
				array_shift(self::$lastWords);
			}
		}
		
		return $found;
	}

	public static function list($lineNumber, array $set){
		self::$listDuplicates[$lineNumber] = $set;
	}

	public static function getList(){
		return self::$listDuplicates;
	}
}


Class Duplicates extends LineCallBack{

	public function pushLine($content, $lineNumber){
		if(empty($content)) return false;
	    $words = explode(' ', $content);
	    if(!empty($words)){
	    	$result = DuplicateFinder::check($words, $lineNumber);
	    	if(!empty($result)){
	    		$lineColored = preg_replace('/' . implode('|', $result) . '/', $this->colors->getColoredString('${0}', 'light_red'), substr($content, 0, -1));
	    		$this->output(
					'Found on line ' . $this->colors->getColoredString($lineNumber, 'blue') . ': ' .
	    			$lineColored);	
	    	}
	    }
	}
}

$duplicates = (new Duplicates())->setMessenger($messenger);

$messenger->output('Duplicate finder');
FileHandler::setCallback($duplicates);
FileHandler::handle($fileName);
$messenger->output('----');