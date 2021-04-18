<?php
namespace lib\pagebuilder\body\puzzle;


class puzzle
{

	public static function input_condition($input_condition)
	{
		$list = [];
		for ($i=1; $i <= 10 ; $i++)
		{
			$list = array_merge($list, self::list($i));
		}

		$enum = ['enum' => array_keys($list)];

		$input_condition['puzzle']      = $enum;
		$input_condition['set_limit']   = 'bit';
		$input_condition['set_puzzle']  = 'bit';
		$input_condition['puzzle_type'] = ['enum' => ['puzzle', 'slider']];
		$input_condition['slider_type'] = ['enum' => ['simple', 'special']];
		$input_condition['limit']       = 'int';


		return $input_condition;
	}


	public static function ready_for_save_db($_data, $_saved_detail = [])
	{

		$puzzle = [];

		if(!is_array($_data))
		{
			return $_data;
		}

		if(array_key_exists('puzzle', $_data))
		{
			$puzzle['code'] = $_data['puzzle'];
			unset($_data['puzzle']);
		}

		if(a($_saved_detail, 'puzzle', 'code') && !a($puzzle, 'code'))
		{
			$puzzle['code'] = a($_saved_detail, 'puzzle', 'code');
		}


		if(array_key_exists('puzzle_type', $_data))
		{
			$puzzle['puzzle_type'] = $_data['puzzle_type'];
			unset($_data['puzzle_type']);
		}

		if(a($_saved_detail, 'puzzle', 'puzzle_type') && !a($puzzle, 'puzzle_type'))
		{
			$puzzle['puzzle_type'] = a($_saved_detail, 'puzzle', 'puzzle_type');
		}


		if(array_key_exists('slider_type', $_data))
		{
			$puzzle['slider_type'] = $_data['slider_type'];
			unset($_data['slider_type']);
		}

		if(a($_saved_detail, 'puzzle', 'slider_type') && !a($puzzle, 'slider_type'))
		{
			$puzzle['slider_type'] = a($_saved_detail, 'puzzle', 'slider_type');
		}

		if(array_key_exists('limit', $_data))
		{
			$puzzle['limit'] = $_data['limit'];
			unset($_data['limit']);
		}

		if(a($_saved_detail, 'puzzle', 'limit') && !a($puzzle, 'limit'))
		{
			$puzzle['limit'] = a($_saved_detail, 'puzzle', 'limit');
		}
		else
		{
			\lib\pagebuilder\tools\tools::need_redirect(\dash\url::pwd());
		}

		if(!empty($puzzle))
		{
			$puzzle = json_encode($puzzle, JSON_UNESCAPED_UNICODE);

			$_data['puzzle'] = $puzzle;

			\lib\pagebuilder\tools\tools::input_exception('puzzle');


		}
		else
		{
			$_data['puzzle'] = null;
		}

		unset($_data['set_limit']);
		unset($_data['set_puzzle']);
		unset($_data['puzzle_type']);
		unset($_data['slider_type']);

		return $_data;

	}


	public static function ready($_data)
	{
		$default = [];
		$puzzle  = [];

		$default['puzzle_type'] = 'puzzle';


		if(isset($_data['key']) && $_data['key'] && is_string($_data['key']))
		{
			$default_value = \lib\pagebuilder\tools\tools::call_fn('body', $_data['key'], 'default_value');
			if(isset($default_value['puzzle']) && is_array($default_value['puzzle']))
			{
				$default = array_merge($default, $default_value['puzzle']);
			}
		}

		if(isset($_data['puzzle']) && is_string($_data['puzzle']))
		{
			$puzzle = json_decode($_data['puzzle'], true);

			if(!is_array($puzzle))
			{
				$puzzle = []; // the default value
			}

		}
		$_data['puzzle'] = array_merge($default, $puzzle);

		return $_data;
	}



