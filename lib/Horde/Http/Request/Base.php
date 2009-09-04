<?php
/**
 * Copyright 2007-2009 The Horde Project (http://www.horde.org/)
 *
 * @author   Chuck Hagenbuch <chuck@horde.org>
 * @license  http://opensource.org/licenses/bsd-license.php BSD
 * @category Horde
 * @package  Horde_Http
 */

/**
 * @author   Chuck Hagenbuch <chuck@horde.org>
 * @license  http://opensource.org/licenses/bsd-license.php BSD
 * @category Horde
 * @package  Horde_Http
 */
abstract class Horde_Http_Request_Base
{
    /**
     * URI
     * @var string
     */
    protected $_uri;

    /**
     * Request method
     * @var string
     */
    protected $_method = 'GET';

    /**
     * Request headers
     * @var array
     */
    protected $_headers = array();

    /**
     * Request data. Can be an array of form data that will be encoded
     * automatically, or a raw string
     * @var mixed
     */
    protected $_data;

    /**
     * Proxy server
     * @var string
     */
    protected $_proxyServer = null;

    /**
     * Proxy username
     * @var string
     */
    protected $_proxyUser = null;

    /**
     * Proxy password
     * @var string
     */
    protected $_proxyPass = null;

    /**
     * HTTP timeout
     * @var float
     */
    protected $_timeout = 5;

    /**
     * Constructor
     */
    public function __construct($args = array())
    {
        foreach ($args as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Get an adapter parameter
     *
     * @param string $name  The parameter to get.
     * @return mixed        Parameter value.
     */
    public function __get($name)
    {
        return isset($this->{'_' . $name}) ? $this->{'_' . $name} : null;
    }

    /**
     * Set a request parameter
     *
     * @param string $name   The parameter to set.
     * @param mixed  $value  Parameter value.
     */
    public function __set($name, $value)
    {
        switch ($name) {
        case 'headers':
            $this->setHeaders($value);
            break;
        }

        $this->{'_' . $name} = $value;
    }

    /**
     * Set one or more headers
     *
     * @param mixed $headers A hash of header + value pairs, or a single header name
     * @param string $value  A header value
     */
    public function setHeaders($headers, $value = null)
    {
        if (!is_array($headers)) {
            $headers = array($headers => $value);
        }

        foreach ($headers as $header => $value) {
            $this->_headers[$header] = $value;
        }
    }

    /**
     * Get the current value of $header
     *
     * @param string $header Header name to get
     * @return string $header's current value
     */
    public function getHeader($header)
    {
        return isset($this->_headers[$header]) ? $this->_headers[$header] : null;
    }
}
