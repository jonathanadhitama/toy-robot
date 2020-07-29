Assumptions:
1. The robot initial position is null.
2. If the robot is placed on an invalid position, the robot's direction will not be updated.
3. If the robot is initially placed on an invalid position, the next set of commands will not run until the robot is placed onto a correct position. 
4. Any invalid commands will be skipped and not executed.
5. Code was developed and tested with PHP v7.4.8 
6. Unit test was tested with PHPUnit v9.2.6

Instructions:
1. Navigate to project directory
2. Running: `php main.php [args...]` where 'args' contains at least one file path to a valid command text file  i.e. `php main.php a.txt b.txt c.txt` 
3. Running test: `phpunit` (assuming phpunit is installed)