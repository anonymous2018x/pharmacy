<?php
require_once 'supervisor.php';

/**
 * supervisor test case.
 */
class supervisorTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var supervisor
     */
    private $supervisor;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated supervisorTest::setUp()
        
        $this->supervisor = new supervisor(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated supervisorTest::tearDown()
        $this->supervisor = null;
        
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
     * Tests supervisor->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated supervisorTest->test__construct()
       // $this->markTestIncomplete("__construct test not implemented");
        
        $this->supervisor->__construct(/* parameters */);
    }

    /**
     * Tests supervisor->viewProductDetails()
     */
    public function testViewProductDetails()
    {
        // TODO Auto-generated supervisorTest->testViewProductDetails()
       // $this->markTestIncomplete("viewProductDetails test not implemented");
        
        
        $actual=false;
        $result= $this->supervisor->viewProductDetails('1');
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests supervisor->viewPurchaseDetails()
     */
    public function testViewPurchaseDetails()
    {
        // TODO Auto-generated supervisorTest->testViewPurchaseDetails()
       // $this->markTestIncomplete("viewPurchaseDetails test not implemented");
        
        $this->supervisor->viewPurchaseDetails(/* parameters */);
    }

    /**
     * Tests supervisor->viewFeedbackDetails()
     */
    public function testViewFeedbackDetails()
    {
        // TODO Auto-generated supervisorTest->testViewFeedbackDetails()
      //  $this->markTestIncomplete("viewFeedbackDetails test not implemented");
        
        $this->supervisor->viewFeedbackDetails(/* parameters */);
    }

    /**
     * Tests supervisor->showRatings()
     */
    public function testShowRatings()
    {
        // TODO Auto-generated supervisorTest->testShowRatings()
      //  $this->markTestIncomplete("showRatings test not implemented");
        
        
        $actual=false;
        $result= $this->supervisor->showRatings('1');
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests supervisor->viewUserProfile()
     */
    public function testViewUserProfile()
    {
        // TODO Auto-generated supervisorTest->testViewUserProfile()
      //  $this->markTestIncomplete("viewUserProfile test not implemented");
        
        $actual=false;
        $result= $this->supervisor->viewUserProfile('27');
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests supervisor->viewUserPurchases()
     */
    public function testViewUserPurchases()
    {
        // TODO Auto-generated supervisorTest->testViewUserPurchases()
      //  $this->markTestIncomplete("viewUserPurchases test not implemented");
        
        $actual=false;
        $result= $this->supervisor->viewUserPurchases('27');
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests supervisor->addShippingDetails()
     */
    public function testAddShippingDetails()
    {
        // TODO Auto-generated supervisorTest->testAddShippingDetails()
       // $this->markTestIncomplete("addShippingDetails test not implemented");
        
        $actual= $this->supervisor->AddShippingDetails("BLAH","20161818","84","2017-12-18","27");
        $this->assertEquals(true, $actual);
        
    }

    /**
     * Tests supervisor->addProducts()
     */
    public function testAddProducts()
    {
        // TODO Auto-generated supervisorTest->testAddProducts()
      //  $this->markTestIncomplete("addProducts test not implemented");
        
        $actual= $this->supervisor->addProducts('this product is good',null,'10','signal','70','20161818','2');
        $this->assertEquals(true, $actual);
    }

    /**
     * Tests supervisor->deleteProduct()
     */
    public function testDeleteProduct()
    {
        // TODO Auto-generated supervisorTest->testDeleteProduct()
      //  $this->markTestIncomplete("deleteProduct test not implemented");
        
        $actual = $this->supervisor->deleteProduct("81");
        $this->assertEquals(true, $actual);
    }

    /**
     * Tests supervisor->viewAllProducts()
     */
    public function testViewAllProducts()
    {
        // TODO Auto-generated supervisorTest->testViewAllProducts()
       // $this->markTestIncomplete("viewAllProducts test not implemented");
        
        $actual=false;
        $result= $this->supervisor->ViewAllProducts();
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests supervisor->viewOwnProfile()
     */
    public function testViewOwnProfile()
    {
        // TODO Auto-generated supervisorTest->testViewOwnProfile()
      //  $this->markTestIncomplete("viewOwnProfile test not implemented");
        
        $actual=false;
        $result= $this->supervisor->viewOwnProfile("6");
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }
    

    /**
     * Tests supervisor->deleteRow()
     */
    public function testDeleteRow()
    {
        // TODO Auto-generated supervisorTest->testDeleteRow()
       // $this->markTestIncomplete("deleteRow test not implemented");
        
        $this->supervisor->deleteRow("DELETE from notification",[]);
    }

    /**
     * Tests supervisor->getRow()
     */
    public function testGetRow()
    {
        // TODO Auto-generated supervisorTest->testGetRow()
      // $this->markTestIncomplete("getRow test not implemented");
        
        $this->supervisor->getRow("select * from notification",[]);
    }
}

