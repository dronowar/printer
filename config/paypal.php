<?php
return array(
    // set your paypal credential
    'client_id' => 'AVC7rxAMnpqzwZKOiOX4b71qy0SHrRNcucVp3zXtdnj-wS8t86RM4d5_j9qv',
    'secret' => 'EPEXEhAM1WumPlf14IkqJ7f352U9jiUm6Ja2gpnAACz3woJutLO_FhNB0Nrp',

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);