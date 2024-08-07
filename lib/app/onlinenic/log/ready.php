<?php
namespace lib\app\onlinenic\log;


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
				case 'ip':
					if($value)
					{
						$result[$key] = long2ip($value);
					}
					else
					{
						$result[$key] = null;
					}
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