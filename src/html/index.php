<?php

use SourcePot\Http\Response;
use SourcePot\Database;

$db = Database::getInstance();
$stmt = $db->run('SHOW DATABASES');
$databases = json_encode($stmt->fetchAll());
(new Response)->setHeader('content-type', 'application/json')->send($databases);