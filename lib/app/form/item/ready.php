<?php
namespace lib\app\form\item;


class ready
{

	public static function row($_data)
	{
		if(!is_array($_data))
		{
			$_data = [];
		}

		$result     = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'type':
					$result[$key] = $value;
					$result['type_detail'] = \lib\app\form\item\type::get($value);
					break;

				case 'setting':
				case 'choice':
					if($value && is_string($value))
					{
						$value = json_decode($value, true);
					}

					if(!is_array($value))
					{
						$value = [];
					}

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