<?php

class SilverStripeWkHtmlToPdfTemplateInput implements SilverStripeWkHtmlToPdfInputter
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

	public function getTemplate()
	{

		return $this->template;

	}

	public function setTemplateFromString($templateFromString = true)
	{

		$this->templateFromString = $templateFromString;

	}

	public function setData($data)
	{

		if ($data instanceof ArrayData) {

			$this->data = $data;

		} elseif (is_array($data)) {

			$this->data = new ArrayData($data);

		} else {

			user_error('Inputted data type not supported');

		}

	}

	public function getData()
	{

		return $this->data;

	}

	public function process(WKPDF $wkpdf)
	{

		$this->data->setField('Helper', new SilverStripeWkHtmlToPdfTemplateHelper());
        
        Requirements::clear();

		$viewer = $this->templateFromString ? new SSViewer_FromString($this->template) : new SSViewer($this->template);

		$wkpdf->set_html($viewer->process($this->data));

	}

}
