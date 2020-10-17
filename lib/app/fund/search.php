<?php
namespace lib\app\fund;


class search
{

	public static function all_list()
	{
		$result = \lib\db\funds\get::all();

		if(!is_array($result))
		{
			$result = [];
		}

		$temp            = [];

		foreach ($result as $key => $value)
		{
			$check = \lib\app\fund\ready::row($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}


	public static function list($_string = null, $_args = [])
	{
		if($_string)
		{
			$_string = \dash\validate::search($_string, false);
		}

		unset($_args['sort']);
		unset($_args['order']);

		$_string = \dash\validate::search($_string);

		$result = \lib\db\funds\get::list($_string, $_args);

		$temp            = [];


		foreach ($result as $key => $value)
		{
			$check = \lib\app\fund\ready::row($value);
			if($check)
			{
				$temp[] = $check;
			}
		}
		// j($temp);
		return $temp;
	}




}
?>