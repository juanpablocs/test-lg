<?php

/**
 * sanitize post request
 * remove html tag
 * clear spaces
 * @param array
 * @return array
 */
function sanitize_request($post) {
    $new_post = [];
    foreach($post as $k => $v) {
        $new_post[$k] = trim(strip_tags($v));
    }
    return $new_post;
}

function password($pass) {
    return password_hash($pass, PASSWORD_BCRYPT);
}