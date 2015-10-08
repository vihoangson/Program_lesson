<?php
$servers = array(
    array('localhost', 11211, 33),
);
$memcacheD = new Memcached;
$memcacheD->addServers($servers);

$checks = array(
    123,
    4542.32,
    'a string',
    true,
    array(123, 'string'),
    (object)array('key1' => 'value1'),
);
foreach ($checks as $i => $value) {
    print "Checking WRITE with Memcache\n";
    $key = 'cachetest' . $i;
    usleep(100);
    $valD = $memcacheD->get($key);
    if ($val !== $valD) {
        print "Not compatible!";
        var_dump(compact('val', 'valD'));
    }

    print "Checking WRITE with MemcacheD\n";
    $key = 'cachetest' . $i;
    //$memcacheD->set($key, $value);
    usleep(100);
    $valD = $memcacheD->get($key);
    if ($val !== $valD) {
        print "Not compatible!";
        var_dump(compact('val', 'valD'));
    }
}