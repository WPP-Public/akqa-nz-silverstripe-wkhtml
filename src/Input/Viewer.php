<?php

namespace Heyday\SilverStripe\WkHtml\Input;

use Heyday\SilverStripe\WkHtml\TemplateHelper;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\View\ArrayData;
use SilverStripe\View\Requirements;
use SilverStripe\View\SSViewer;
use SilverStripe\View\ViewableData;

/**
 * Class Viewer
 * @package Heyday\SilverStripe\WkHtml\Input
 */
class Viewer implements InputInterface
{
    use Injectable;

    /**
     * @var ViewableData|array|null
     */
    protected $data = null;

    /**
     * @var SSViewer
     */
    protected $viewer;

    /**
     * @param SSViewer $viewer
     * @param ViewableData|array|null $data
     */
    public function __construct(SSViewer $viewer, $data = null)
    {
        $this->viewer = $viewer;

        if (null !== $data) {
            $this->setData($data);
        }
    }

    /**
     * @return array|null|ViewableData
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param ViewableData|array $data
     * @throws \RuntimeException
     */
    public function setData($data)
    {
        if ($data instanceof ViewableData) {
            $this->data = $data;
        } elseif (is_array($data)) {
            $this->data = ArrayData::create($data);
        } else {
            throw new \RuntimeException('Inputted data type not supported');
        }
    }

    /**
     * @return mixed
     */
    public function process()
    {
        if ($this->data instanceof ViewableData) {
            $this->data->setField('Helper', TemplateHelper::create());
        }

        Requirements::clear();
        $result = $this->getViewer()->process($this->data);
        Requirements::restore();

        return $result;
    }

    /**
     * @return SSViewer
     */
    public function getViewer()
    {
        return $this->viewer;
    }

    /**
     * @param SSViewer $viewer
     */
    public function setViewer(SSViewer $viewer)
    {
        $this->viewer = $viewer;
    }
}
