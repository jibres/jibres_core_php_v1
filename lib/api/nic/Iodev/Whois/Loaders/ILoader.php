<?php

namespace lib\api\nic\Iodev\Whois\Loaders;

use \lib\api\nic\Iodev\Whois\Exceptions\ConnectionException;
use \lib\api\nic\Iodev\Whois\Exceptions\WhoisException;

interface ILoader
{
    /**
     * @param string $whoisHost
     * @param string $query
     * @return string
     * @throws ConnectionException
     * @throws WhoisException
     */
    function loadText($whoisHost, $query);
}