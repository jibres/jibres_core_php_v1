<?php
namespace lib\app\staff;


trait datalist
{
	public static function list($_string = null, $_options = [])
	{
		$_options['store_id'] = \lib\store::id();

		$list = \lib\db\userstores::search($_string, $_options);
		$temp = [];
		if(is_array($list))
		{
			foreach ($list as $key => $value)
			{
				$a = self::ready($value);
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