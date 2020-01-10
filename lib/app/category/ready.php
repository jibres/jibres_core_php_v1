<?php
namespace lib\app\category;


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
				// case 'id':
				// 	$result[$key] = \dash\coding::encode($value);
				// 	break;
				case 'file':
					$result[$key] = \lib\filepath::fix($value);;

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