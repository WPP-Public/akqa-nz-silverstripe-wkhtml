<?php

/**
 * Class to overwrite director so handleRequest can be called by SilverStripeWkHtmlToPdfRequestInput
 */
class SilverStripeWkHtmlToPdfDirector extends Director
{

	public static function handleRequest(SS_HTTPRequest $request, Session $session)
	{

		return parent::handleRequest($request, $session);

	}

}
