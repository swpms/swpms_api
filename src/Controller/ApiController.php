<?php
namespace Api\Controller;

use Psr\Container\ContainerInterface;

class ApiController {
    /**
     * Slim App.
     *
     * @var \Psr\Container\ContainerInterface;
     */
    protected $ci;

    /**
     * Construct.
     *
     * @param \Psr\Container\ContainerInterface $ci
     */
    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
        $this->initialize();
    }

    /**
     * [init description].
     *
     * @return [type] [description]
     */
    public function initialize()
    {
        
    }

    /**
     * get data for self or container
     */
    public function __get($id){
        if(property_exists($this, $id)){
            return $this->{$id};
        }

        if($this->ci->has($id)){
            return $this->ci->get($id);
        }
        return null;
    }
}