<?php

use \Model\User;

require dirname(__FILE__) . '/autoload.php';

$user = new User();
$create = $user->create('Juan Pablo', password('Juanpa123@'));
var_dump($create);