<?php

    function lang($msg) {

        $lang = [
            "clear" => "Clear",
            "close" => "Close",
            "yes" => "Yes",
            "no" => "No",
            "ok" => "Ok",
            "nono" => "No",
            "canceled" => "Canceled.",

            "question1" => "Do you want to end this process ?",
            "question2" => "Do you want to save Recurring Pattern data ?",
            "question3" => "Are you sure you want to delete this data ?",


            "validation1" => "All the mandatory fields surrounded in red line need to be completed.",

            "success" => "Entry into the system. General ledger already.",

        ];

        return $lang[$msg];

    }
?>