<?php

namespace Heyday\SilverStripe\WkHtml\Input;

use ArrayData;
use Heyday\SilverStripe\WkHtml\TemplateHelper;
use Requirements;
use SSViewer;
use ViewableData;

/**
 * Class Viewer
 * @package Heyday\SilverStripe\WkHtml\Input
 */
class Viewer implements InputInterface
{
    /**
     * @var bool
     */
    protected $data = false;
    /**
     * @var SSViewer
     */
    protected $viewer;
    /**
     * @param SSViewer $viewer
     * @param null     $data
     */
    public function __construct(
        SSViewer $viewer,
        $data = null
    ) {
        $this->viewer = $viewer;
        if (null !== $data) {
            $this->setData($data);
        }
    }
    /**
     * @param $data
     * @throws \RuntimeException
     */
    public function setData($data)
    {
        if ($data instanceof ViewableData) {
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
        if ($this->data instanceof ViewableData) {
            $this->data->setField('Helper', new TemplateHelper());
        }
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
        return $this->viewer;
    }
}
