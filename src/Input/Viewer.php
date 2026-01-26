<?php

namespace Heyday\SilverStripe\WkHtml\Input;

use Heyday\SilverStripe\WkHtml\TemplateHelper;
use RuntimeException;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\Model\ArrayData;
use SilverStripe\Model\ModelData;
use SilverStripe\View\Requirements;
use SilverStripe\View\SSViewer;

/**
 * Class Viewer
 * @package Heyday\SilverStripe\WkHtml\Input
 */
class Viewer implements InputInterface
{
    use Injectable;

    /**
     * @var ModelData|array|null
     */
    protected $data = null;

    /**
     * @var SSViewer
     */
    protected $viewer;

    /**
     * @param SSViewer $viewer
     * @param ModelData|array|null $data
     */
    public function __construct(SSViewer $viewer, $data = null)
    {
        $this->viewer = $viewer;

        if (null !== $data) {
            $this->setData($data);
        }
    }

    /**
     * @return array|null|ModelData
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param ModelData|array $data
     * @throws RuntimeException
     */
    public function setData($data)
    {
        if ($data instanceof ModelData) {
            $this->data = $data;
        } elseif (is_array($data)) {
            $this->data = ArrayData::create($data);
        } else {
            throw new RuntimeException('Inputted data type not supported');
        }
    }

    /**
     * @return mixed
     */
    public function process()
    {
        if ($this->data instanceof ModelData) {
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
