<?php

/**
 * Class Robot
 *
 * Robot class to keep track and move
 */
class Robot {
    /**
     * X-coordinate of the current robot position
     * @var null|int
     */
    private $x = null;
    /**
     * Y-coordinate of the current robot position
     * @var null|int
     */
    private $y = null;
    /**
     * Current direction the robot is facing (NORTH, SOUTH, EAST or WEST)
     * @var null|string
     */
    private $f = null;

    /**
     * Index to determine which new direction to face when turning left
     * based on the robot's current facing direction
     * @var array
     */
    private const LEFT_INDEX = [
        'NORTH' => 'WEST',
        'SOUTH' => 'EAST',
        'EAST' => 'NORTH',
        'WEST' => 'SOUTH'
    ];
    /**
     * Index to determine which new direction to face when turning right
     * based on the robot's current facing direction
     * @var array
     */
    private const RIGHT_INDEX = [
        'NORTH' => 'EAST',
        'SOUTH' => 'WEST',
        'EAST' => 'SOUTH',
        'WEST' => 'NORTH'
    ];

    /**
     * Index to determine which coordinate (x or y) the robot should move when a MOVE command is issued by a
     * specified value based on the robot's current facing direction
     * @var array
     */
    private const MOVE_INDEX = [
        'NORTH' => ['which' => 'y', 'value' => 1],
        'SOUTH' => ['which' => 'y', 'value' => -1],
        'EAST' => ['which' => 'x', 'value' => 1],
        'WEST' => ['which' => 'x', 'value' => -1]
    ];

    /**
     * Constant minimum value of the X-coordinate before the robot goes out of bounds
     * @var int
     */
    private const MIN_X = 0;

    /**
     * Constant maximum value of the X-coordinate before the robot goes out of bounds
     * @var int
     */
    private const MAX_X = 5;

    /**
     * Constant minimum value of the Y-coordinate before the robot goes out of bounds
     * @var int
     */
    private const MIN_Y = 0;

    /**
     * Constant maximum value of the Y-coordinate before the robot goes out of bounds
     * @var int
     */
    private const MAX_Y = 5;


    /**
     * Constant array of valid directions for validation purposes
     * @var array
     */
    private const VALID_DIRECTIONS = ["NORTH", "SOUTH", "WEST", "EAST"];

    /**
     * A function to check whether the provided coordinate exists on the table
     * @param int $x
     * @param int $y
     * @return bool
     */
    private function isValidCoordinate(int $x, int $y) {
        if (
            $x > self::MAX_X || $x < self::MIN_X ||
            $y > self::MAX_Y || $y < self::MIN_Y
        ) {
            return false;
        }
        return true;
    }

    /**
     * @param string $f
     * @return bool
     */
    private function isValidDirection (string $f) {
        return in_array($f, self::VALID_DIRECTIONS);
    }

    /**
     * A function to simulate the PLACE command, to place the robot on a different coordinate on the table
     * @param int $x
     * @param int $y
     * @param string $f
     * @return void
     */
    public function place(int $x, int $y, string $f) {
        //Check for valid coordinate and direction
        if ($this->isValidCoordinate($x, $y) && $this->isValidDirection($f)) {
            $this->x = $x;
            $this->y = $y;
            $this->f = $f;
        }
    }

    /**
     * A function to simulate the MOVE command, to move the robot one unit forward at the current direction it is facing
     * @return void
     */
    public function move() {
        //Robot can only be moved once placed on the table
        if (!is_null($this->x) && !is_null($this->y) && array_key_exists($this->f, self::MOVE_INDEX)) {
            $direction = self::MOVE_INDEX[$this->f];
            if ($direction['which'] === 'x') {
                $newX = $this->x + $direction['value'];
                if ($this->isValidCoordinate($newX, $this->y)) {
                    $this->x = $newX;
                }
            } else if ($direction['which'] === 'y') {
                $newY = $this->y + $direction['value'];
                if ($this->isValidCoordinate($this->x, $newY)) {
                    $this->y = $newY;
                }
            }
        }
    }

    /**
     * A function to simulate the LEFT command, to rotate the robot 90 degrees left without changing the position of the
     * robot
     * @return void
     */
    public function left() {
        if (array_key_exists($this->f, self::LEFT_INDEX)) {
            $this->f = self::LEFT_INDEX[$this->f];
        }
    }

    /**
     * A function to simulate the RIGHT command, to rotate the robot 90 degrees right without changing the position of
     * the robot
     * @return void
     */
    public function right() {
        if (array_key_exists($this->f, self::RIGHT_INDEX)) {
            $this->f = self::RIGHT_INDEX[$this->f];
        }
    }

    /**
     * A function to simulate the REPORT command, to report the current position and direction the robot is facing
     * @return void
     */
    public function report() {
        if (!is_null($this->x) && !is_null($this->y) && !is_null($this->f)) {
            echo "$this->x,$this->y,$this->f\n";
        }
    }
}