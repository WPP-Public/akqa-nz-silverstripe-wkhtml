<?php

/**
 * Class to overwrite director so handleRequest can be called by HeydayWkHtmlToPdfRequestInput
 */
class HeydayWkHtmlToPdfDirector extends Director
{

	public static function handleRequest(SS_HTTPRequest $request, Session $session)
	{

		return parent::handleRequest($request, $session);

	}

}
