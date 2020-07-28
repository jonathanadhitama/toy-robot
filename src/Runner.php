<?php
require_once "Robot.php";
require_once "CommandFileNotFoundException.php";

/**
 * Class Runner
 */
class Runner {
    /**
     * @var array
     */
    protected $argv;

    /**
     * Runner constructor.
     * @param array $argv Array of arguments passed to the console
     */
    public function __construct(array $argv) {
        $this->argv = $argv;
    }

    /**
     * Getting contents of the commands and returning them as an array of
     * commands in string
     * @param string $filePath
     * @return bool|string[]
     * @throws CommandFileNotFoundException if text command file could not be found
     */
    private function getCommands(string $filePath) {
        if (!file_exists($filePath)) {
            throw new CommandFileNotFoundException($filePath);
        }
        $contents = file_get_contents($filePath);
        return explode(PHP_EOL, $contents);
    }

    /**
     * Receives a list of commands and executes each command individually
     * @param string[] $commands
     * @return void
     */
    private function executeCommands(array $commands) {
        $robot = new Robot();
        foreach ($commands as $command) {
            try {
                $this->executeCommandRobot($robot, $command);
            } catch (InvalidCommandException $e) {
                echo $e->getMessage() . "\n";
            }
        }
    }

    /**
     * Receives a command and executes the appropriate robot action
     * @param Robot $robot
     * @param string $command
     * @return void
     */
    private function executeCommandRobot(Robot $robot, string $command) {
        $commandUpper = strtoupper($command);
        if (strpos($commandUpper, 'PLACE') !== false) {
            //execute 'PLACE' command
            //Ensuring 'PLACE' command follows the correct syntax PLACE X,Y,F via regex
            if (preg_match('/PLACE\s(\d+\,){2}[A-Z]+/', $command)) {
                //Get relevant parameters
                $parameters = explode(" ", $commandUpper)[1];
                $parametersArray = explode(",", $parameters);
                $x = $parametersArray[0];
                $y = $parametersArray[1];
                $f = $parametersArray[2];
                $robot->place($x, $y, $f);
            }
        } else if (strpos($commandUpper, 'MOVE') !== false) {
            //execute 'MOVE' command
            $robot->move();
        } else if (strpos($commandUpper, 'LEFT') !== false) {
            //execute 'LEFT' command
            $robot->left();
        } else if (strpos($commandUpper, 'RIGHT') !== false) {
            //execute 'RIGHT' command
            $robot->right();
        } else if (strpos($commandUpper, 'REPORT') !== false) {
            //execute 'REPORT' command
            $robot->report();
        }
    }

    /**
     * Function to execute the whole program
     * @return void
     */
    public function run() {
        if (count($this->argv) <= 1) {
            echo "No input command text file provided.\n";
        }
        foreach($this->argv as $key => $filePath) {
            if ($key === 0) {
                //Skipping first argument received from console as it is the filename of the script
                continue;
            }
            try {
                $this->executeCommands($this->getCommands($filePath));
            } catch (CommandFileNotFoundException $e) {
                echo $e->getMessage() . "\n";
            }
        }
    }
}