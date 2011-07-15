<?php

// 1. Include include-me.php file, on PHPCando root directory path
include '../libraries/php-cando/include-me.php';

// 2. A $oPHPCanDo onbect was created, now create the application
$oPHPCanDo->create( 'sampleFOSite', 'directory/to/config' );

// 4. Launch the application
$oPHPCanDo->sampleFOSite->launch( 'cmd' );

?>
