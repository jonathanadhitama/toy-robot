<?php
require_once "src/Runner.php";
use PHPUnit\Framework\TestCase;

/**
 * Class RunnerTest
 *
 * Class used for Unit Testing Robot Class
 */
class RunnerTest extends TestCase
{
    /**
     * A valid sample argv
     * @var string[]
     */
    private $validArgv = ["main.php", "tests/test.txt"];

    /**
     * A sample argv with a command text file that does not exist
     * @var string[]
     */
    private $fileNotFoundArgv = ["main.php", "tests/sample.txt"];

    /**
     * A sample argv with an invalid command inside the command text file
     * @var string[]
     */
    private $invalidCommandArgv = ["main.php", "tests/test_invalid.txt"];

    /**
     * A sample argv with an no command text file provided
     * @var string[]
     */
    private $argvWithNoInputFile = ["main.php"];

    /**
     * Test Runner Class with a valid simulated argv
     * @test
     */
    public function testRun() {
        $this->expectOutputString("3,3,NORTH\n");
        (new Runner($this->validArgv))->run();
    }

    /**
     * Test Runner Class with an invalid simulated argv where the command input file does not exist
     * @test
     */
    public function testRunFileNotFound() {
        $this->expectOutputString("Command text file tests/sample.txt cannot be found.\n");
        (new Runner($this->fileNotFoundArgv))->run();
    }

    /**
     * Test Runner Class with an valid simulated argv but the command input file contains an invalid command
     * @test
     */
    public function testRunInvalidCommand() {
        $this->expectOutputString("1,2,NORTH\n");
        (new Runner($this->invalidCommandArgv))->run();
    }

    /**
     * Test Runner Class with an invalid simulated argv
     * where the no command input text file was provided
     * @test
     */
    public function testRunEmptyArguments() {
        $this->expectOutputString("No input command text file provided.\n");
        (new Runner($this->argvWithNoInputFile))->run();
    }
}
