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
				case 'id':
					$result[$key] = $value;

					break;
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

		if(isset($result['parent4']))
		{
			$result['last_parent'] = $result['parent4'];
		}
		elseif(isset($result['parent3']))
		{
			$result['last_parent'] = $result['parent3'];
		}
		elseif(isset($result['parent2']))
		{
			$result['last_parent'] = $result['parent2'];
		}
		elseif(isset($result['parent1']))
		{
			$result['last_parent'] = $result['parent1'];
		}

		return $result;
	}

}
?>