	public static function default_list()
	{
		// default list if no limit selected
		return self::list(8);
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
		$puzzle    = a($_line_detail, 'puzzle');
		$limit     = a($_line_detail, 'limit');
		$play_item = a($_line_detail, 'play_item');

		if(!$limit || !is_numeric($limit))
		{
			$limit = 5;
		}

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


		$class = null;
		$playMode = null;

		switch ($puzzle)
		{
			case '1':
				$class = 'c-xs-12 c-sm-12';
				break;

			case '2':
				$class = 'c-xs-12 c-sm-6';
				break;

			case '3':
				$class = 'c-xs-12 c-sm-4';
				break;

			case '4':
				$class = 'c-xs-12 c-sm-3';
				break;

			case '1+2':
				switch ($level)
				{
					case 1: $class = 'c-xs-12 c-sm-12'; break;
					case 2:	$class = 'c-xs-12 c-sm-6';	break;
				}
				break;

			case '2+2':
				$class = 'c-xs-12 c-sm-6';
				break;

			case '1+3':
				switch ($level)
				{
					case 1: $class = 'c-xs-12 c-sm-12'; break;
					case 2:	$class = 'c-xs-12 c-sm-4';	break;
				}
				break;

			case '2+3':
				switch ($level)
				{
					case 1: $class = 'c-xs-12 c-sm-6';	break;
					case 2: $class = 'c-xs-12 c-sm-4';	break;
				}
				break;

			case '1+4':
				switch ($level)
				{
					case 1:	$class = 'c-xs-12 c-sm-12'; break;
					case 2: $class = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '3+3':
				$class = 'c-xs-12 c-sm-4';
				break;

			case '2+2+2':
				$class = 'c-xs-12 c-sm-6';
				break;

			case '2+4':
				switch ($level)
				{
					case 1:	$class = 'c-xs-12 c-sm-6';	break;
					case 2:	$class = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '1+3+3':
				switch ($level)
				{
					case 1: $class = 'c-xs-12 c-sm-12'; break;
					case 2:	$class = 'c-xs-12 c-sm-4';  break;
					case 3: $class = 'c-xs-12 c-sm-4';  break;
				}
				break;

			case '2+2+3':
				switch ($level)
				{
					case 1:	$class = 'c-xs-12 c-sm-6';	break;
					case 2:	$class = 'c-xs-12 c-sm-6';	break;
					case 3:	$class = 'c-xs-12 c-sm-4';	break;
				}
				break;

			case '1+2+4':
				switch ($level)
				{
					case 1: $class = 'c-xs-12 c-sm-12'; break;
					case 2: $class = 'c-xs-12 c-sm-6';	break;
					case 3:	$class = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '3+4':
				switch ($level)
				{
					case 1:	$class = 'c-xs-12 c-sm-4';	break;
					case 2:	$class = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '4+4':
				$class = 'c-xs-12 c-sm-3';
				break;

			case '1+3+4':
				switch ($level)
				{
					case 1:	$class = 'c-xs-12 c-sm-12'; break;
					case 2: $class = 'c-xs-12 c-sm-4';	break;
					case 3:	$class = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '2+2+4':
				switch ($level)
				{
					case 1:	$class = 'c-xs-12 c-sm-6';	break;
					case 2:	$class = 'c-xs-12 c-sm-6';	break;
					case 3:	$class = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '2+3+3':
				switch ($level)
				{
					case 1: $class = 'c-xs-12 c-sm-6';	break;
					case 2:	$class = 'c-xs-12 c-sm-4';	break;
					case 3:	$class = 'c-xs-12 c-sm-4';	break;
				}
				break;

			case '3+3+3':
				$class = 'c-xs-12 c-sm-4';
				break;

			case '2+3+4':
				switch ($level)
				{
					case 1:	$class = 'c-xs-12 c-sm-6';	break;
					case 2: $class = 'c-xs-12 c-sm-4';	break;
					case 3: $class = 'c-xs-12 c-sm-3';	break;
				}
				break;

			case '1+3+3+3':
				switch ($level)
				{
					case 1:	$class = 'c-xs-12 c-sm-12';break;
					case 2:
					case 3:
					case 4:
						$class = 'c-xs-12 c-sm-4';
						break;
				}
				break;

			case '2+4+4':
			switch ($level)
				{
					case 1:	$class = 'c-xs-12 c-sm-6';break;
					case 2: $class = 'c-xs-12 c-sm-3'; break;
					case 3: $class = 'c-xs-12 c-sm-3';	break;
				}
				break;

			default:
				$class = 'c-xs-12 c-sm-12';
				break;
		}


		if($level === 1 && $play_item === 'first')
		{
			$playMode = 'video';
		}

		$result =
		[
			'class'    => $class,
			'playMode' => $playMode,
		];

		return $result;
	}
}
?>