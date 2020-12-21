<?php
namespace lib\app\website;

class puzzle
{
	public static function input_check()
	{
		$list = [];
		for ($i=1; $i <= 10 ; $i++)
		{
			$list = array_merge($list, self::list($i));
		}

		$enum = ['enum' => array_keys($list)];

		return $enum;
	}


	public static function list($_limit)
	{
		$result = [];

		switch ($_limit)
		{
			case 1:
				$result['1']   = T_("1 item in one line");
				break;

			case 2:
				$result['2']   = T_("2 item in one line");
				break;

			case 3:
				$result['3']   = T_("3 item in one line");
				$result['1+2'] = T_("1 item in first line, 2 item in next line");
				break;

			case 4:
				$result['4']   = T_("4 item in one line");
				$result['2+2'] = T_("2 item per line");
				$result['1+3'] = T_("1 item in first line, 3 item in next line");
				break;

			case 5:
				$result['2+3'] = T_("2 item in first line, 3 item in next line");
				$result['1+4'] = T_("1 item in first line, 2 item in next line");
				break;

			case 6:
				$result['3+3']   = T_("3 item per line");
				$result['2+2+2'] = T_("2 item per line");
				$result['2+4']   = T_("2 item in first line, 4 item in next line");
				break;

			case 7:
				$result['1+3+3'] = T_("1 item in first line then 3 item per line");
				$result['2+2+3'] = T_("2 item in first two line, 3 item in next line");
				$result['1+2+4'] = T_("1 item in first then 2 item, then 4 item in next line");
				$result['3+4']   = T_("3 item in first line, 4 item in next line");
				break;

			case 8:
				$result['4+4']   = T_("4 item per line");
				$result['1+3+4'] = T_("1 item in first line then 3, then 4 item in next line");
				$result['2+2+4'] = T_("2 item in first two line, 4 item in next line");
				$result['2+3+3'] = T_("2 item in first line, then 3 item per line");
				break;

			case 9:
				$result['3+3+3'] = T_("3 item per line");
				$result['2+3+4'] = T_("2 item in first line then 3 item, then 4 item in next line");
				break;

			case 10:
				$result['1+3+3+3'] = T_("1 item in first line, then 3 item per line");
				$result['2+4+4']   = T_("2 item in first line, then 4 item per line");
				break;


			default:
				// nothing
				break;
		}

		return $result;
	}



	public static function layout($_index, $_line_detail)
	{
		$puzzle = a($_line_detail, 'value', 'puzzle');
		$limit = a($_line_detail, 'value', 'limit');
		if(!$limit || !is_numeric($limit))
		{
			$limit = 5;
		}

		$fc = null;
		$puzzle_list = self::list($limit);
		$default_puzzle = null;

		foreach ($puzzle_list as $key => $value) { $default_puzzle = $key;	break;}
		if(!$puzzle)
		{
			$puzzle = $default_puzzle;
		}
		else
		{
			if(isset($puzzle_list[$puzzle]))
			{
				// nothing
			}
			else
			{
				$puzzle = $default_puzzle;
			}
		}

		$level = 1;
		if(strpos($puzzle, '+') !== false)
		{
			$explode = explode('+', $puzzle);
			$myIndex = floatval($_index) + 1;
			$sum = 0;
			foreach ($explode as $tempLevel => $part_level)
			{
				$part_level = floatval($part_level);
				$sum += $part_level;
				if($myIndex <= $sum)
				{
					$level = $tempLevel + 1;
					break;
				}
			}
		}



		switch ($puzzle)
		{
			case '1':
				$fc = 'c-xs-12 c-sm-12';
				break;

			case '2':
				$fc = 'c-xs-12 c-sm-6';
				break;

			case '3':
				$fc = 'c-xs-12 c-sm-4';
				break;

			case '4':
				$fc = 'c-xs-12 c-sm-3';
				break;

			case '1+2':
				switch ($level)
				{
					case 1: $fc = 'c-xs-12 c-sm-3';	break;
					case 2:	$fc = 'c-xs-12 c-sm-6';	break;
				}
				break;

			case '2+2':
				$fc = 'c-xs-12 c-sm-6';
				break;

			case '1+3':
				switch ($level)
				{
					case 1: $fc = 'c-xs-12 c-sm-12'; break;
					case 2:	$fc = 'c-xs-12 c-sm-4';	break;
				}
				break;

			case '2+3':
				switch ($level)
				{
					case 1: $fc = 'c-xs-12 c-sm-6';	break;
					case 2: $fc = 'c-xs-12 c-sm-4';	break;
				}
				break;

			case '1+4':
				switch ($level)
				{
					case 1:	$fc = 'c-xs-12 c-sm-12'; break;
					case 2: $fc = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '3+3':
				$fc = 'c-xs-12 c-sm-4';
				break;

			case '2+2+2':
				$fc = 'c-xs-12 c-sm-6';
				break;

			case '2+4':
				switch ($level)
				{
					case 1:	$fc = 'c-xs-12 c-sm-6';	break;
					case 2:	$fc = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '1+3+3':
				switch ($level)
				{
					case 1: $fc = 'c-xs-12 c-sm-12'; break;
					case 2:	$fc = 'c-xs-12 c-sm-4';  break;
					case 3: $fc = 'c-xs-12 c-sm-4';  break;
				}
				break;

			case '2+2+3':
				switch ($level)
				{
					case 1:	$fc = 'c-xs-12 c-sm-6';	break;
					case 2:	$fc = 'c-xs-12 c-sm-6';	break;
					case 3:	$fc = 'c-xs-12 c-sm-4';	break;
				}
				break;

			case '1+2+4':
				switch ($level)
				{
					case 1: $fc = 'c-xs-12 c-sm-12'; break;
					case 2: $fc = 'c-xs-12 c-sm-6';	break;
					case 3:	$fc = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '3+4':
				switch ($level)
				{
					case 1:	$fc = 'c-xs-12 c-sm-4';	break;
					case 2:	$fc = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '4+4':
				$fc = 'c-xs-12 c-sm-3';
				break;

			case '1+3+4':
				switch ($level)
				{
					case 1:	$fc = 'c-xs-12 c-sm-12'; break;
					case 2: $fc = 'c-xs-12 c-sm-4';	break;
					case 3:	$fc = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '2+2+4':
				switch ($level)
				{
					case 1:	$fc = 'c-xs-12 c-sm-6';	break;
					case 2:	$fc = 'c-xs-12 c-sm-6';	break;
					case 3:	$fc = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '2+3+3':
				switch ($level)
				{
					case 1: $fc = 'c-xs-12 c-sm-6';	break;
					case 2:	$fc = 'c-xs-12 c-sm-4';	break;
					case 3:	$fc = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '3+3+3':
				$fc = 'c-xs-12 c-sm-4';
				break;

			case '2+3+4':

				switch ($level)
				{
					case 1:	$fc = 'c-xs-12 c-sm-6';	break;
					case 2: $fc = 'c-xs-12 c-sm-4';	break;
					case 3: $fc = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '1+3+3+3':
				switch ($level)
				{
					case 1:	$fc = 'c-xs-12 c-sm-12';break;
					case 2:
					case 3:
					case 4:
						$fc = 'c-xs-12 c-sm-4';
						break;
				}
				break;

			case '2+4+4':
				$fc = 'c-xs-12 c-sm-12';
				break;

			default:
				$fc = 'c-xs-12 c-sm-12';
				break;
		}

		if($fc)
		{
			return 'class="'. $fc. '" ';
		}


	}
}
?>