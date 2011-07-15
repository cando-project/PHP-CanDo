<?php

/**
 * Project:     PHP CanDo
 * File:        Routes.class.php
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

class Routes {
	
	private $aListRoutes;
	
	/**
	 * Constructor
	 */
	public function __construct(){
		global $gCurrentApp;
		$this->aListRoutes = $gCurrentApp->oConf->aListRoutes;
	}
	
	/**
	 * Check if the given string corresponds 
	 */
	public function check_request( $_sRequest ){
		if( isset( $this->aListRoutes[ $_sRequest ] ) ){
			return $this->aListRoutes[ $_sRequest ];
		}else{
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
