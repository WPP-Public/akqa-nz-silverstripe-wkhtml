<?php

namespace Heyday\SilverStripe\WkHtml\Input;

use SS_HTTPRequest;
use SS_HTTPResponse;
use Session;
use ReflectionMethod;

/**
 * Takes a SS_HTTPRequest and produces html input for PDF
 */
class Request implements InputInterface
{
    /**
     * @var \SS_HTTPRequest
     */
    protected $request;
    /**
     * @var \Session
     */
    protected $session;
    /**
     * @var \ReflectionMethod
     */
    protected $handleMethod;
    /**
     * @param \SS_HTTPRequest $request
     * @param bool           $session
     */
    public function __construct(SS_HTTPRequest $request, $session = array())
    {
        $this->request = $request;
        $this->setSession($session);
    }
    /**
     * @param $session
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
     * @return \Session
     */
    public function getSession()
    {
        return $this->session;
    }
    /**
     * @return string
     * @throws \RuntimeException
     */
    public function process()
    {
        $result = $this->getHandleMethod()->invoke(
            null,
            $this->request,
            $this->session
        );
        if ($result instanceof SS_HTTPResponse) {
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
     * @param ReflectionMethod $handleMethod
     */
    public function setHandleMethod(ReflectionMethod $handleMethod)
    {
        $this->handleMethod = $handleMethod;
    }
    /**
     * @return ReflectionMethod
     */
    protected function getHandleMethod()
    {
        if (!$this->handleMethod) {
            $this->handleMethod = new ReflectionMethod('Director', 'handleRequest');
            $this->handleMethod->setAccessible(true);
        }

        return $this->handleMethod;
    }
}
