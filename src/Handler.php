<?php
/**
 * Genial Framework.
 *
 * @author    Nicholas English <https://github.com/Nenglish7>
 * @author    Genial Contributors <https://github.com/orgs/Genial-Framework/people>
 *
 * @link      <https://github.com/Genial-Framework/Cookie> for the canonical source repository.
 *
 * @copyright Copyright (c) 2017-2018 Genial Framework. <https://github.com/Genial-Framework>
 * @license   <https://github.com/Genial-Framework/Cookie/blob/master/LICENSE> New BSD License.
 */

namespace Genial\Cookie;

/**
 * Handler.
 */
class Handler implements HandlerInterface
{
    /**
     * set().
     *
     * Set a new cookie variable.
     *
     * @param string|null $name The name of the cookie variable.
     * @param mixed|null $name  The value of the cookie variable.
     * @param int|{0} $expire   The expiration time on the cookie.
     *
     * @throws BadMethodCallException   If the $name argument is missing.
     * @throws UnexpectedValueException If the name argument is empty.
     * @throws LengthException          If the name argument is too long.
     *
     * @return bool|true If the cookie was correctly created.
     */
    public function set(string $name = null, $value = null, $expire = 0)
    {
        if (is_null($name)) {
            throw new Exception\BadMethodCallException(sprintf(
                '`%s` The `$name` argument is missing.',
                __METHOD__
            ));
        }
        $name = trim($name);
        if (empty($name) || $name == '') {
            throw new Exception\UnexpectedValueException(sprintf(
                '`%s` The `$name` argument is empty.',
                __METHOD__
            ));
        }
        if (strlen($name) > 30) {
            throw new Exception\LengthException(sprintf(
                '`%s` The `$name` argument is too long.',
                __METHOD__
            ));
        }
        $value = Utils::encode($value);
        setcookie(
            $name,
            $value,
            $expire,
            $this->cookieParams['path'],
            $this->cookieParams['domain']
            $this->cookieParams['secure'],
            $this->cookieParams['httponly']
        );
        $_COOKIE[$name] = $value;
        return true;
    }
}
