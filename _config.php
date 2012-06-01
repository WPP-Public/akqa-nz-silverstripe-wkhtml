<?php

Director::addRules(70, array(
	HeydayWkHtmlToPdfController::$url_segment . '//$Action/$ID/$OtherID' => 'HeydayWkHtmlToPdfController'
));

Object::add_extension('Image', 'HeydayWkHtmlToPdfTemplateHelper_ImageExtension');
