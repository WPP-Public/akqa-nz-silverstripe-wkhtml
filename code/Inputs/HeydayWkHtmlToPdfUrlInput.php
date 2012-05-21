<?php

class HeydayWkHtmlToPdfUrlInput implements HeydayWkHtmlToPdfInputter
{

	protected $url = false;
	protected $siteUrl = true;

	public function __construct($url)
	{

		$this->setUrl($url);

	}

	public function setUrl($url)
	{

		if (Director::is_site_url($url)) {

			$this->siteUrl = true;

		} else if (Director::is_absolute_url($url)) {

			$this->siteUrl = false;

		} else {

			user_error('Something funky with your input url bro');

		}

		$this->url = $url;

	}

	public function getUrl()
	{

		return $this->url;

	}

	public function process()
	{

		if ($this->siteUrl) {

			ob_start();

			Director::direct($this->url);

			return ob_get_clean();

		} else {

			return @file_get_contents($this->url);

		}

	}

}