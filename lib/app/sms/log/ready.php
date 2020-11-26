<?php
namespace lib\app\sms\log;


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

				 // case 'mobiles':
				 // case 'response':
				 // case 'send':
				 // 	if(is_string($value) && $value)
				 // 	{
					// 	$result[$key] = json_encode(json_decode($value, true), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
				 // 	}
				 // 	else
				 // 	{
					// 	$result[$key] = $value;
				 // 	}

				 // break;



				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}
}
?>