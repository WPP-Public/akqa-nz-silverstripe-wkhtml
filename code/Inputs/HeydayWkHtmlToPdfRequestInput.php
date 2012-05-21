<?php

class HeydayWkHtmlToPdfRequestInput implements HeydayWkHtmlToPdfInputter
{

	protected $request = false;
	protected $session = false;

	public function __construct(SS_HTTPRequest $request, $session = false)
	{

		$this->request = $request;

		if ($session instanceof Session) {

			$this->setSession($session);

		} else if (is_array($session)) {

			$this->setSession(new Session($session));

		} else {

			$this->setSession(new Session(null));

		}

	}

	public function setSession(Session $session)
	{

		$this->session = $session;

	}

	public function getSession()
	{

		return $this->session;

	}

	public function process()
	{

		$result = Director::handleRequest($this->request, $this->session);

		if ($result instanceof SS_HTTPResponse) {

			ob_start();

			$result->output();

			return ob_get_clean();

		} else if (is_string($result)) {

			return $result;

		} else {

			user_error('Can\'t handle output from request');

		}

	}

}