<?php

/**
 * Project:     PHP CanDo
 * File:        PHPCanDo.class.php
 * 
 * @link: 
 * @copyright: 2011 PHP CanDo
 * @license : MIT http://www.opensource.org/licenses/mit-license.php
 * @author: Jean Luc Ranaivoarivao (jean-luc<at>vectoris<dot>fr)
 * @contributors: Jean Luc Ranaivoarivao
 * @package: PHP CanDo
 * @subpackage:	
 * @version: 1.0
 * @creation 2011-06-27
 * @lastmodification 2011-07-14
 */

class PHPCanDo {
	
	const LIB_PATH = PCD_LIB_PATH;
	const RESS_MAP = 'mod/class/method';
	
	const PRESS_DEFAULT='default';
	const PRESS_NOTFOUND='not-found';
	const PRESS_FORBIDDEN='forbidden';
	
	/**
	 * Constructor
	 */
	public function __construct(){
		$this->set_global();
		$this->includes();
		$this->configure();
	}
	
	/**
	 * Includes
	 */
	private function includes(){
		include self::LIB_PATH.'components/core/application/Application.class.php';
		include self::LIB_PATH.'components/core/request/Request.class.php';
		include self::LIB_PATH.'components/core/request/Routes.class.php';
		include self::LIB_PATH.'components/core/ressource/Ressource.class.php';
		include PCD_LIB_PATH.'components/core/ressource/PathFinder.class.php';
		include PCD_LIB_PATH.'components/core/parameters/Parameters.class.php';
		include PCD_LIB_PATH.'components/core/tools/Tools.class.php';
		include PCD_LIB_PATH.'components/core/controller/Controller.class.php';
		include PCD_LIB_PATH.'components/core/configurations/AppConfigurations.class.php';
	}
	
	/**
	 * Setting global variables
	 */
	private function set_global(){
		global $gPHPCanDo;
		$gPHPCanDo = new stdclass;
	}
	
	/**
	 * Configuration
	 */
	private function configure(){
		global $gPHPCanDo;
		$gPHPCanDo->oConf->sRessMap = self::RESS_MAP;
		$gPHPCanDo->oConf->aListRequestType = array();		
		$gPHPCanDo->oConf->sPRessourceDefault = self::PRESS_DEFAULT;
		$gPHPCanDo->oConf->sPRessourceNotFound = self::PRESS_NOTFOUND;
		$gPHPCanDo->oConf->sPRessourceForbidden = self::PRESS_FORBIDDEN;		
	}
	
	/**
	 * Function for creating an Application
	 */
	public function create( $_sAppName, $_sPathToConfig ){
		$this->$_sAppName = new Application( $_sAppName, $_sPathToConfig );
	}
	
}

?>
