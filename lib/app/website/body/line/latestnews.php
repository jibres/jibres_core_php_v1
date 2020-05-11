<?php
namespace lib\app\website\body\line;

class latestnews
{

	public static function get($_id)
	{
		$result = \lib\app\website\body\get::line_setting($_id);

		if(isset($result['type']) && $result['type'] === 'latestnews')
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("This is not a latest news"));
			return false;
		}

		if(isset($result['latestnews']) && is_array($result['latestnews']))
		{
			$result['latestnews'] = self::ready($result['latestnews']);
		}


		return $result;
	}


	public static function ready($_data)
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
				default:
					$result[$key] = isset($value) ? (string) $value : null;
					break;
			}
		}

		return $result;
	}



	public static function inline_get($_line_id, $_pretty = true)
	{
		if(!$_line_id || !is_numeric($_line_id))
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$saved_record = \lib\db\setting\get::lang_platform_cat_id(\dash\language::current(), 'website', 'homepage', $_line_id);

		if(!$saved_record)
		{
			\dash\notif::error(T_("Line detail not found"));
			return false;
		}

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


	private static function check_validate($_args)
	{
		$condition =
		[
			'limit'   => 'smallint',
		];

		$require   = [];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


	// add new latestnews
	public static function add($_args)
	{
		$data = self::check_validate($_args);

		if(!$data)
		{
			return false;
		}

		if(!$data['limit'])
		{
			\dash\notif::error(T_("Please set the limit"), 'limit');
			return false;
		}


		$line_id = \lib\app\website\body\add::line('latestnews');

		$saved_option = self::inline_get($line_id);

		$saved_option['latestnews'] =
		[
			'limit'    => $data['limit'],
		];


		$saved_option = json_encode($saved_option, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_option, $line_id);

		\dash\notif::ok(T_("Latest news added"));

		// retrun id to redirect to this latestnews
		return ['id' => \dash\coding::encode($line_id)];
	}

	public static function remove($_line_id, $_latestnews_index)
	{
		$line_id = \dash\validate::code($_line_id);
		$line_id = \dash\coding::decode($line_id);

		if(!$line_id)
		{
			return false;
		}
		if(!is_numeric($_latestnews_index))
		{
			\dash\notif::error(T_("Latest news index must be a number"));
			return false;
		}

		$saved_value = self::inline_get($line_id);

		if(!$saved_value || !isset($saved_value['latestnews']))
		{
			return false;
		}

		$saved_latestnews = $saved_value['latestnews'];


		if(!array_key_exists($_latestnews_index, $saved_latestnews))
		{
			\dash\notif::error(T_("Invalid latestnews index"));
			return false;
		}

		unset($saved_latestnews[$_latestnews_index]);

		$saved_latestnews = array_values($saved_latestnews);

		$saved_value['latestnews'] = $saved_latestnews;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Latest news was removed"));

		return true;
	}


	public static function edit($_args, $_line_id, $_latestnews_index = null)
	{

		$data      = self::check_validate($_args);

		if(!$data)
		{
			return false;
		}

		$line_option = \lib\app\website\body\template::get('latestnews');

		if(!isset($line_option['key']))
		{
			\dash\notif::error(T_("Line detail not found"));
			return false;
		}

		$line_id = \dash\validate::code($_line_id);
		$line_id = \dash\coding::decode($line_id);

		if(!$line_id)
		{
			return false;
		}

		$saved_value = self::inline_get($line_id);

		if(!$saved_value || !isset($saved_value['latestnews']))
		{
			return false;
		}

		$saved_latestnews = $saved_value['latestnews'];


		$ready_to_save =
		[
			'limit'    => $data['limit'],
		];


		$saved_latestnews = $ready_to_save;

		$saved_value['latestnews'] = $saved_latestnews;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Latest news added"));

		return true;
	}
}
?>