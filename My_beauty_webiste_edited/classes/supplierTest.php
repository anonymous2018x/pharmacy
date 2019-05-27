<?php
require_once 'supplier.php';

/**
 * supplier test case.
 */
class supplierTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var supplier
     */
    private $supplier;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated supplierTest::setUp()
        
        $this->supplier = new supplier(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated supplierTest::tearDown()
        $this->supplier = null;
        
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
     * Tests supplier->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated supplierTest->test__construct()
      //  $this->markTestIncomplete("__construct test not implemented");
        
        $this->supplier->__construct(/* parameters */);
    }

    /**
     * Tests supplier->showproductProfit()
     */
   /* public function testShowproductProfit()
    {
        // TODO Auto-generated supplierTest->testShowproductProfit()
      //  $this->markTestIncomplete("showproductProfit test not implemented");
        
        $actual=false;
        $result= $this->supplier->showproductProfit();
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }*/

    /**
     * Tests supplier->showsupplierProducts()
     */
    public function testShowsupplierProducts()
    {
        // TODO Auto-generated supplierTest->testShowsupplierProducts()
       // $this->markTestIncomplete("showsupplierProducts test not implemented");
        
        $actual=false;
        $result= $this->supplier->showsupplierProducts('27');
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests supplier->viewFeedbackDetails()
     */
    public function testViewFeedbackDetails()
    {
        // TODO Auto-generated supplierTest->testViewFeedbackDetails()
       // $this->markTestIncomplete("viewFeedbackDetails test not implemented");
        
        $actual=false;
        $result= $this->supplier->viewFeedbackDetails('27');
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests supplier->viewSupplierProfile()
     */
    public function testViewSupplierProfile()
    {
        // TODO Auto-generated supplierTest->testViewSupplierProfile()
      //  $this->markTestIncomplete("viewSupplierProfile test not implemented");
        
        $actual=false;
        $result= $this->supplier->viewSupplierProfile('27');
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests supplier->editpersonalinformation()
     */
    public function testEditpersonalinformation()
    {
        // TODO Auto-generated supplierTest->testEditpersonalinformation()
      //  $this->markTestIncomplete("editpersonalinformation test not implemented");
        
        
        $actual= $this->supplier->Editpersonalinformation('abaradah@gmail.com','password','bogy','01154216453','blah','20161818');
        $this->assertEquals(true, $actual);
    }
}

