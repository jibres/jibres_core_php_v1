<?php
namespace lib\app\shaparak\terminal;


class ready
{

	// remove useless field to send to shaparak
	public static function for_shaparak($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'setupDate':
					if($value)
					{
						$result[$key] =  (string) strtotime($value). '000';
					}
					else
					{
						$result[$key] = null;
					}
					// $result[$key] = "1567410970000";
					break;

				case 'sequence':
				case 'terminalNumber':
				case 'terminalType':
				case 'serialNumber':
				case 'hardwareBrand':
				case 'hardwareModel':
				case 'accessAddress':
				case 'accessPort':
				case 'callbackAddress':
				case 'callbackPort':
					$result[$key] = $value;
					break;

				case 'Description':
				default:
					// nothing
					break;
			}
		}

		if(array_key_exists('accessPort', $result) && !$result['accessPort'])
		{
			$result['accessPort'] = '443';
		}


		if(array_key_exists('accessAddress', $result) && !$result['accessAddress'])
		{
			$result['accessAddress'] = 'jibres.com';
		}

		if(array_key_exists('callbackPort', $result) && !$result['callbackPort'])
		{
			$result['callbackPort'] = '443';
		}

		if(array_key_exists('callbackAddress', $result) && !$result['callbackAddress'])
		{
			$result['callbackAddress'] = 'jibres.com';
		}

		return $result;
	}

	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}




}
?>