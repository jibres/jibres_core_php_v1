<?php
namespace lib\app\tax\year;


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
				case 'vatsetting':
					$vatsetting = [];

					if(is_string($value) && $value)
					{
						$vatsetting = json_decode($value, true);
					}

					if(!is_array($vatsetting))
					{
						$vatsetting = [];
					}

					$result['vatsetting'] = $vatsetting;
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