<?php

/**
 * Project:     PHP CanDo
 * File:        Application.class.php
 * 
 * @link: 
 * @copyright: 2011 PHP CanDo
 * @license : MIT http://www.opensource.org/licenses/mit-license.php
 * @author: Jean Luc Ranaivoarivao (jean-luc<at>vectoris<dot>fr)
 * @contributors: Jean Luc Ranaivoarivao
 * @package: PHP CanDo
 * @subpackage:	application
 * @version: 1.0
 * @creation 2011-06-27
 * @lastmodification 2011-07-15
 */

class Application {
	
	private $oCurrentRequest;
	private $oCurrentCtrl;
	private $oConfiguration;
	private $oRoutes;
	private $oRessource;
	private $sAppName;
	private $bRouteActive = true;
	
	/**
	 * Constructor
	 */
	public function __construct( $_sAppName, $_sPathToConfig ){
		$this->sAppName = $_sAppName;
				
		global $gCurrentApp;
		$gCurrentApp = new stdclass;
		$this->oConfiguration = new AppConfigurations( $_sPathToConfig );
		$this->oConfiguration->set();
		
		$this->includes();		
		
		$this->oRessource = new Ressource;
	}
	
	/**
	 * Function wich include PHP required files
	 */
	private function includes(){		
		include PCD_LIB_PATH.'components/core/request/WebRequest.class.php';
		include PCD_LIB_PATH.'components/core/request/CMDRequest.class.php';
		include PCD_LIB_PATH.'components/core/parameters/StringParameter.class.php';
		include PCD_LIB_PATH.'components/core/parameters/HTMLParameter.class.php';
	}
	
	/**
	 * Function wich receive calls
	 */
	public function launch( $_sCallType ){
		global $gCurrentApp;
		global $gPHPCanDo;
		foreach( $gCurrentApp->oConf->aListRequestType as $sKey => $xValue ){
			if( $xValue[1] == $_sCallType ){
				// Launch the class wich correspond the call type
				$this->oCurrentRequest = new $xValue[0];
			}
		}
		if( isset( $this->oCurrentRequest ) ){
			$sRequest = $this->oCurrentRequest->get_request();
			if( !isset( $sRequest ) || $sRequest == "" ){
				$this->exec_predefined_ressource( $gPHPCanDo->oConf->sPRessourceDefault );
				return false;
			}elseif( $this->bRouteActive ){
				$oRoutes = new Routes;
				if( $oRoutes->check_request( $sRequest ) ){
					$sRequest = $oRoutes->check_request( $sRequest );
				}
			}
			
			$oRessource = $this->oRessource->parse( $sRequest, 'main-controller' );
			if( $oRessource->sRealPath != NULL ){
				require_once $oRessource->sRealPath;
				$this->oCurrentCtrl = new $oRessource->sClass;
				$this->oCurrentCtrl->set_request( $this->oCurrentRequest );
				if( method_exists( $this->oCurrentCtrl, $oRessource->sMethod ) ){
					$sAction = $oRessource->sMethod;
					$this->oCurrentCtrl->$sAction();
				}else{
					$this->exec_predefined_ressource( $gPHPCanDo->oConf->sPRessourceNotFound );
				}
			}else{
				$this->exec_predefined_ressource( $gPHPCanDo->oConf->sPRessourceNotFound );
			}

		}else{
			self::error( "unknown.calltype" );
		}
	}
	
	private function exec_predefined_ressource( $_sPredefinedRessource ){
		global $gCurrentApp;
		global $gPHPCanDo;
		$sRequest = $gCurrentApp->oConf->aListPredefinedRessources[ $_sPredefinedRessource ];
		$oRessource = $this->oRessource->parse( $sRequest, 'main-controller' );
		if( $oRessource->sRealPath != NULL ){
			require_once $oRessource->sRealPath;
			$this->oCurrentCtrl = new $oRessource->sClass;			
			$this->oCurrentCtrl->set_request( $this->oCurrentRequest );
			if( method_exists( $this->oCurrentCtrl, $oRessource->sMethod ) ){
				$sAction = $oRessource->sMethod;
				$this->oCurrentCtrl->$sAction();
			}else{
				self::error( "predefined-access.not-found" );
			}
		}else{
			self::error( "predefined-access.not-found" );
		}
	}
	
	/**
	 * Static function wich add request type
	 */
	static function add_request_type( $_sClass, $_sCode ){
		global $gCurrentApp;
		array_push( $gCurrentApp->oConf->aListRequestType, array( $_sCode, $_sClass ) );
	}
	
	
	/**
	 * Static function wich add request type
	 */
	static function add_parameter_type( $_sClass, $_sCode ){
		global $gCurrentApp;
		array_push( $gCurrentApp->oConf->aListParameterType, array( $_sCode, $_sClass ) );
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
