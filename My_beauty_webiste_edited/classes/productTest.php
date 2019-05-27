<?php
require_once 'product.php';

/**
 * product test case.
 */
class productTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var product
     */
    private $product;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated productTest::setUp()
        
        $this->product = new product(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated productTest::tearDown()
        $this->product = null;
        
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
     * Tests product->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated productTest->test__construct()
        //$this->markTestIncomplete("__construct test not implemented");
        
        $this->product->__construct(/* parameters */);
    }

    /**
     * Tests product->viewProductDetails()
     */
    public function testViewProductDetails()
    {
        // TODO Auto-generated productTest->testViewProductDetails()
        //$this->markTestIncomplete("viewProductDetails test not implemented");
        
        $actual=false;
        $result= $this->product->viewProductDetails('1');
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests product->showRatings()
     */
    public function testShowRatings()
    {
        // TODO Auto-generated productTest->testShowRatings()
        //$this->markTestIncomplete("showRatings test not implemented");
        
        $actual=false;
        $result= $this->product->showRatings('1');
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests product->addProducts()
     */
    public function testAddProducts()
    {
        // TODO Auto-generated productTest->testAddProducts()
        //$this->markTestIncomplete("addProducts test not implemented");
        
        $actual= $this->product->addProducts('this product is good',null,'10','signal','70','20161818','2');
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests product->viewAllProducts()
     */
    public function testViewAllProducts()
    {
        // TODO Auto-generated productTest->testViewAllProducts()
        //$this->markTestIncomplete("viewAllProducts test not implemented");
        
        
        $actual=false;
        $result= $this->product->viewAllProducts();
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests product->deleteProduct()
     */
    public function testDeleteProduct()
    {
        // TODO Auto-generated productTest->testDeleteProduct()
        //$this->markTestIncomplete("deleteProduct test not implemented");
        
        $actual = $this->product->deleteProduct("81");
        $this->assertEquals(true, $actual);
    }
}

