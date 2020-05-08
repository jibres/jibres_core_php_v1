<?php
namespace lib\app\nic_credit;


class ready
{

	public static function row($_data, $_option = [])
	{

		$result = [];

		if(!is_array($_data))
		{
			return null;
		}

		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;


				case 'amount':
				case 'balance':
					$result[$key] = floatval($value) / 100;
					break;

				default:
					$result[$key] = isset($value) ? (string) $value : null;
					break;
			}
		}

		return $result;
	}

}
?>