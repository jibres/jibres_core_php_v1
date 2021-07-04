<?php
namespace content_site\color;


class color
{
	public static function list()
	{

		$names =
		[
			// 'coolGray',
			'red',
			// 'amber',
			// 'emerald',
			'blue',
			'indigo',
			// 'violet',
			'pink',

			// 'blueGray',
			// 'gray',
			// 'trueGray',
			// 'warmGray',
			// 'orange',
			'yellow',
			// 'lime',
			'green',
			// 'teal',
			// 'cyan',
			// 'sky',
			// 'purple',
			// 'fuchsia',
			// 'rose',
		];

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

		$enum = [];

		$enum[] = ['color' => 'black'];
		$enum[] = ['color' => 'white'];

		foreach ($names as $name)
		{
			foreach ($levels as $level)
			{
				$enum[] = ['color' => $name. '-'. $level];
			}
		}

		// var_dump($enum);


		return $enum;
	}
}
?>