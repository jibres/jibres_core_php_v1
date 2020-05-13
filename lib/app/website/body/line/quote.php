<?php
namespace lib\app\website\body\line;

class quote
{

	public static function get($_id)
	{
		$result = \lib\app\website\body\get::line_setting($_id);

		if(isset($result['type']) && $result['type'] === 'quote')
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("This is not a latest news"));
			return false;
		}

		if(isset($result['quote']) && is_array($result['quote']))
		{
			$result['quote'] = self::ready($result['quote']);
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
			'quote'  => 'desc',
			'url'   => 'string_100',
			'title' => 'string_100',
		];

		$require   = [];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


	// add new quote
	public static function add($_args)
	{
		$data = self::check_validate($_args);

		if(!$data)
		{
			return false;
		}

		if(!$data['quote'])
		{
			\dash\notif::error(T_("Please set the quote"), 'quote');
			return false;
		}


		$line_id = \lib\app\website\body\add::line('quote');

		$saved_option = self::inline_get($line_id);

		$saved_option['quote'] =
		[
			'quote'  => $data['quote'],
			'url'   => $data['url'],
			'title' => $data['title'],
		];


		$saved_option = json_encode($saved_option, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_option, $line_id);

		\dash\notif::ok(T_("Latest news added"));

		// retrun id to redirect to this quote
		return ['id' => \dash\coding::encode($line_id)];
	}


	public static function remove($_line_id, $_quote_index)
	{
		$line_id = \dash\validate::code($_line_id);
		$line_id = \dash\coding::decode($line_id);

		if(!$line_id)
		{
			return false;
		}
		if(!is_numeric($_quote_index))
		{
			\dash\notif::error(T_("Latest news index must be a number"));
			return false;
		}

		$saved_value = self::inline_get($line_id);

		if(!$saved_value || !isset($saved_value['quote']))
		{
			return false;
		}

		$saved_quote = $saved_value['quote'];


		if(!array_key_exists($_quote_index, $saved_quote))
		{
			\dash\notif::error(T_("Invalid quote index"));
			return false;
		}

		unset($saved_quote[$_quote_index]);

		$saved_quote = array_values($saved_quote);

		$saved_value['quote'] = $saved_quote;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Latest news was removed"));

		return true;
	}


	public static function edit($_args, $_line_id, $_quote_index = null)
	{

		$data      = self::check_validate($_args);

		if(!$data)
		{
			return false;
		}

		$line_option = \lib\app\website\body\template::get('quote');

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

		if(!$saved_value || !isset($saved_value['quote']))
		{
			return false;
		}

		$saved_quote = $saved_value['quote'];


		$ready_to_save =
		[
			'quote'  => $data['quote'],
			'url'   => $data['url'],
			'title' => $data['title'],
		];


		$saved_quote = $ready_to_save;

		$saved_value['quote'] = $saved_quote;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Latest news added"));

		return true;
	}
}
?>