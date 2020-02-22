<?php

namespace lib\nic\Iodev\Whois\Modules\Tld;

use \lib\nic\Iodev\Whois\Response;

/**
 * Immutable data object
 */
class DomainResponse extends Response
{
    /**
     * @param string $domain
     * @param string $query
     * @param string $text
     * @param string $host
     */
    public function __construct($domain, $query = "", $text = "", $host = "")
    {
        parent::__construct($query, $text, $host);
        $this->domain = strval($domain);
    }

    /** @var string */
    private $domain;

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }
}
