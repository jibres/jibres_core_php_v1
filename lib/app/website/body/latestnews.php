<?php
namespace lib\app\website\body;

class latestnews
{

	public static function get($_line_key, $_pretty = true)
	{
		$line_option = \lib\app\website\body\get::line_option($_line_key);

		if(!isset($line_option['key']))
		{
			\dash\notif::error(T_("Line detail not found"));
			return false;
		}

		$saved_record = \lib\db\setting\get::platform_cat_key('website', 'body_line_option', $_line_key);

		$saved_option = [];

		if(isset($saved_record['value']))
		{
			$saved_option = json_decode($saved_record['value'], true);
		}

		if(!is_array($saved_option))
		{
			$saved_option = [];
		}


		return $saved_option;
	}


	public static function set($_args, $_line_key)
	{
		$condition =
		[
			'limit'    => 'smallint',
		];

		$require   = [];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		$line_option = \lib\app\website\body\get::line_option($_line_key);

		if(!isset($line_option['key']))
		{
			\dash\notif::error(T_("Line detail not found"));
			return false;
		}

		$saved_option = self::get($_line_key, false);


		if(!$data['limit'])
		{
			\dash\notif::error(T_("Please set show limit"), 'limit');
			return false;
		}

		$saved_option =
		[
			'limit'    => $data['limit'],
		];


		$saved_option = json_encode($saved_option, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::overwirte_platform_cat_key($saved_option, 'website', 'body_line_option', $_line_key);

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Limit of show latest news set"));


		return true;
	}
}
?>