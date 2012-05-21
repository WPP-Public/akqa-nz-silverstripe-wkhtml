<?php

class HeydayWkHtmlToPdfTemplateInput implements HeydayWkHtmlToPdfInputter
{

	protected $template = false;
	protected $templateFromString = false;
	protected $data = false;

	public function __construct($template = false, $data = false, $templateFromString = false)
	{

		if ($template) {

			$this->setTemplate($template);

		}

		if ($data) {

			$this->setData($data);

		}

		if ($templateFromString) {

			$this->setTemplateFromString();

		}

	}

	public function setTemplate($template)
	{

		$this->template = $template;

	}

	public function setTemplateFromString($templateFromString = true)
	{

		$this->templateFromString = $templateFromString;

	}

	public function setData($data)
	{

		if ($data instanceof ArrayData) {

			$this->data = $data;

		} else if (is_array($data)) {

			$this->data = new ArrayData($data);

		} else {

			user_error('Inputted data type not supported');

		}

	}

	public function process($data = false)
	{

		if ($data) {

			$this->setData($data);

		}

		$viewer = $this->templateFromString ? new SSViewer_FromString($this->template) : new SSViewer($this->template);

		return $viewer->process($this->data);

	}

}