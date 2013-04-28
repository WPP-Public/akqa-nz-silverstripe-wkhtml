<?php

namespace Heyday\SilverStripe\WkHtml\Input;

use ArrayData;
use Requirements;
use SSViewer;
use SSViewer_FromString;

/**
 * Class Template
 * @package Heyday\SilverStripe\WkHtml\Input
 */
class Template implements InputInterface
{
    /**
     * @var bool
     */
    protected $template = false;
    /**
     * @var bool
     */
    protected $templateFromString = false;
    /**
     * @var bool
     */
    protected $data = false;
    /**
     * @var
     */
    protected $viewer;

    /**
     * @param bool $template
     * @param bool $data
     * @param bool $templateFromString
     */
    public function __construct(
        $template = false,
        $data = false,
        $templateFromString = false
    ) {
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
    /**
     * @param $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }
    /**
     * @return bool
     */
    public function getTemplate()
    {
        return $this->template;
    }
    /**
     * @param bool $templateFromString
     */
    public function setTemplateFromString($templateFromString = true)
    {
        $this->templateFromString = $templateFromString;
    }
    /**
     * @param $data
     * @throws \RuntimeException
     */
    public function setData($data)
    {
        if ($data instanceof ArrayData) {
            $this->data = $data;
        } elseif (is_array($data)) {
            $this->data = new ArrayData($data);
        } else {
            throw new \RuntimeException('Inputted data type not supported');
        }
    }
    /**
     * @return bool
     */
    public function getData()
    {
        return $this->data;
    }
    /**
     * @return mixed
     */
    public function process()
    {
        $this->data->setField('Helper', new SilverStripeWkHtmlToPdfTemplateHelper());
        Requirements::clear();
        $result = $this->getViewer()->process($this->data);
        Requirements::restore();

        return $result;
    }
    /**
     * @param  $viewer
     */
    public function setViewer(SSViewer $viewer)
    {
        $this->viewer = $viewer;
    }
    /**
     * @return SSViewer
     */
    public function getViewer()
    {
        if (!$this->viewer) {
            $this->viewer = $this->templateFromString ? new SSViewer_FromString($this->template) : new SSViewer($this->template);
        }

        return $this->viewer;
    }
}
