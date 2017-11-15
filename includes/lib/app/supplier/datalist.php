<?php
namespace lib\app\supplier;


trait datalist
{
	public static function list($_string = null, $_options = [])
	{
		$list = \lib\db\userstores::search($_string, $_options);
		$temp = [];
		if(is_array($list))
		{
			foreach ($list as $key => $value)
			{
				$a = \lib\app\user::ready($value);
				if($a)
				{
					$temp[] = $a;
				}
			}
		}

		return $temp;
	}
}
?>