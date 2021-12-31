<?php declare(strict_types=1);

require_once("vendor/autoload.php");
require_once("src/Maze.php");

use PHPUnit\Framework\TestCase;
use PerryRylance\Prims\Maze;

final class GenerationTest extends TestCase
{
	public function testGeneration()
	{
		$maze = new Maze(16, 16, 123);
		$maze->generate();

		$this->assertEquals(
"▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓
▓               ▓▓
▓ ▓ ▓ ▓▓▓ ▓ ▓ ▓ ▓▓
▓ ▓ ▓   ▓ ▓ ▓ ▓ ▓▓
▓ ▓▓▓▓▓ ▓ ▓ ▓ ▓ ▓▓
▓     ▓ ▓ ▓ ▓ ▓ ▓▓
▓ ▓▓▓▓▓ ▓▓▓▓▓ ▓ ▓▓
▓   ▓ ▓     ▓ ▓ ▓▓
▓ ▓ ▓ ▓ ▓▓▓▓▓ ▓ ▓▓
▓ ▓ ▓   ▓ ▓   ▓ ▓▓
▓ ▓▓▓ ▓ ▓ ▓▓▓ ▓ ▓▓
▓ ▓   ▓   ▓   ▓ ▓▓
▓ ▓ ▓ ▓ ▓▓▓ ▓ ▓ ▓▓
▓ ▓ ▓ ▓   ▓ ▓ ▓ ▓▓
▓ ▓ ▓▓▓ ▓▓▓ ▓▓▓▓▓▓
▓ ▓ ▓     ▓     ▓▓
▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓
▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓",
			$maze->ascii()
		);
	}
}