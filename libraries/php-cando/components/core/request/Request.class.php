<?php

/**
 * Project:     PHP CanDo
 * File:        Request.class.php
 * 
 * @link: 
 * @copyright: 2011 PHP CanDo
 * @license : MIT http://www.opensource.org/licenses/mit-license.php
 * @author: Jean Luc Ranaivoarivao (jean-luc<at>vectoris<dot>fr)
 * @contributors: Jean Luc Ranaivoarivao
 * @package: PHP CanDo
 * @subpackage:	request
 * @version: 1.0
 * @creation 2011-06-28
 * @lastmodification 2011-07-15
 */

class Request {
	
	private $oRessource;
	
	public $oParameters;
		
	/**
	 * Constructor
	 */
	public function __construct(){		
		$this->oParameters = new Parameters();
	}	
	
	/**
	 * Function which catch route
	 */
	public function get_request(){
		// _get_route must be defined in a child class
		if( method_exists( $this , '_get_request' ) ){
			return $this->_get_request();
		}else{
			// @exception : _get_ressource method is not found in the child class
			self::error( "_get_request.method.not-found" );
			return false;
		}
	}	
	
	/**
	 * Function which catch parameters
	 */
	public function catch_param( $_sKey, $_sMethod ){
		$xValue = NULL;
		// _catch_param must be defined in a child class
		if( method_exists( $this, '_catch_param' ) ){
			$this->oParameters->add_param( $_sKey, $this->_catch_param( $_sKey ) );
			return $this->oParameters->get_param( $_sKey, $_sMethod );
		}else{
			// @exception : _catch_param method is not found in the child class
			self::error( "_catch_param.method.not-found" );
			return false;
		}
	}
		
	/**
	 * Function which catch parameters
	 * Only one hierarchy
	 */
	public function catch_multiple_params( $_sKeyPattern, $_sMethod ){
		$aValues = array();
		// _catch_multiple_params must be defined in a child class
		if( method_exists( $this, '_catch_multiple_params' ) ){
			$aValuesFromFront = $this->_catch_multiple_params( $_sKeyPattern );
			foreach( $aValuesFromFront as $sKey => $xValue ){
				$aMatches = array();
				if( preg_match( '#'.$_sKeyPattern.'#', $sKey, $aMatches ) ){
					if( sizeof( $aMatches ) <= 1 ){
						//No key
						$this->oParameters->add_param( $sKey, $xValue );
						array_push( $aValues, $this->oParameters->get_param( $sKey, $_sMethod ) );
					}else{
						//There's key to make
						$this->oParameters->add_param( $sKey, $xValue );
						$aValues[ $aMatches[ 1 ] ] = $this->oParameters->get_param( $sKey, $_sMethod );
					}
				}
			}
			
			return $aValues;
		}else{
			// @exception : _catch_param method is not found in the child class
			self::error( "_catch_param.method.not-found" );
			return false;
		}
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
