<?php

use \Model\User;

require dirname(__FILE__) . '/autoload.php';

$user = new User();
$create = $user->create('Juan Pablo', password('123456'));
var_dump($create);