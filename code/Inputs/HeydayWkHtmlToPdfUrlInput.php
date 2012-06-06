<?php

class HeydayWkHtmlToPdfUrlInput implements HeydayWkHtmlToPdfInputter
{

	protected $url = false;
	protected $siteUrl = true;
	protected $useUrlDirectly = false;

	public function __construct($url,$useUrlDirectly = false)
	{
		$this->useUrlDirectly = $useUrlDirectly;

		$this->setUrl($url);

	}

	public function setUrl($url)
	{

		if (Director::is_site_url($url)) {

			$this->siteUrl = true;

		} elseif (Director::is_absolute_url($url)) {

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

	public function process(WKPDF $wkpdf)
	{
		if($this->useUrlDirectly){

			$wkpdf->set_url($this->url);

		}elseif ($this->siteUrl) {

			ob_start();

			Director::direct($this->url);

			$wkpdf->set_html(ob_get_clean());

		} else {

			$wkpdf->set_html(@file_get_contents($this->url));

		}

	}

}
