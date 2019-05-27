<?php
require_once 'purchase_shipping.php';

/**
 * purchase_shipping test case.
 */
class purchase_shippingTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var purchase_shipping
     */
    private $purchase_shipping;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated purchase_shippingTest::setUp()
        
        $this->purchase_shipping = new purchase_shipping(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated purchase_shippingTest::tearDown()
        $this->purchase_shipping = null;
        
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
     * Tests purchase_shipping->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated purchase_shippingTest->test__construct()
       // $this->markTestIncomplete("__construct test not implemented");
        
        $this->purchase_shipping->__construct(/* parameters */);
    }

    /**
     * Tests purchase_shipping->addShippingDetails()
     */
    public function testAddShippingDetails()
    {
        // TODO Auto-generated purchase_shippingTest->testAddShippingDetails()
       // $this->markTestIncomplete("addShippingDetails test not implemented");
        
      
        
        $actual= $this->purchase_shipping->AddShippingDetails("BLAH","20161818","84","2017-12-18","27");            
        $this->assertEquals(true, $actual);
    }
}

