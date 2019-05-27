<?php
require_once 'user.php';

/**
 * user test case.
 */
class userTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var user
     */
    private $user;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated userTest::setUp()
        
        $this->user = new user(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated userTest::tearDown()
        $this->user = null;
        
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
     * Tests user->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated userTest->test__construct()
       // $this->markTestIncomplete("__construct test not implemented");
        
        $this->user->__construct(/* parameters */);
    }

    /**
     * Tests user->viewUserProfile()
     */
    public function testViewUserProfile()
    {
        // TODO Auto-generated userTest->testViewUserProfile()
       // $this->markTestIncomplete("viewUserProfile test not implemented");
        
        
        $actual=false;
        $result= $this->user->viewUserProfile('27');
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests user->viewUserPurchases()
     */
    public function testViewUserPurchases()
    {
        // TODO Auto-generated userTest->testViewUserPurchases()
       // $this->markTestIncomplete("viewUserPurchases test not implemented");
        
        $actual=false;
        $result= $this->user->viewUserPurchases('27');
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests user->rateProduct()
     */
    public function testRateProduct()
    {
        // TODO Auto-generated userTest->testRateProduct()
       // $this->markTestIncomplete("rateProduct test not implemented");
        
        
        $actual= $this->user->rateProduct('1','5','65');
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests user->addToCart()
     */
    public function testAddToCart()
    {
        // TODO Auto-generated userTest->testAddToCart()
       // $this->markTestIncomplete("addToCart test not implemented");
        
        $actual= $this->user->AddToCart('65','2','20','5');
        $this->assertEquals(true, $actual);
    }

    /**
     * Tests user->editaccountinformation()
     */
    public function testEditaccountinformation()
    {
        // TODO Auto-generated userTest->testEditaccountinformation()
      //  $this->markTestIncomplete("editaccountinformation test not implemented");
        
        $actual= $this->user->Editaccountinformation('abaradah@gmail.com','password','27');
        $this->assertEquals(true, $actual);
        
    }

    /**
     * Tests user->editpersonalinformation()
     */
    public function testEditpersonalinformation()
    {
        // TODO Auto-generated userTest->testEditpersonalinformation()
       // $this->markTestIncomplete("editpersonalinformation test not implemented");
        
        $actual= $this->user->editpersonalinformation('abaradah','01154216453','blah','9-10-1997','27');
        $this->assertEquals(true, $actual);
        
    }
}

