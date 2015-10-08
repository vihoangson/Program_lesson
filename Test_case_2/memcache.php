<?php
$servers = array(
    array('localhost', 11211, 33),
);
$memcached = new Memcached;
$memcached->addServers($servers);
//$memcached->set("son","deptrai");
echo $memcached->get("son");

