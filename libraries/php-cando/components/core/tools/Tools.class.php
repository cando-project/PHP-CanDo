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
 * @lastmodification 2011-07-12
 */

class Tools {
		
	static function generate_random_string( $_iLength ) {
		$sToPickUp = '0123456789abcdefghijklmnopqrstuvwxyz';
		$sToReturn = '';    

		for ($iParcours = 0; $iParcours < $_iLength; $iParcours++) {
			$sToReturn .= $sToPickUp[mt_rand(0, strlen($sToPickUp))];
		}

		return $sToReturn;
	}

}
