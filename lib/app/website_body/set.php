<?php
namespace lib\app\website_body;

class set
{

	public static function add_line($_args)
	{
		$condition =
		[
			'line' => ['enum' => array_column(\lib\app\website_body\line::list(), 'key')],
		];

		$require   = ['line'];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		$load_line = \lib\db\setting\get::platform_cat_key('website', 'lines', 'list');

		if(!isset($load_line['id']) || !isset($load_line['value']))
		{
			$value  = [$_args['line']];
			$value  = json_encode($value, JSON_UNESCAPED_UNICODE);
			$insert =
			[
				'platform' => 'website',
				'cat'      => 'lines',
				'key'      => 'list',
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

			$value[] = $_args['line'];
			$new_value = json_encode($value, JSON_UNESCAPED_UNICODE);
			\lib\db\setting\update::value($new_value, $load_line['id']);
		}

		\dash\notif::ok(T_("Your line was saved"));
		return true;
	}


	public static function remove_line($_args)
	{
		$condition =
		[
			'linekey'  => 'smallint',
			'linetype' => ['enum' => array_column(\lib\app\website_body\line::list(), 'key')],
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

			if(isset($value[$data['linekey']]) && $value[$data['linekey']] === $data['linetype'])
			{
				unset($value[$data['linekey']]);
			}
			else
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
}
?>