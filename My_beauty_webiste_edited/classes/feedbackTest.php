<?php
require_once 'feedback.php';

/**
 * feedback test case.
 */
class feedbackTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var feedback
     */
    private $feedback;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated feedbackTest::setUp()
        
        $this->feedback = new feedback(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated feedbackTest::tearDown()
        $this->feedback = null;
        
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
     * Tests feedback->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated feedbackTest->test__construct()
        //$this->markTestIncomplete("__construct test not implemented");
        
        $this->feedback->__construct(/* parameters */);
    }

    /**
     * Tests feedback->viewFeedbackDetails()
     */
    public function testViewFeedbackDetails()
    {
        // TODO Auto-generated feedbackTest->testViewFeedbackDetails()
        //$this->markTestIncomplete("viewFeedbackDetails test not implemented");
        
        $actual=false;
        $result= $this->feedback->ViewFeedbackDetails();
        if(is_array($result))
            $actual=true;
            
            $this->assertEquals(true, $actual);
    }
}

