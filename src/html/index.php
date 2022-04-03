<?php

use SourcePot\Http\Response;
use SourcePot\Database\Database;

$query = 'SHOW DATABASES';
$db = Database::getInstance();
(new Response)
    ->setHeader('content-type', 'application/json')
    ->send(json_encode($db->run($query)->fetchAll()));