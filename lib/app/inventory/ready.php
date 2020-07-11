<?php
namespace lib\app\inventory;


class ready
{
	public static function row($_data)
	{

		if(!is_array($_data))
		{
			return false;
		}

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
					$result[$key] = $value;
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