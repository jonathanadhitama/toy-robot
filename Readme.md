Assumptions:
1. The robot initial position is null (x = null, y = null, and f= null).
2. If the robot is placed on an invalid position, (i.e. PLACE 100,100,NORTH) the robot's direction will not be updated.
3. If the robot is placed on a valid position, but has an invalid direction, (i.e. PLACE 0,0,EAS) subsequent commands will not run until the robot is placed with a valid position and direction. 
4. If the robot is placed on an invalid position, subsequent commands will not run until the robot is placed onto a correct position and direction. 
5. Any invalid commands will be skipped and not executed.
6. Code was developed and tested with PHP v7.4.8 
7. Unit test was tested with PHPUnit v9.2.6

Instructions:
1. Navigate to project directory
2. Running: `php main.php [args...]` where 'args' contains at least one file path to a valid command text file  i.e. `php main.php a.txt b.txt c.txt` 
3. Running test: `phpunit` (assuming phpunit is installed)