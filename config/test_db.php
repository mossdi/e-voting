<?php

$db = require __DIR__ . '/db.php';

// test database! Important not to run tests on production or development databases
$db['dsn'] = 'mysql:host=192.168.83.134;dbname=testDB';

return $db;
