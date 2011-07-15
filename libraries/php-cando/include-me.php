<?php

/**
 * Project:     PHP CanDo
 * File:        include-me.php
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
 * @lastmodification 2011-06-27
 */

include 'components/core/phpcando/PHPCanDo.class.php';
define ( 'PCD_LIB_PATH' , dirname (__FILE__).DIRECTORY_SEPARATOR);

/** 
 * Instanciation are here because it must be called once and no more
 * Don't worry, you can add many apps as you like with only one instance of oPHPCanDo
 */
$oPHPCanDo = new PHPCanDo();

?>
