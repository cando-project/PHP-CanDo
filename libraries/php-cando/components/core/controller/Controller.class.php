<?php

/**
 * Project:     PHP CanDo
 * File:        Controller.class.php
 * 
 * @link: 
 * @copyright: 2011 PHP CanDo
 * @license : MIT http://www.opensource.org/licenses/mit-license.php
 * @author: Jean Luc Ranaivoarivao (jean-luc<at>vectoris<dot>fr)
 * @contributors: Jean Luc Ranaivoarivao
 * @package: PHP CanDo
 * @subpackage:	controller
 * @version: 1.0
 * @creation 2011-07-13
 * @lastmodification 2011-07-15
*/

class Controller {
	
	private $oRequest;
	
	/**
	 * Constructor
	 */
	public function __construct(){
		
	}	
	
	/**
	 * Attach the parameter object
	 */
	public function set_request( $_oRequest ){
		$this->oRequest = $_oRequest;
	}
	
	/**
	 * Function to catch parameters
	 */
	protected function param( $_sKey, $_sOperations ){
		$xValue = $this->oRequest->catch_param( $_sKey, $_sOperations );
		return $xValue;
	} 
		
	/**
	 * Function to catch parameters
	 */
	protected function params( $_sKeyPattern, $_sOperations ){
		$aValues = $this->oRequest->catch_multiple_params( $_sKeyPattern, $_sOperations );
		return $aValues;
	} 
	
	/**
	 * Print error code
	 * @todo: Redirect to Error Handler
	 */
	private function error( $_sCode ){
		die( $_sCode );
	}
}

?>
