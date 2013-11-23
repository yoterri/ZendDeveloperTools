<?php
namespace ZendDeveloperTools\Collector;

use Zend\Mvc\MvcEvent;

class SessionCollector extends AbstractCollector
{

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'session';
    }

    /**
     * @inheritdoc
     */
    public function getPriority()
    {
        return 100;
    }

    /**
     * @inheritdoc
     */
    public function collect(MvcEvent $mvcEvent)
    {
        $this->data = $_SESSION;
    }

    /**
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
