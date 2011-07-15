<?php

/**
 * Project:     PHP CanDo
 * File:        Parameters.class.php
 * 
 * @link: 
 * @copyright: 2011 PHP CanDo
 * @license : MIT http://www.opensource.org/licenses/mit-license.php
 * @author: Jean Luc Ranaivoarivao (jean-luc<at>vectoris<dot>fr)
 * @contributors: Jean Luc Ranaivoarivao
 * @package: PHP CanDo
 * @subpackage:	parameters
 * @version: 1.0
 * @creation 2011-07-05
 * @lastmodification 2011-07-07
*/

class Parameters {
	
	private $oParamsStack;
	
	/**
	 * Constructor
	 */
	public function __construct(){
		$this->oParamsStack = array();
	}	
	
	/**
	 * Function for adding parameters
	 */
	public function add_param( $_sKey, $_xValue ){
		if( !isset( $this->oParamsStack[ $_sKey ] ) ){
			$this->oParamsStack[ $_sKey ] = $_xValue;
		}else{
			self::error( "overwriting.existing-key" );
		}
	}
	
	/**
	 * Function witch get the value of a given parameter key
	 * Type : "integer", "string", "float", ""
	 * @todo: Secure this function and consider the type
	 */
	public function get_param( $_sKey, $_sMethod ){
		if( isset( $this->oParamsStack[ $_sKey ] ) ){
			global $gCurrentApp;
			
			$aMethods = preg_split( '#\|#', $_sMethod );
			
			foreach ( $aMethods as $sKeyMethods => $xValueMethods ){
				foreach( $gCurrentApp->oConf->aListParameterType as $sKey => $xValue ){
					if( $xValue[1] == $xValueMethods ){
						$this->oTypeParam = new $xValue[0]( $this->oParamsStack[ $_sKey ] );
					}
				}
			}
			
			if( !isset( $this->oTypeParam ) ){
				self::error( "unknown.param-type" );
			}else{
				$aMethodsList = get_class_methods( $this->oTypeParam );
				foreach( $aMethodsList as $sKey => $xValue ){
					if( $xValue != "__construct" && $xValue != "_return" ){
						$this->oTypeParam->$xValue();
					}
				}
				if( method_exists( $this->oTypeParam , '_return' ) ){
					return $this->oTypeParam->_return();
				}else{
					self::error( "_return.method.not-found" );
				}
			}
		}else{
			self::error( "given-key.not-found" );
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
