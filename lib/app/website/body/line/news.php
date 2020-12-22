<?php
namespace lib\app\website\body\line;

class news
{

	public static function suggest_new_name()
	{
		$count_news = \lib\db\setting\get::count_platform_cat_key('website', 'homepage', 'body_line_news');
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

		if(isset($saved_option['type']) && $saved_option['type'] === 'news')
		{
			// nothing
		}
		else
		{
			\dash\notif::error(T_("Invalid line id"));
			return false;
		}

		return $saved_option;
	}


	private static function check_validate($_args, $_current_data)
	{
		$condition =
		[
			'title'             => 'string_200',
			'puzzle'            => \lib\app\website\puzzle::input_check(),
			'subtype'           => ['enum' => ['standard', 'gallery', 'video', 'audio']],
			'design'            => ['enum' => ['untitled_only_image','title_on_image','title_below_image','titel_beside_image','title_beside_image_description','blog']],
			'cat_id'            => 'code',
			'tag_id'            => 'code',
			'publish'           => 'bit',
			'limit'             => 'tinyint',
			'first_line_count'  => ['enum' => [1, 2, 3]],
			'second_line_count' => ['enum' => [1, 2, 3, 4]],
			'play_item'         => ['enum' => ['none', 'first', 'all']],
			'more_link'         => ['enum' => ['show', 'hide']],
			'show_title'        => 'yes_no',
			'more_link_caption' => 'string_50',
		];

		$require   = [];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		$result         = [];

		$result['type'] = 'news';

		if(array_key_exists('title', $_args))
		{
			$result['title'] = $data['title'];
		}
		else
		{
			$result['title'] = a($_current_data, 'title');
		}

		if(array_key_exists('publish', $_args))
		{
			$result['publish'] = $data['publish'];
		}
		else
		{
			$result['publish'] = a($_current_data, 'publish');
		}

		if(array_key_exists('show_title', $_args))
		{
			$result['show_title'] = $data['show_title'];
		}
		else
		{
			$result['show_title'] = a($_current_data, 'show_title');
		}

		if(array_key_exists('play_item', $_args))
		{
			$result['play_item'] = $data['play_item'];
		}
		else
		{
			$result['play_item'] = a($_current_data, 'play_item');
		}

		if(array_key_exists('limit', $_args))
		{
			$result['limit'] = $data['limit'];
		}
		else
		{
			$result['limit'] = a($_current_data, 'limit');
		}

		if(array_key_exists('puzzle', $_args))
		{
			$result['puzzle'] = $data['puzzle'];
		}
		else
		{
			$result['puzzle'] = a($_current_data, 'puzzle');
		}


		if(array_key_exists('design', $_args))
		{
			$result['design'] = $data['design'];
		}
		else
		{
			$result['design'] = a($_current_data, 'design');
		}


		if(array_key_exists('more_link', $_args))
		{
			$result['more_link'] = $data['more_link'];
		}
		else
		{
			$result['more_link'] = a($_current_data, 'more_link');
		}


		if(array_key_exists('more_link_caption', $_args))
		{
			$result['more_link_caption'] = $data['more_link_caption'];
		}
		else
		{
			$result['more_link_caption'] = a($_current_data, 'more_link_caption');
		}


		if(array_key_exists('play_item', $_args))
		{
			$result['play_item'] = $data['play_item'];
		}
		else
		{
			$result['play_item'] = a($_current_data, 'play_item');
		}

		$result['news'] = [];


		if(array_key_exists('cat_id', $_args))
		{
			$result['news']['cat_id'] = $data['cat_id'];
		}
		else
		{
			$result['news']['cat_id'] = a($_current_data, 'news', 'cat_id');
		}

		if(array_key_exists('tag_id', $_args))
		{
			$result['news']['tag_id'] = $data['tag_id'];
		}
		else
		{
			$result['news']['tag_id'] = a($_current_data, 'news', 'tag_id');
		}

		if(array_key_exists('subtype', $_args))
		{
			$result['news']['subtype'] = $data['subtype'];
		}
		else
		{
			$result['news']['subtype'] = a($_current_data, 'news', 'subtype');
		}

		return $result;
	}


	// add new news
	public static function add($_args)
	{
		$data = self::check_validate($_args, []);

		if(!$data['title'])
		{
			$data['title'] = self::suggest_new_name();
		}

		$line_id = \lib\app\website\body\add::line('news', ['title' => $data['title'], 'publish' => $data['publish']]);

		if(!$line_id)
		{
			\dash\log::oops('error:line:news');
			return false;
		}

		$data = json_encode($data, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($data, $line_id);

		\dash\notif::ok(T_("News line added"));

		// retrun id to redirect to this news
		return ['id' => \dash\coding::encode($line_id)];
	}



	public static function edit($_args, $_line_id)
	{

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
			\dash\notif::error(T_("Invalid line id"));
			return false;
		}

		$saved_value = self::inline_get($line_id);

		if(!$saved_value)
		{
			return false;
		}

		$data  = self::check_validate($_args, $saved_value);

		if(!$data)
		{
			return false;
		}

		$saved_value = json_encode($data, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("News line edited"));

		return true;
	}
}
?>