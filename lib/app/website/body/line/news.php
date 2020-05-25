<?php
namespace lib\app\website\body\line;

class news
{

	public static function suggest_new_name()
	{
		$count_news = \lib\db\setting\get::count_lang_platform_cat_key(\dash\language::current(), 'website', 'homepage', 'body_line_news');
		$count_news = intval($count_news) + 1;

		return T_("News"). ' '. \dash\fit::number($count_news);
	}


	public static function get($_id)
	{
		$result = \lib\app\website\body\get::line_setting($_id);

		if(isset($result['type']) && $result['type'] === 'news')
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("This is not a latest news"));
			return false;
		}

		if(isset($result['news']) && is_array($result['news']))
		{
			$result['news'] = self::ready($result['news']);
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
			'title'   => 'string_200',
			'cat_id'  => 'code',
			'publish' => 'bit'
		];

		$require   = [];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


	// add new news
	public static function add($_args)
	{
		$data = self::check_validate($_args);

		if(!$data)
		{
			return false;
		}


		$line_id = \lib\app\website\body\add::line('news', ['title' => $data['title'], 'publish' => $data['publish']]);

		if(!$line_id)
		{
			\dash\log::oops('error:line');
			return false;
		}

		$saved_option = self::inline_get($line_id);

		$saved_option['news'] =
		[
			'cat_id' => $data['cat_id'],
		];


		$saved_option = json_encode($saved_option, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_option, $line_id);

		\dash\notif::ok(T_("News line added"));

		// retrun id to redirect to this news
		return ['id' => \dash\coding::encode($line_id)];
	}



	public static function edit($_args, $_line_id)
	{

		$data      = self::check_validate($_args);

		if(!$data)
		{
			return false;
		}


		$line_option = \lib\app\website\body\template::get('news');

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

		if(!$saved_value || !isset($saved_value['news']))
		{
			return false;
		}

		$saved_value['title']   = $data['title'];
		$saved_value['publish'] = $data['publish'];

		$saved_news = $saved_value['news'];


		$ready_to_save =
		[
			'cat_id' => $data['cat_id'],
		];


		$saved_news = $ready_to_save;

		$saved_value['news'] = $saved_news;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("News line edited"));

		return true;
	}
}
?>