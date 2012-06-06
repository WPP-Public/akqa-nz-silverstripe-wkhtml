<?php

/**
 * Takes a SS_HTTPRequest and produces html input for PDF
 */
class HeydayWkHtmlToPdfRequestInput implements HeydayWkHtmlToPdfInputter
{

	protected $request = false;
	protected $session = false;

	public function __construct(SS_HTTPRequest $request, $session = false)
	{

		$this->request = $request;

		if ($session instanceof Session) {

			$this->setSession($session);

		} elseif (is_array($session)) {

			$this->setSession(new Session($session));

		} else {

			$this->setSession(new Session(null));

		}

	}

	public function getRequest()
	{

		return $this->request;

	}

	public function setSession(Session $session)
	{

		$this->session = $session;

	}

	public function getSession()
	{

		return $this->session;

	}

	public function process(WKPDF $wkpdf)
	{

		$result = HeydayWkHtmlToPdfDirector::handleRequest($this->request, $this->session);

		if ($result instanceof SS_HTTPResponse) {

			ob_start();

			$result->output();

			$wkpdf->set_html(ob_get_clean());

		} elseif (is_string($result)) {

			$wkpdf->set_html($result);

		} else {

			user_error('Can\'t handle output from request');

		}

	}

}
