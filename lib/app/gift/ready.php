<?php
namespace lib\app\gift;


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
				case 'id':
				case 'creator':
					$result[$key] = \dash\coding::encode($value);
					break;

				case 'dedicated':
					$result[$key] = $value;
					if($value)
					{
						$result['dedicated_string'] = implode("\n", json_decode($value, true));
					}
					break;

				case 'dateexpire':
					if($value)
					{
						$result[$key] = \dash\fit::date($value);
					}
					$result['dateexpire_raw'] = \dash\utility\convert::to_en_number(\dash\fit::date($value));

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