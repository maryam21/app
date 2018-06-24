<?php

/*----------------------------------------------------*/
// Define environment type
/*----------------------------------------------------*/
return [
    'local' => getenv('HOSTNAME'),
    'production' => 'INSERT-HOSTNAME'
];
