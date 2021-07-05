<?php
namespace content_site\color;


class color
{
	public static function list()
	{
		$enum = [];


		$enum[] = ['color' => 'transparent'];
		$enum[] = ['color' => 'current'];

		$enum[] = ['color' => 'black'];
		$enum[] = ['color' => 'white'];

		foreach (self::color_name() as $name)
		{
			foreach (self::color_opacity() as $level)
			{
				$enum[] = ['color' => $name. '-'. $level];
			}
		}

		return $enum;
	}


	public static function color_name()
	{
		$names =
		[
			'gray',
			'red',
			'yellow',
			'green',
			'blue',
			'indigo',
			'purple',
			'pink',
		];
		return $names;
	}


	public static function color_opacity()
	{
		$levels =
		[
			'50',
			'100',
			'200',
			'300',
			'400',
			'500',
			'600',
			'700',
			'800',
			'900',
		];

		return $levels;
	}
}
?>