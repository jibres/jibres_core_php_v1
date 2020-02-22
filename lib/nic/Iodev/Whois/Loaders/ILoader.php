<?php

namespace lib\nic\Iodev\Whois\Loaders;

use \lib\nic\Iodev\Whois\Exceptions\ConnectionException;
use \lib\nic\Iodev\Whois\Exceptions\WhoisException;

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