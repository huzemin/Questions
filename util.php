<?php
/**
 * @author huzemin8@126.com
 */
 
 function get_week_monday($unix_time = false) {
    $week = date('w');
    $time = strtotime("- $week days");
    if($unix_time) {
        return $time;
    } else {
        return date('Y-m-d H:i:s', strtotime("- ".date('w')." days"));
    }
}

function parse_url_query($query) {
    $query = preg_replace('#^[\?|&]#', '', $query);
    $queries = explode('&', $query);
    $params = array();
    foreach($queries as $q) {
        $q = explode('=', $q);
        $params[urldecode($q[0])] = urldecode($q[1]);
    }
    return $params;
}
