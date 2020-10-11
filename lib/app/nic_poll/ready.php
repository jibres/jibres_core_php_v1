<?php
namespace lib\app\nic_poll;


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
				case 'detail':
					$result[$key] = $value;
					if($value && is_string($value))
					{
						$result['detail_pretty'] = json_encode(json_decode($value, true), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
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