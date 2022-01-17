<?php
namespace lib\app\plugin\action;


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
				case 'action':
					$tvalue = $value;
					switch ($value)
					{
						case 'activate_complete':
							$tvalue = T_("Activate Complete");
							break;

						default:

							break;
					}
					$result['taction'] = $tvalue;
					$result[$key] = $value;
					break;

				case 'status':
				case 'plugin_status':
				case 'addedby':
				case 'type':
					if($value)
					{
						$result['t'.$key] = T_(ucfirst($value));
					}
					$result[$key] = $value;
					break;

				case 'plugin':
					$result['plugin_title'] = \lib\app\plugin\get::title($value);
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