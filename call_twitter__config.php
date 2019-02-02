<?php
/**
 * 'Get twitter's RSS feed from queryfeed.net' config
 */

/**
 * cache:storage
 */
define("TEMP_FOLDER",'./temp/');
/**
 * cache:effective time
 */
define("EFFECTIVE_TIME",3600);
/**
 * User Agent
 */
$AGENT = stream_context_create(
    array(
        'http'=>array(
            'user_agent'=>'//github.com/hiroshikuze/anichecker_call_twitter/'
        )
    )
);
