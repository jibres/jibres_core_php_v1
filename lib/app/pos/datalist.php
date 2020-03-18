<?php
namespace lib\app\pos;


class datalist
{
	public static function list()
	{
		$pos = \lib\db\pos\get::all();

		if(is_array($pos))
		{
			$pos = array_map(['self', 'ready'], $pos);
		}

		return $pos;
	}


	private static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'setting':
					if($value)
					{
						$setting = json_decode($value, true);
						$result[$key] = $setting;
					}
					else
					{
						$result[$key] = null;
					}

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