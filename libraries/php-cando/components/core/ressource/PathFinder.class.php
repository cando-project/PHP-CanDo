<?php

/**
 * Project:     PHP CanDo
 * File:        PathFinder.class.php
 * 
 * @link: 
 * @copyright: 2011 PHP CanDo
 * @license : MIT http://www.opensource.org/licenses/mit-license.php
 * @author: Jean Luc Ranaivoarivao (jean-luc<at>vectoris<dot>fr)
 * @contributors: Jean Luc Ranaivoarivao
 * @package: PHP CanDo
 * @subpackage:	ressource
 * @version: 1.0
 * @creation 2011-07-13
 * @lastmodification 2011-07-14
 */

class PathFinder {
	
	const DIR_SEP = DIRECTORY_SEPARATOR;
	const MAINCTRL_PATH = 'controllers';
	const MAINCTRL_EXT = '.main.php';
	
	private $aModulesList=array();
		
	/**
	 * Constructor
	 */
	public function __construct(){
		global $gCurrentApp;
		$this->aModulesList = $gCurrentApp->oConf->aListModules;
		$this->configure();
	}
	
	/**
	 * Set configurations
	 */
	private function configure(){
		
	}
	
	/**
	 * The convertor
	 * @todo: Add for Over Ressources type
	 */
	public function convert_to_real_path( $_sModule, $_sClass, $_sMethod, $_sType ){
		if( !isset( $this->aModulesList[ $_sModule ] ) ){
			return NULL;
		}else{
			$sPath = $this->aModulesList[ $_sModule ].self::DIR_SEP;
			switch( $_sType ){
				case 'main-controller':
					$sPath .= self::MAINCTRL_PATH.self::DIR_SEP.$_sClass.self::MAINCTRL_EXT;
				break;
				default:
					self::error( "uknown.ressource-type" );
				break;
			}
			if( !file_exists( $sPath ) ){
				return NULL;
			}
		}
		
		return $sPath;
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
