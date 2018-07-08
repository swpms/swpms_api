<?php
namespace Tests\Helper\Fixture;

use Illuminate\Database\Capsule\Manager as Capsule;

abstract class TestFixture{
    /**
     * 
     */
    protected $capsule;

    /**
     *
     * @var type
     */
    public $table;

    /**
     * 
     */
    public function __construct(){
        // Use the application settings
        $settings = require APP_PATH . '/settings_test.php';
        $fileName = $settings['settings']['db']['database'];
        if($fileName != ':memory:' && !file_exists($fileName)){
            touch($fileName);
        }
        
        $this->capsule = new Capsule();
        $this->capsule->addConnection($settings['settings']['db']);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    /**
     * Get schema
     */
    public function schema()
    {
        return $this->capsule->schema();
    }

    /**
     * Get table
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function table()
    {
        return $this->capsule->table($this->table);
    }

    abstract public function create():void;
    abstract public function data():array;
    
    /**
     * [drop description]
     * @return [type] [description]
     */
    public function drop()
    {
        $schema = $this->schema();
        if ($schema->hasTable($this->table)) {
            $schema->drop($this->table);
        }
        return $this;
    }
}