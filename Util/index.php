<?php

/**
 * sanitize post request
 * remove html tag
 * clear spaces
 * @param $post array
 * @return array
 */
function sanitize_request($post) {
    $new_post = [];
    foreach($post as $k => $v) {
        $new_post[$k] = trim(strip_tags($v));
    }
    return $new_post;
}

/**
 * Encrypt password function
 * @param $pass string
 * @return string
 */
function password($pass) {
    return password_hash($pass, PASSWORD_BCRYPT);
}

/**
 * Count errors array
 * @param $errors array
 * @return int
 */
function countErrors($errors) {
    $success = 0;
    foreach($errors as $err) {
        $success+= count($err);
    }
    return $success;
}