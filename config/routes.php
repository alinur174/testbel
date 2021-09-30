<?php

return array(
    '' => 'site/index',
    'index.php' => 'site/index', // actionIndex в SiteController
    'create' => 'site/CreateNumber',
    'site/update/([0-9]+)' => 'site/updateNumber/$1',
    'site/delete/([0-9]+)' => 'site/deleteNumber/$1',
    'site/search' => 'site/SearchName'
);
