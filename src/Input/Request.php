<?php

namespace Heyday\SilverStripe\WkHtml\Input;

use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Control\Session;
use SilverStripe\Core\Injector\Injectable;

/**
 * Takes a SS_HTTPRequest and produces html input for PDF
 */
class Request implements InputInterface
{
    use Injectable;

    /**
     * @var HTTPRequest
     */
    protected $request;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var callable|null
     */
    protected $handleMethod = null;

    /**
     * @param HTTPRequest $request
     * @param array|Session $session
     */
    public function __construct(HTTPRequest $request, $session = [])
    {
        $this->request = $request;
        $this->setSession($session);
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param Session|array $session
     * @throws \RuntimeException
     */
    public function setSession($session)
    {
        if ($session instanceof Session) {
            $this->session = $session;
        } elseif (is_array($session)) {
            $this->session = new Session($session);
        } else {
            throw new \RuntimeException('Session argument must be an array or a Session object');
        }
    }

    /**
     * @return string
     * @throws \RuntimeException
     */
    public function process()
    {
        $result = call_user_func($this->getHandleMethod(), $this->request);

        if ($result instanceof HTTPResponse) {
            ob_start();
            $result->output();
            return ob_get_clean();
        } elseif (is_string($result)) {
            return $result;
        } else {
            throw new \RuntimeException('Can\'t handle output from request');
        }
    }

    /**
     * @return callable
     */
    protected function getHandleMethod()
    {
        if ($this->handleMethod === null) {
            $this->handleMethod = [Director::singleton(), 'handleRequest'];
        }

        return $this->handleMethod;
    }

    /**
     * @param callable $handleMethod
     */
    public function setHandleMethod(callable $handleMethod)
    {
        $this->handleMethod = $handleMethod;
    }
}
