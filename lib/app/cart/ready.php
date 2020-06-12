<?php
namespace lib\app\cart;


class ready
{
	public static function row($_data)
	{
		if(!is_array($_data))
		{
			return false;
		}

		$_data = \dash\app::fix_avatar($_data);

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'user_id':
					$result[$key] = \dash\coding::encode($value);
					break;



				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


}
?>