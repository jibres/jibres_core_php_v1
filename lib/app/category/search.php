<?php
namespace lib\app\category;


class search
{

	public static function list($_string = null, $_args = [])
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if($_string)
		{
			$_string = \dash\safe::forQueryString($_string);
			if(mb_strlen($_string) > 50)
			{
				$_string = null;
			}
		}


		$result = \lib\db\productcategory\get::list($_string);

		$temp            = [];


		foreach ($result as $key => $value)
		{
			$check = \lib\app\category\ready::row($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}




}
?>