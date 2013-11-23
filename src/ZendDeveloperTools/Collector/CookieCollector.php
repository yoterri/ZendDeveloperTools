<?php
namespace ZendDeveloperTools\Collector;

use Zend\Mvc\MvcEvent;

class CookieCollector extends AbstractCollector
{

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'cookie';
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
        $cookie = $mvcEvent->getRequest()->getCookie();
        $this->data = $cookie->getArrayCopy();
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
