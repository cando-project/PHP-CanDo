<?php

/**
 * Project:     PHP CanDo
 * File:        AppConfigurations.class.php
 * 
 * @link: 
 * @copyright: 2011 PHP CanDo
 * @license : MIT http://www.opensource.org/licenses/mit-license.php
 * @author: Jean Luc Ranaivoarivao (jean-luc<at>vectoris<dot>fr)
 * @contributors: Jean Luc Ranaivoarivao
 * @package: PHP CanDo
 * @subpackage:	configurations
 * @version: 1.0
 * @creation 2011-07-14
 * @lastmodification 2011-07-15
 */

class AppConfigurations {
	
	/**
	 * Constructor
	 */
	public function __construct( $_sPathToConfigs ){
		global $gCurrentApp;
		$gCurrentApp->oConf->aListRequestType = array();
		$gCurrentApp->oConf->aListParameterType = array();
		$gCurrentApp->oConf->aListPredefinedRessources = array();	
		$gCurrentApp->oConf->aListRoutes = array();
		$gCurrentApp->oConf->aListModule = array();	
	}
	
	/**
	 * Set configurations
	 */
	public function set(){		
		global $gCurrentApp;
		global $gPHPCanDo;
		$gCurrentApp->oConf->aListPredefinedRessources[ $gPHPCanDo->oConf->sPRessourceDefault ] = 'commun/pages/home';
		$gCurrentApp->oConf->aListPredefinedRessources[ $gPHPCanDo->oConf->sPRessourceNotFound ] = 'commun/pages/not_found';
		$gCurrentApp->oConf->aListPredefinedRessources[ $gPHPCanDo->oConf->sPRessourceForbidden ] = 'commun/pages/forbidden';
		//
		$gCurrentApp->oConf->aListModules[ 'commun' ] = '/home/trambo/Projets/CanDo Project/PHP-CanDo/applications/sample-fosite-application/modules/commun';
		//
		$gCurrentApp->oConf->aListRoutes[ "home.html" ] = 'commun/pages/home';
		$gCurrentApp->oConf->aListRoutes[ "test.html" ] = 'commun/pages/test';
	}
	
}

?>
