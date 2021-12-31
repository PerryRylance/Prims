<?php

namespace PerryRylance\Prims;

use Savvot\Random\XorShiftRand;

class Maze
{
	const STATE_PASSAGE = ' ';
	const STATE_WALL	= '▓';

	private XorShiftRand $prng;

	private int $width;
	private int $height;

	private array $_cells;

	public function __construct(int $width, int $height, int $seed)
	{
		$this->width	= $width;
		$this->height	= $height;
		
		$this->prng		= new XorShiftRand($seed);
	}

	public function __get($name)
	{
		if($name == "cells")
			return $this->_cells;
	}

	public function generate()
	{
		// NB: Fill cells with walls
		$this->_cells	= [];

		for($i = 0; $i < $this->width; $i++)
		{
			$column		= [];

			for($j = 0; $j < $this->height; $j++)
				$column	[]= Maze::STATE_WALL;

			$this->_cells []= $column;
		}

		// NB: Generate the maze
		$frontiers	= [];

		$x			= $this->prng->random() % $this->width;
		$y			= $this->prng->random() % $this->height;

		$frontiers	[]= [$x, $y, $x, $y];

		while(count($frontiers))
		{
			$index	= $this->prng->random() % count($frontiers);
			$f		= array_splice($frontiers, $index, 1)[0];

			$x		= $f[2];
			$y		= $f[3];

			if($this->_cells[$x][$y] == Maze::STATE_WALL)
			{
				$this->_cells[$f[0]][$f[1]] = $this->_cells[$x][$y] = Maze::STATE_PASSAGE;

				if($x >= 2 && $this->_cells[$x - 2][$y] == Maze::STATE_WALL)
					$frontiers []= [$x - 1, $y, $x - 2, $y];
				
				if($y >= 2 && $this->_cells[$x][$y - 2] == Maze::STATE_WALL)
					$frontiers []= [$x, $y - 1, $x, $y - 2];
				
				if($x < $this->width - 2 && $this->_cells[$x + 2][$y] == Maze::STATE_WALL)
					$frontiers []= [$x + 1, $y, $x + 2, $y];
				
				if($y < $this->height - 2 && $this->_cells[$x][$y + 2] == Maze::STATE_WALL)
					$frontiers []= [$x, $y + 1, $x, $y + 2];
			}
		}
	}

	public function ascii()
	{
		$str = str_repeat(Maze::STATE_WALL, $this->width + 2) . "\r\n";

		for($y = 0; $y < $this->height; $y++)
		{
			$str .= Maze::STATE_WALL;

			for($x = 0; $x < $this->width; $x++)
				$str .= $this->_cells[$x][$y];

			$str .= Maze::STATE_WALL . "\r\n";
		}

		$str .= str_repeat(Maze::STATE_WALL, $this->width + 2);

		return $str;
	}
}