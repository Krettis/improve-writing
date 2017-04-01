<?php

Class FileHandler {

	private static $callback = null;

	public static function setCallback(LineCallBack $callback){
		self::$callback = $callback;
	}

	public static function handle($fileName){

		if(!file_exists($fileName)){
			throw new Exception('File does not exist');
		}

		$handle = fopen($fileName, "r");
		if ($handle) {
			$lineNumber = 0;
		    while (($line = fgets($handle)) !== false) {
		        // process the line read.
		    	$lineNumber++;
		        $trimmedLine = preg_replace(
							'/\s+/', ' ', trim($line)
							);
		        self::$callback->pushLine($trimmedLine, $lineNumber);
		    }

	    	fclose($handle);
		} else {
		    // error opening the file.
		    throw new Exception('Could not handle opening file');
		}
	}
}

interface LineInterface {
	public function pushLine($content, $lineNumber);
}

abstract Class LineCallBack implements LineInterface{

	private $messenger = null;

	protected $colors;

	public function __construct(){
		$this->colors = new Colors();
	}

	public final function setMessenger(Messaging $messenger){
		$this->messenger = $messenger;

		return $this;
	}

	public function pushLine($content, $lineNumber){
		$this->output($lineNumber);
	}

	protected final function output($m){
		$this->messenger->output($m);
	}
}