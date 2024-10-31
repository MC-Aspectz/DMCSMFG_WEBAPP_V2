<?php

function lang($msg) {

    $lang = [
	
        'yes' => 'Yes',
        'no' => 'No',

        'question1' => 'Do you want to end this process ?',

        'validation1' => 'All the mandatory fields surrounded in red line need to be completed.',
    ];

    return $lang[$msg];

}

?>