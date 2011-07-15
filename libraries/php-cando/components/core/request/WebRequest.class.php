<?php

/**
 * Project:     PHP CanDo
 * File:        WebRequest.class.php
 * 
 * @link: 
 * @copyright: 2011 PHP CanDo
 * @license : MIT http://www.opensource.org/licenses/mit-license.php
 * @author: Jean Luc Ranaivoarivao (jean-luc<at>vectoris<dot>fr)
 * @contributors: Jean Luc Ranaivoarivao
 * @package: PHP CanDo
 * @subpackage:	request
 * @version: 1.0
 * @creation 2011-06-27
 * @lastmodification 2011-07-13
 */

class WebRequest extends Request {
	
	private $sRequestUri;
	private $sBasePath = '/';
	private $sEntryPoint = 'index.php';
	
	/**
	 * Constructor
	 */
	public function __construct(){
		parent::__construct();
		// Specific configuration to web call type
		$this->sRequestUri = $_SERVER['REQUEST_URI'];
		$this->sBasePath = '/';
		$this->sEntryPoint = 'index.php';		
	}	
	
	/**
	 * Function wich catch route
	 */
	public function _get_request(){		
		return $this->process_url();
	}
	
	/**
	 * Function which get params REQUEST, FILE 
	 * @todo: FILE !!
	 */
	public function _catch_param( $_sKey ){
		$xValue = NULL;
		
		if( isset( $_REQUEST[ $_sKey ] ) ){
			$xValue = $_REQUEST[ $_sKey ];
		}else{
			// @exception : The given Key is not found
			self::error( "key.not-found" );
		}
		
		return $xValue;
	}
		
	/**
	 * Function which get params REQUEST, FILE 
	 * @todo: Thinking about how to receive imbricated variables with () preg matches 
	 */
	public function _catch_multiple_params( $_sKeyPattern ){
		//Let this single line here if you don't want to provide this method
		//self::error( "method.unavailable" );
		$aValues = array();
		
		foreach( $_REQUEST as $sKey => $xValue ){
			if( preg_match( '#'.$_sKeyPattern.'#', $sKey ) ){
				$aValues[ $sKey ] = $xValue;
			}
		}
		
		return $aValues;
	}
	
	/**
	 * Private function wich catch needed string in the URL
	 */
	private function process_url(){
		// We don't need the part of the URI after the "?"
		$aRequestUri = preg_split('#\?#', $this->sRequestUri, 2);
		$sRequestUri = $aRequestUri[0];
		
		// Prevent multiple slashes in the URI
		$sRequestUri = implode( '/', preg_split('#(/)+#', $sRequestUri) );
		
		if( !preg_match( '#^'.$this->sBasePath.$this->sEntryPoint.'/'.'#', $sRequestUri ) &&
			!preg_match( '#^'.$this->sBasePath.'#', $sRequestUri ) ){
			// @exception : Verify basepath in $_sBasePath
			self::error( "basepath.incorrect" );
		}
		
		$aSplitedUri = preg_split( '#^'.$this->sBasePath.'('.$this->sEntryPoint.'/){0,1}#', $sRequestUri );
		
		return $aSplitedUri[ 1 ];
	}
	
	/**
	 * Print error code
	 * @todo: Redirect to Error Handler
	 */
	private function error( $_sCode ){
		die( $_sCode );
	}
	
}

Application::add_request_type( 'web', 'webRequest' );

?>
