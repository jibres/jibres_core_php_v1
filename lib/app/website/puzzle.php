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
				$result['1+2+4'] = T_("1 item in first then 2 item, then 3 item in next line");
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
}
?>