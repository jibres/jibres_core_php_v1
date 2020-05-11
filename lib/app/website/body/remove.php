<?php
namespace lib\app\website\body;

class remove
{


	public static function line($_line_id)
	{
		$condition =
		[
			'linekey'  => 'md5',
			'linetype' => ['enum' => array_column(\lib\app\website\body\line::list(), 'key')],
		];

		$require   = ['linekey', 'linetype'];

		$meta      = [];
		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);


		$load_line = \lib\db\setting\get::platform_cat_key('website', 'lines', 'list');

		if(!isset($load_line['id']) || !isset($load_line['value']))
		{
			\dash\notif::error(T_("No body line founded in your website!"));
			return false;
		}
		else
		{
			$value = json_decode($load_line['value'], true);
			if(!is_array($value))
			{
				$value = [];
			}

			$find = false;
			foreach ($value as $my_key => $my_value)
			{
				if(isset($my_value['line_key']) && $my_value['line_key'] === $data['linekey'])
				{
					if(isset($my_value['type']) && $my_value['type'] === $data['linetype'])
					{
						unset($value[$my_key]);
						$find = true;
						break;
					}
				}
			}

			if(!$find)
			{
				\dash\notif::error(T_("Invalid line key and line type!"));
				return false;
			}

			$new_value = json_encode($value, JSON_UNESCAPED_UNICODE);
			\lib\db\setting\update::value($new_value, $load_line['id']);
		}

		\lib\app\website\generator::remove_catch();


		\dash\notif::ok(T_("Your line was removed"));
		return true;
	}


}
?>