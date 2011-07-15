<?php

/**
 * Project:     PHP CanDo
 * File:        Ressource.class.php
 * 
 * @link: 
 * @copyright: 2011 PHP CanDo
 * @license : MIT http://www.opensource.org/licenses/mit-license.php
 * @author: Jean Luc Ranaivoarivao (jean-luc<at>vectoris<dot>fr)
 * @contributors: Jean Luc Ranaivoarivao
 * @package: PHP CanDo
 * @subpackage:	ressource
 * @version: 1.0
 * @creation 2011-06-29
 * @lastmodification 2011-06-29
 */

class Ressource {
	
	public $oPathFinder;
	
	/**
	 * Constructor
	 */
	public function __construct(){
		$this->oPathFinder = new PathFinder();
	}
	
	/**
	 * Parse ressource function
	 */
	public function parse( $_sRessource, $_sType ){
		// Recuperation of the map
		global $gPHPCanDo;
		$sRessourceMap = $gPHPCanDo->oConf->sRessMap;
		
		$aSplitedAccess = preg_split( '#/#', $_sRessource );
		$aAccessPattern = preg_split( '#/#', $sRessourceMap );
		
		$oToReturn = new stdclass;
		
		$iCount = 0;
		foreach ( $aAccessPattern as $sKey => $xValue ) {
			if( isset( $aSplitedAccess[ $iCount ] ) ){
				if( $aAccessPattern[ $sKey ] == 'mod' ){
					$oToReturn->sModule = $aSplitedAccess[ $iCount ];
				}
				if( $aAccessPattern[ $sKey ] == 'class' ){
					$oToReturn->sClass = $aSplitedAccess[ $iCount ];
				}
				if( $aAccessPattern[ $sKey ] == 'method' ){
					$oToReturn->sMethod = $aSplitedAccess[ $iCount ];
				}
			}else{
				if( $aAccessPattern[ $sKey ] == 'mod' ){
					$oToReturn->sModule = NULL;
				}
				if( $aAccessPattern[ $sKey ] == 'class' ){
					$oToReturn->sClass = NULL;
				}
				if( $aAccessPattern[ $sKey ] == 'method' ){
					$oToReturn->sMethod = NULL;
				}
			}
			$iCount ++;
		}
		
		$oToReturn->sRealPath = $this->oPathFinder->convert_to_real_path( $oToReturn->sModule, $oToReturn->sClass, $oToReturn->sMethod, $_sType );
		
		return $oToReturn;
	}
	
}

?>
