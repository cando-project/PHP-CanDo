<?php

/**
 * Project:     PHP CanDo
 * File:        HTMLParameter.class.php
 * 
 * @link: 
 * @copyright: 2011 PHP CanDo
 * @license : MIT http://www.opensource.org/licenses/mit-license.php
 * @author: Jean Luc Ranaivoarivao (jean-luc<at>vectoris<dot>fr)
 * @contributors: Jean Luc Ranaivoarivao
 * @package: PHP CanDo
 * @subpackage:	parameters
 * @version: 1.0
 * @creation 2011-07-12
 * @lastmodification 2011-07-12
*/

class HTMLParameter {
	
	private $xParam;
	
	/**
	 * Constructor
	 */
	public function __construct( $_xParam ){
		$this->xParam = $_xParam;
	}	
	
	/**
	 * Fix for XSS exploits
	 */
	public function fix_xss(){
		$this->xParam = htmlspecialchars( trim( $this->xParam ) );
	}
	
	/**
	 * Magick quotes
	 */
	public function magic_quotes(){
		if( get_magic_quotes_gpc() ){
			$this->xParam = stripslashes( $this->xParam );
		}
	}
	
	/**
	 * Return
	 */
	public function _return(){
		return $this->xParam;
	}	
	
	/**
	 * Print error code
	 * @todo: Redirect to Error Handler
	 */
	private function error( $_sCode ){
		die( $_sCode );
	}
}

Application::add_parameter_type( 'html', 'HTMLParameter' );

?>
