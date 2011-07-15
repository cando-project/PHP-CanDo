<?php

/**
 * Project:     PHP CanDo
 * File:        CMDRequest.class.php
 * 
 * @link: 
 * @copyright: 2011 PHP CanDo
 * @license : MIT http://www.opensource.org/licenses/mit-license.php
 * @author: Jean Luc Ranaivoarivao (jean-luc<at>vectoris<dot>fr)
 * @contributors: Jean Luc Ranaivoarivao
 * @package: PHP CanDo
 * @subpackage:	request
 * @version: 1.0
 * @creation 2011-07-15
 * @lastmodification 2011-07-15
 */

class CMDRequest extends Request {
	
	/**
	 * Constructor
	 */
	public function __construct(){
		parent::__construct();
		
	}	
	
	/**
	 * Function wich catch request
	 */
	public function _get_request(){
		// The ressource is in the second parameter, after de entrypoint file
		return $_SERVER[ 'argv' ][ 1 ];
	}
	
	/**
	 * Function which get params 
	 * @todo: FILE !!
	 */
	public function _catch_param( $_sKey ){
		$xValue = NULL;		
		if( $_SERVER[ 'argc' ] > 2 ){
			$iCount = 2;
			while( isset( $_SERVER[ 'argv' ][ $iCount ] )  ){
				if( preg_match( '#^(\-){1,2}'.$_sKey.'#', $_SERVER[ 'argv' ][ $iCount ] ) ){
					$xValue=$_SERVER[ 'argv' ][ $iCount ];
					$xValue = preg_replace( '#^(\-){1,2}'.$_sKey.'#', '', $xValue );
					if( preg_match( '#^=#', $xValue ) ){
						$xValue = preg_replace( '#^=#', '', $xValue );
					}
					if( $xValue == "" && isset( $_SERVER[ 'argv' ][ $iCount + 1 ] ) ){
						$iCount ++;
						$xValue = $_SERVER[ 'argv' ][ $iCount ];
					}
				}
				$iCount ++;
			}			
		}		
		return $xValue;
	}
		
	/**
	 * Function which get multiple params 
	 */
	public function _catch_multiple_params( $_sKeyPattern ){	
		if( preg_match( "#\$$#", $_sKeyPattern ) ){
			$aKeyPattern = str_split($_sKeyPattern );
			array_pop( $aKeyPattern );
			$_sKeyPattern = implode( $aKeyPattern );
		}
		$aValues = NULL;		
		if( $_SERVER[ 'argc' ] > 2 ){
			$iCount = 2;
			while( isset( $_SERVER[ 'argv' ][ $iCount ] )  ){
				if( preg_match( '#^(\-){1,2}('.$_sKeyPattern.')#', $_SERVER[ 'argv' ][ $iCount ], $aMatches ) ){
					$xValue =$_SERVER[ 'argv' ][ $iCount ];
					$xValue = preg_replace( '#^(\-){1,2}'.$_sKeyPattern.'#', '', $xValue );
					if( preg_match( '#^=#', $xValue ) ){
						$xValue = preg_replace( '#^=#', '', $xValue );
					}
					if( $xValue == "" && isset( $_SERVER[ 'argv' ][ $iCount + 1 ] ) ){
						$iCount ++;
						$xValue = $_SERVER[ 'argv' ][ $iCount ];
					}
					$aValues[ $aMatches[ 2 ] ] = $xValue;
				}
				$iCount ++;
			}			
		}		
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

Application::add_request_type( 'cmd', 'CMDRequest' );

?>
