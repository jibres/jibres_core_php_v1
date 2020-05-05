<?php
namespace lib\app\website\body;

class config
{

	public static function line($_args)
	{
		$condition =
		[
			'config_line_key'      => 'md5',
			'config_line_type'      => ['enum' => array_column(\lib\app\website\body\line::list(), 'key')],
			'body_last_news_limit' => 'smallint',
		];

		$require   = ['config_line_key', 'config_line_type'];

		$meta      = [];
		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		$load_line = \lib\db\setting\get::platform_cat_key('website', 'lines', 'list');

		if(!isset($load_line['id']) || !isset($load_line['value']))
		{
			\dash\notif::error(T_("No body line founded in your website!"));
			return false;
		}

		$value = json_decode($load_line['value'], true);
		if(!is_array($value))
		{
			$value = [];
		}

		$find_key = false;

		foreach ($value as $my_key => $my_value)
		{
			if(isset($my_value['line_key']) && $my_value['line_key'] === $data['config_line_key'])
			{
				if(isset($my_value['type']) && $my_value['type'] === $data['config_line_type'])
				{
					$find_key = $my_key;
					break;
				}
			}
		}

		if($find_key === false)
		{
			\dash\notif::error(T_("Invalid line key and line type!"));
			return false;
		}

		$config = [];

		switch ($data['config_line_type'])
		{
			case 'body_last_news':
				$config = self::config_body_last_news($data);
				break;

			default:
				# code...
				break;
		}

		if(!\dash\engine\process::status())
		{
			return false;
		}

		if(isset($value[$find_key]) && is_array($value[$find_key]) && is_array($config))
		{
			$value[$find_key] = array_merge($value[$find_key], $config);
		}

		$new_value = json_encode($value, JSON_UNESCAPED_UNICODE);

		\lib\db\setting\update::value($new_value, $load_line['id']);

		\dash\notif::ok(T_("Your line was removed"));
		return true;
	}



	private static function config_body_last_news($_data)
	{
		if(intval($_data['body_last_news_limit']) > 50)
		{
			\dash\notif::error(T_("Maximum number for show news is 50"), 'body_last_news_limit');
			return false;
		}

		return ['limit' => $_data['body_last_news_limit']];
	}
}
?>