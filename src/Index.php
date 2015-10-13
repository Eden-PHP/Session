<?php //-->
/**
 * This file is part of the Eden PHP Library.
 * (c) 2014-2016 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Eden\Session;

/**
 * General available methods for common session procedures.
 *
 * @package  Eden
 * @category Session
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class Index extends Base implements \ArrayAccess, \Iterator
{
    /**
     * @const string ERROR_NOT_STARTED Error template
     */
    const ERROR_NOT_STARTED = 'Session is not started. Try using Eden\Session->start() first.';

    /**
     * @const int INSTANCE Flag that designates singleton when using ::i()
     */
    const INSTANCE = 1;

    /**
     * @var bool $session Flag that designates if the session is started
     */
    protected static $session = false;

    /**
     * if object to string, give out the json
     *
     * @return string
     */
    public function __toString()
    {
        if (!self::$session) {
            return '{}';
        }

        return json_encode($_SESSION);
    }

    /**
     * Removes all session data
     *
     * @return Eden\Session\Index
     */
    public function clear()
    {
        if (!self::$session) {
            Exception::i()->setMessage(self::ERROR_NOT_STARTED)->trigger();
        }

        $_SESSION = array();

        return $this;
    }

    /**
     * Returns the current item
     * For Iterator interface
     *
     * @return scalar
     */
    public function current()
    {
        if (!self::$session) {
            Exception::i()->setMessage(self::ERROR_NOT_STARTED)->trigger();
        }

        return current($_SESSION);
    }

    /**
     * Returns data
     *
     * @param string|null $key The key from the session
     *
     * @return scalar|null|array
     */
    public function get($key = null)
    {
        //argument 1 must be a string or null
        Argument::i()->test(1, 'string', 'null');

        if (!self::$session) {
            Exception::i()->setMessage(self::ERROR_NOT_STARTED)->trigger();
        }

        if (is_null($key)) {
            return $_SESSION;
        }

        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return null;
    }

    /**
     * Returns session id
     *
     * @return int
     */
    public function getId()
    {
        if (!self::$session) {
            Exception::i()->setMessage(self::ERROR_NOT_STARTED)->trigger();
        }

        return session_id();
    }

    /**
     * Returns th current position
     * For Iterator interface
     *
     * @return int
     */
    public function key()
    {
        if (!self::$session) {
            Exception::i()->setMessage(self::ERROR_NOT_STARTED)->trigger();
        }

        return key($_SESSION);
    }

    /**
     * Increases the position
     * For Iterator interface
     *
     * @return void
     */
    public function next()
    {
        if (!self::$session) {
            Exception::i()->setMessage(self::ERROR_NOT_STARTED)->trigger();
        }

        next($_SESSION);
    }

    /**
     * isset using the ArrayAccess interface
     *
     * @param *scalar|null|bool $offset The key to test if exists
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        //argument 1 must be scalar, null or bool
        Argument::i()->test(1, 'scalar', 'null', 'bool');

        if (!self::$session) {
            Exception::i()->setMessage(self::ERROR_NOT_STARTED)->trigger();
        }

        return isset($_SESSION[$offset]);
    }

    /**
     * returns data using the ArrayAccess interface
     *
     * @param *scalar|null|bool $offset The key to get
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        //argument 1 must be scalar, null or bool
        Argument::i()->test(1, 'scalar', 'null', 'bool');

        if (!self::$session) {
            Exception::i()->setMessage(self::ERROR_NOT_STARTED)->trigger();
        }

        return isset($_SESSION[$offset]) ? $_SESSION[$offset] : null;
    }

    /**
     * Sets data using the ArrayAccess interface
     *
     * @param *scalar|null|bool $offset The key to set
     * @param mixed             $value  The value the key should be set to
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        //argument 1 must be scalar, null or bool
        Argument::i()->test(1, 'scalar', 'null', 'bool');

        if (!self::$session) {
            Exception::i()->setMessage(self::ERROR_NOT_STARTED)->trigger();
        }

        if (is_null($offset)) {
            $_SESSION[] = $value;
        } else {
            $_SESSION[$offset] = $value;
        }
    }

    /**
     * unsets using the ArrayAccess interface
     *
     * @param *scalar|null|bool $offset The key to unset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        //argument 1 must be scalar, null or bool
        Argument::i()->test(1, 'scalar', 'null', 'bool');

        if (!self::$session) {
            Exception::i()->setMessage(self::ERROR_NOT_STARTED)->trigger();
        }

        unset($_SESSION[$offset]);
    }

    /**
     * Removes a session.
     *
     * @param *string $name session name
     *
     * @return Eden\Session\Index
     */
    public function remove($name)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }

        return $this;
    }

    /**
     * Rewinds the position
     * For Iterator interface
     *
     * @return void
     */
    public function rewind()
    {
        if (!self::$session) {
            Exception::i()->setMessage(self::ERROR_NOT_STARTED)->trigger();
        }

        reset($_SESSION);
    }

    /**
     * Sets data
     *
     * @param *array|string $data  The array data to set
     * @param mixed         $value If data is a key then this is the value
     *
     * @return Eden\Session\Index
     */
    public function set($data, $value = null)
    {
        //argument 1 must be a string or array
        Argument::i()->test(1, 'array', 'string');

        if (!self::$session) {
            Exception::i()->setMessage(self::ERROR_NOT_STARTED)->trigger();
        }

        if (is_array($data)) {
            $_SESSION = $data;
            return $this;
        }

        $_SESSION[$data] = $value;

        return $this;
    }

    /**
     * Sets the session ID
     *
     * @param *int $id The prescribed session ID to use
     *
     * @return int
     */
    public function setId($sid)
    {
        //argument 1 must be an integer
        Argument::i()->test(1, 'int');

        if (!self::$session) {
            Exception::i()->setMessage(self::ERROR_NOT_STARTED)->trigger();
        }

        return session_id((int) $sid);
    }

    /**
     * Starts a session
     *
     * @return Eden\Session\Index
     */
    public function start()
    {
        if (!session_id()) {
            self::$session = session_start();
        }

        return $this;
    }

    /**
     * Starts a session
     *
     * @return Eden\Session\Index
     */
    public function stop()
    {
        self::$session = false;
        session_write_close();
        return $this;
    }

    /**
     * Validates whether if the index is set
     * For Iterator interface
     *
     * @return bool
     */
    public function valid()
    {
        if (!self::$session) {
            Exception::i()->setMessage(self::ERROR_NOT_STARTED)->trigger();
        }

        return isset($_SESSION[$this->key()]);
    }
}
