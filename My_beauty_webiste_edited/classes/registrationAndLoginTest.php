<?php
require_once 'registrationAndLogin.php';

/**
 * registrationAndLogin test case.
 */
class registrationAndLoginTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var registrationAndLogin
     */
    private $registrationAndLogin;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated registrationAndLoginTest::setUp()
        
        $this->registrationAndLogin = new registrationAndLogin(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated registrationAndLoginTest::tearDown()
        $this->registrationAndLogin = null;
        
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
     * Tests registrationAndLogin->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated registrationAndLoginTest->test__construct()
      //  $this->markTestIncomplete("__construct test not implemented");
        
        $this->registrationAndLogin->__construct(/* parameters */);
    }

    /**
     * Tests registrationAndLogin->UserRegister()
     */
    public function testUserRegister()
    {
        // TODO Auto-generated registrationAndLoginTest->testUserRegister()
       // $this->markTestIncomplete("UserRegister test not implemented");
        $actual= $this->registrationAndLogin->UserRegister('abdelrahman','abaradah@gmail.com','ashaf','fdbxdfngf','blah','01112481686','2017-12-07','male');            
        $this->assertEquals(true, $actual);
    }

    /**
     * Tests registrationAndLogin->isUserExist()
     */
    public function testIsUserExist()
    {
        // TODO Auto-generated registrationAndLoginTest->testIsUserExist()
    //    $this->markTestIncomplete("isUserExist test not implemented");
        
        
        $actual= $this->registrationAndLogin->isUserExist('ashaf');
        $this->assertEquals(true, $actual);
    }

    /**
     * Tests registrationAndLogin->Login()
     */
    public function testLogin()
    {
        // TODO Auto-generated registrationAndLoginTest->testLogin()
      //  $this->markTestIncomplete("Login test not implemented");
        
        
        $actual=false;
        $result= $this->registrationAndLogin->Login('bogy_1997','password','0');
        if(is_int($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }

    /**
     * Tests registrationAndLogin->logout()
     */
    public function testLogout()
    {
        // TODO Auto-generated registrationAndLoginTest->testLogout()
      //  $this->markTestIncomplete("logout test not implemented");
        
        $this->registrationAndLogin->logout();
    }
}

