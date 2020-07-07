<?php
namespace lib\app\irvat;


class search
{

	public static function all_list()
	{
		$result = \lib\db\irvats\get::all();

		if(!is_array($result))
		{
			$result = [];
		}

		$temp            = [];

		foreach ($result as $key => $value)
		{
			$check = \lib\app\irvat\ready::row($value);
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
			$_string = \dash\safe::forQueryString($_string);
			if(mb_strlen($_string) > 50)
			{
				$_string = null;
			}
		}

		unset($_args['sort']);
		unset($_args['order']);

		$_string = \dash\validate::search($_string);

		$result = \lib\db\irvats\get::list($_string, $_args);

		$temp            = [];


		foreach ($result as $key => $value)
		{
			$check = \lib\app\irvat\ready::row($value);
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