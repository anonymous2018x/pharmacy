<?php
require_once 'purchases.php';

/**
 * purchases test case.
 */
class purchasesTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var purchases
     */
    private $purchases;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated purchasesTest::setUp()
        
        $this->purchases = new purchases(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated purchasesTest::tearDown()
        $this->purchases = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests purchases->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated purchasesTest->test__construct()
        //$this->markTestIncomplete("__construct test not implemented");
        
        $this->purchases->__construct(/* parameters */);
    }

    /**
     * Tests purchases->viewPurchaseDetails()
     */
    public function testViewPurchaseDetails()
    {
        // TODO Auto-generated purchasesTest->testViewPurchaseDetails()
        //$this->markTestIncomplete("viewPurchaseDetails test not implemented");
        $actual=false;
        $result= $this->purchases->viewPurchaseDetails();
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }
}

