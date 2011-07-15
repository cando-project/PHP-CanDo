<?php

/**
 * $this->param( 'test', 'html' );
 * $this->params( 'test_([1-9])$', 'html' );
 */
 
class pages extends Controller{
	
	public function home(){
		echo "Home !";
	}
		
	public function test(){
		echo "Test !";
	}
		
	public function not_found(){
		echo "(404) Not Found !";
	}
		
	public function forbidden(){
		echo "(403) Forbidden !";
	}
	
}

?>
