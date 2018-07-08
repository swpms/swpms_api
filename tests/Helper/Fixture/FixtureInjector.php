<?php
namespace Tests\Helper\Fixture;

use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;
use Tests\Helper\IntegrationTestCase;

/**
 * Test listener used to inject a fixture manager in all tests that
 * are composed inside a Test Suite
 */
class FixtureInjector implements TestListener
{
    use TestListenerDefaultImplementation;

    /**
     * The instance of the fixture manager to use
     *
     * @var FixtureManager
     */
    protected $_fixtureManager;
    /**
     * Holds a reference to the container test suite
     *
     * @var \PHPUnit\Framework\TestSuite
     */
    protected $_first;

    /**
     * Constructor. Save internally the reference to the passed fixture manager
     *
     * @param \Tests\Helper\Fixture $manager The fixture manager
     */
    public function __construct(FixtureManager $manager)
    {
        $this->_fixtureManager = $manager;
        $this->_fixtureManager->shutDown();
    }
    
    /**
     * Iterates the tests inside a test suite and creates the required fixtures as
     * they were expressed inside each test case.
     *
     * @param \PHPUnit\Framework\TestSuite $suite The test suite
     * @return void
     */
    public function startTestSuite(\PHPUnit\Framework\TestSuite $suite):void
    {
        if (empty($this->_first)) {
            $this->_first = $suite;
        }
    }
    /**
     * Destroys the fixtures created by the fixture manager at the end of the test
     * suite run
     *
     * @param \PHPUnit\Framework\TestSuite $suite The test suite
     * @return void
     */
    public function endTestSuite(\PHPUnit\Framework\TestSuite $suite):void
    {
        if ($this->_first === $suite) {
            $this->_fixtureManager->shutDown();
        }
    }
    /**
     * Adds fixtures to a test case when it starts.
     *
     * @param \PHPUnit\Framework\Test $test The test case
     * @return void
     */
    public function startTest(\PHPUnit\Framework\Test $test):void
    {
        $test->fixtureManager = $this->_fixtureManager;
        if ($test instanceof IntegrationTestCase) {
            $this->_fixtureManager->fixturize($test);
            $this->_fixtureManager->load($test);
        }
    }
    /**
     * Unloads fixtures from the test case.
     *
     * @param \PHPUnit\Framework\Test $test The test case
     * @param float $time current time
     * @return void
     */
    public function endTest(\PHPUnit\Framework\Test $test, $time):void
    {
        if ($test instanceof IntegrationTestCase) {
            $this->_fixtureManager->unload($test);
        }
    }
}