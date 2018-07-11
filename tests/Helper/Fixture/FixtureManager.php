<?php
namespace Tests\Helper\Fixture;

class FixtureManager{
     /**
     * Was this instance already initialized?
     *
     * @var bool
     */
    protected $_initialized = false;

    /**
     * Holds the fixture classes that where instantiated
     *
     * @var \Cake\Datasource\FixtureInterface[]
     */
    protected $_loaded = [];

    /**
     * A map of connection names and the fixture currently in it.
     *
     * @var array
     */
    protected $_insertionMap = [];

    /**
     * List of TestCase class name that have been processed
     *
     * @var array
     */
    protected $_processed = [];

    public function fixturize($test)
    {
        if (empty($test->fixtures) || !empty($this->_processed[get_class($test)])) {
            return;
        }
        $this->_loadFixtures($test);
        $this->_processed[get_class($test)] = true;
    }

    protected function _loadFixtures($test)
    {
        if (empty($test->fixtures)) {
            return;
        }

        foreach ($test->fixtures as $fixture) {
            if (isset($this->_loaded[$fixture])) {
                continue;
            }

            if (class_exists($fixture)) {
                $this->_loaded[$fixture] = new $fixture();
            }else{
                $msg = sprintf(
                    'Referenced fixture class "%s" not found. Fixture "%s" was referenced in test case "%s".',
                    $fixture,
                    $fixture,
                    get_class($test)
                );
                throw new \UnexpectedValueException($msg);
            }
        }
    }

    public function loaded()
    {
        return $this->_loaded;
    }

    public function load($test)
    {
        if (empty($test->fixtures)) {
            return;
        }

        foreach($this->_loaded as $fixture){
            $fixture->drop();

            // create table
            $fixture->create();

            // insert data
            $fixture->table()->insert($fixture->data());
        }
    }

    public function unload($test)
    {
        if (empty($test->fixtures)) {
            return;
        }

        foreach($this->_loaded as $fixture){
            if ($fixture->schema()->hasTable($fixture->table)) {
                $fixture->table()->truncate();
            }
        }
    }
    
    public function shutDown()
    {
        foreach($this->_loaded as $fixture){
            $fixture->drop();
        }
    }
}
