<?php
namespace ZendDeveloperTools\Collector;

use Zend\Mvc\MvcEvent;
use Zend\Log\Processor\Backtrace;

class DebugCollector extends AbstractCollector
{

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'debug';
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
    }

    function debug($value, $label = null)
    {
        $backtrace = debug_backtrace();
        $index = 0;
        
        $function = $backtrace[$index + 1]['function'];
        $line = $backtrace[$index]['line'];
        // $file = $backtrace[$index]['file'];
        $class = $backtrace[$index + 1]['class'];
        // $object = $backtrace[$index]['object'];
        // $type = $backtrace[$index]['type'];
        
        
        if(is_object($value))
        {
            $varClass = get_class($value);
            $value = "Class of {{$varClass}}";
        }
        
        $data['var'] = $value;
        $data['method'] = $function;
        $data['class'] = $class;
        $data['line'] = $line;
        
        if(empty($label))
        {
            $this->data['vars'][] = $data;
        }
        else
        {
            $this->data['vars'][$label] = $data;
        }
    }

    /**
     *
     * @return array
     */
    public function getData()
    {
        return $this->data['vars'];
    }

    /**
     * @param mixed $value
     * @return boolean
     */
    protected function _isSerializable($value)
    {
        $return = true;
        $arr = array(
            $value
        );
        
        array_walk_recursive($arr, function ($element) use(&$return)
        {
            if(is_object($element) && get_class($element) == 'Closure')
            {
                $return = false;
            }
        });
        
        return $return;
    }
}
