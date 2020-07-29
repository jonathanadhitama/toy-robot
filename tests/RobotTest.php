<?php
require_once "src/Robot.php";
use PHPUnit\Framework\TestCase;

/**
 * Class RobotTest
 *
 * Class used for Unit Testing Robot Class
 */
class RobotTest extends TestCase
{
    /**
     * @var Robot
     */
    private $robot;
    public function setUp(): void
    {
        //Setup robot for each testing at the origin facing NORTH direction
        $this->robot = new Robot();
        $this->robot->place(0,0, "NORTH");
    }

    /**
     * Test Base Case for robot in initial phase
     * @test
     */
    public function testBaseCase() {
        $robot = new Robot();
        $this->expectOutputString("Robot is in invalid position currently.\n");
        $robot->report();
    }

    /**
     * Test Place and Report Command
     * @test
     */
    public function testPlaceAndReportCommand() {
        $this->expectOutputString("0,0,NORTH\n");
        $this->robot->report();
    }

    /**
     * Test Place Invalid Position
     * @test
     */
    public function testPlaceInvalid() {
        $this->robot->place(10,10, "NORTH");
        $this->expectOutputString("0,0,NORTH\n");
        $this->robot->report();
    }

    /**
     * Test Move Command
     * @test
     */
    public function testMoveCommand() {
        $this->robot->move();
        $this->expectOutputString("0,1,NORTH\n");
        $this->robot->report();
    }

    /**
     * Test Left Command
     * @test
     */
    public function testLeftCommand() {
        $this->robot->left();
        $this->expectOutputString("0,0,WEST\n");
        $this->robot->report();
    }

    /**
     * Test Right Command
     * @test
     */
    public function testRightCommand() {
        $this->robot->right();
        $this->expectOutputString("0,0,EAST\n");
        $this->robot->report();
    }

    /**
     * Test Invalid Move Command (Move that will cause the robot to fall off the table)
     * @test
     */
    public function testInvalidMoveCommand() {
        $this->robot->left();
        $this->robot->move();
        $this->expectOutputString("0,0,WEST\n");
        $this->robot->report();
    }
}
