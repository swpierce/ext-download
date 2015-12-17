<?php

return array(
	'routes' => array(
        'download' => array('middleware' => 'auth'),
	),

	'page' => array(
        'download-page' => array( 'basket/mini' ),
        'no-mobile-page' => array( 'basket/mini' ),
	),

	'classes' => array(
        'client' => array(
            'html' => array(
                'checkout' => array(
                    'confirm' => array(
                        'name' => 'Download',
                    ),
                ),
            ),
        ),
	),

    'distros' => array(
        'bucket' => 'S3-BUCKET-NAME',
        'max-downloads' => 3,
        'max-time' => 30,
        'drivename' => 'distros',
    ),

);
