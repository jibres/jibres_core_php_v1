<?php
namespace lib\app\gift\lookup;


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