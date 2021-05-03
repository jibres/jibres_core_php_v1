<?php

// this directory
$addr = __DIR__;

// get raw addr
$addr = str_replace('dash/engine/cronjob', '', $addr);

// master jibres directory
$jibres_addr = $addr;

// index.php directory
$index_php_addr = $jibres_addr. "public_html/index.php";

// execute list
$exec   = [];
$exec[] = 'php '. $index_php_addr. " php_run_jibres_cronjob $index_php_addr ";
$exec[] = 'php '. $index_php_addr. " php_run_business_cronjob_once $index_php_addr ";
$exec[] = 'php '. $index_php_addr. " php_run_business_cronjob_force $index_php_addr ";

$exec = implode(' & ', $exec);

$exec_addr = __DIR__. '/exec.me.php';

file_put_contents($exec_addr, $exec);

$exec_php = 'cd '. $jibres_addr. 'public_html && sh '. $exec_addr;

$result = shell_exec($exec_php);

file_put_contents(__DIR__. '/resultexect.me.log', $result);

?>