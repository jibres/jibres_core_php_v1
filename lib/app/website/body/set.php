<?php
namespace lib\app\website\body;

class set
{

	public static function add_line($_args)
	{
		$condition =
		[
			'line' => ['enum' => array_column(\lib\app\website\body\line::list(), 'key')],
		];

		$require   = ['line'];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		$load_line = \lib\db\setting\get::platform_cat_key('website', 'body', 'sort_list');

		$line_rand_key = microtime();
		$line_rand_key .= rand(1,9999);
		$line_rand_key .= rand(1,9999);
		$line_rand_key .= $data['line'];
		$line_rand_key = md5($line_rand_key);

		$new_value =
		[
			'type'     => $data['line'],
			'line_key' => $line_rand_key,
			'sort'     => null,
			'title'    => null,
			'publish'  => 1,
		];


		if(!isset($load_line['id']) || !isset($load_line['value']))
		{
			$value   = [];
			$value[] = $new_value;
			$value   = json_encode($value, JSON_UNESCAPED_UNICODE);
			$insert =
			[
				'platform' => 'website',
				'cat'      => 'body',
				'key'      => 'sort_list',
				'value'    => $value,
			];
			\lib\db\setting\insert::new_record($insert);
		}
		else
		{
			$value = json_decode($load_line['value'], true);
			if(!is_array($value))
			{
				$value = [];
			}

			$value[] = $new_value;
			$value = json_encode($value, JSON_UNESCAPED_UNICODE);
			\lib\db\setting\update::value($value, $load_line['id']);
		}

		\dash\notif::ok(T_("Your line was saved"));
		return true;
	}


	public static function remove_line($_args)
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

		\dash\notif::ok(T_("Your line was removed"));
		return true;
	}


	public static function edit($_args, $_line_key)
	{
		$condition =
		[
			'title'   => 'string_200',
			'sort'    => 'smallint',
			'publish' => 'bit',
		];

		$require   = [];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		$line_list = \lib\app\website\body\get::line_list(true);

		$founded_line = null;
		$founded_line_key = null;

		if(is_array($line_list))
		{
			foreach ($line_list as $key => $value)
			{
				if(isset($value['line_key']) && $value['line_key'] === $_line_key)
				{
					$founded_line_key = $key;
					$founded_line = $value;
					break;
				}
			}
		}

		if(!$founded_line)
		{
			\dash\notif::error(T_("Invalid body line key"));
			return false;
		}

		$edit            = $founded_line;
		$edit['title']   = $data['title'];
		$edit['sort']    = $data['sort'];
		$edit['publish'] = $data['publish'];

		$line_list[$founded_line_key] = $edit;

		$new_linse = json_encode($line_list, JSON_UNESCAPED_UNICODE);

		\lib\db\setting\update::overwirte_platform_cat_key($new_linse, 'website', 'body', 'sort_list');

		\dash\notif::ok(T_("Setting Saved"));
	}
}
?>