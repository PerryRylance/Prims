# Prims
Prims algorithm and maze generator

## Installation
`composer require perry-rylance/prims`

## Usage
First construct a Maze, specifying width, height and seed (optional).

`$maze = new Maze(15, 15, 123);`

Now call

`$maze->generate();`

Now you can access the multidimensional array of cells via

`$maze->cells;`

## Recommendations
- Odd dimensions work best (otherwise you may have a 2-cell border on one or more sides)
- Please note the generated maze does not have outer walls