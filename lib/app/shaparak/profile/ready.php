<?php
namespace lib\app\shaparak\profile;


class ready
{
	public static function row($_data)
	{
		$result = [];

		if(!is_array($_data))
		{
			$_data = [];
		}

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'nationalpic':
				case 'shpic':
					$result[$key] = \lib\filepath::fix($value);
					break;

				case 'user_id':
					$result['user_id_raw'] = $value;
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