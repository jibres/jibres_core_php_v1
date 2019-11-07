<?php
namespace lib\app\customer;


class ready
{

	public static function row($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
				case 'store_id':
				case 'user_id':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'file':
					$result[$key] = $value;
					if(is_string($value))
					{
						$result['file_array'] = json_decode($value, true);
					}
					break;

				case 'gender':
					$result[$key] = $value;

					if($value === 'male')
					{
						$result['genderString'] = T_('Mr');
					}
					elseif($value === 'female')
					{
						$result['genderString'] = T_('Mrs');
					}
					break;

				case 'desc':
					if(is_string($value) && $value && substr($value, 0, 1) === '{')
					{
						$temp = json_decode($value, true);
						$result = array_merge($temp, $result);
					}

					$result[$key] = $value;
					break;

				case 'avatar':
					// $result['avatar'] = $value ? \lib\filepath::fix($value) : \dash\app::static_avatar_url();
					$result['avatar_raw'] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}
		// var_dump($result);exit();
		return $result;
	}

}
?>
