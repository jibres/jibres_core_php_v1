<?php
namespace lib\app\website\body\line;

class text
{

	public static function suggest_new_name()
	{
		$count_text = \lib\db\setting\get::count_platform_cat_key('website', 'homepage', 'body_line_text');
		$count_text = intval($count_text) + 1;

		return T_("Text"). ' '. \dash\fit::number($count_text);
	}


	public static function get($_id)
	{
		$result = \lib\app\website\body\get::line_setting($_id);

		if(isset($result['type']) && $result['type'] === 'text')
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("This is not a latest news"));
			return false;
		}

		if(isset($result['text']) && is_array($result['text']))
		{
			$result['text'] = self::ready($result['text']);
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
					$result[$key] = $value;
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

		$saved_record = \lib\db\setting\get::platform_cat_id('website', 'homepage', $_line_id);

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
			'text'    => 'real_html',
			'title'   => 'string_200',
			'publish' => 'bit'
		];

		$require   = [];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


	// add new text
	public static function add($_args)
	{
		$data = self::check_validate($_args);

		if(!$data)
		{
			return false;
		}

		if(!$data['text'])
		{
			\dash\notif::error(T_("Please set the text"), 'text');
			return false;
		}


		$line_id = \lib\app\website\body\add::line('text', ['title' => $data['title'], 'publish' => $data['publish']]);

		if(!$line_id)
		{
			\dash\log::oops('error:line');
			return false;
		}

		$saved_option = self::inline_get($line_id);

		$saved_option['text'] =
		[
			'text'    => $data['text'],
		];


		$saved_option = json_encode($saved_option, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::bind_value($saved_option, $line_id);

		\dash\notif::ok(T_("Text added"));

		// retrun id to redirect to this text
		return ['id' => \dash\coding::encode($line_id)];
	}



	public static function edit($_args, $_line_id)
	{

		$data      = self::check_validate($_args);

		if(!$data)
		{
			return false;
		}

		$line_option = \lib\app\website\body\template::get('text');

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

		if(!$saved_value || !isset($saved_value['text']))
		{
			return false;
		}

		$saved_value['title']   = $data['title'];
		$saved_value['publish'] = $data['publish'];

		$saved_text = $saved_value['text'];


		$ready_to_save =
		[
			'text'    => $data['text'],
		];


		$saved_text = $ready_to_save;

		$saved_value['text'] = $saved_text;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::bind_value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Text edited"));

		return true;
	}
}
?>