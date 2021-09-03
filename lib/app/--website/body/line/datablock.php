<?php
namespace lib\app\website\body\line;

class datablock
{

	public static function suggest_new_name($_name)
	{
		$count_news = \lib\db\setting\get::count_platform_cat_key('website', 'homepage', 'body_line_news');
		$count_news = intval($count_news) + 1;

		return $_name. ' '. \dash\fit::number($count_news);
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

		$result = self::ready($result);

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
				case 'info_position':
					$result[$key] = \lib\app\website\info_position::get($value);
					break;

				case 'avand':
					$result[$key] = \lib\app\website\avand::get($value);
					break;

				case 'radius':
					$result[$key] = \lib\app\website\radius::get($value);
					break;

				case 'padding':
					$result[$key] = \lib\app\website\padding::get($value);
					break;

				case 'effect':
					$result[$key] = \lib\app\website\effect::get($value);
					break;


				case 'more_link_caption':
					if(!$value)
					{
						if(\dash\url::content() === 'a')
						{
							$result['more_link_caption_placeholder'] = T_("Show more");
						}
						else
						{
							$value = T_("Show more");
						}
					}

					$result[$key] = $value;

					break;

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
			'publish'           => 'bit',
			'type'              => ['enum' => ['news', 'product', 'imageblock']],

			'title'             => 'string_200',
			'show_title'        => 'yes_no',
			'more_link'         => ['enum' => ['show', 'hide']],
			'more_link_caption' => 'string_50',

			'puzzle'            => \lib\app\website\puzzle::input_check(),



			'info_position'     => \lib\app\website\info_position::input_check(),
			'avand'             => \lib\app\website\avand::input_check(),
			'radius'            => \lib\app\website\radius::input_check(),
			'padding'           => \lib\app\website\padding::input_check(),
			'effect'            => \lib\app\website\effect::input_check(),
			'limit'             => 'tinyint',


			'play_item'         => ['enum' => ['none', 'first', 'all']],
			'subtype'           => ['enum' => ['any', 'standard', 'gallery', 'video', 'audio']],
			'tag_id'            => 'code',
		];

		$require = [];

		$meta    = [];

		$data    = \dash\cleanse::input($_args, $condition, $require, $meta);

		$data    = \dash\cleanse::data_json_merge($_args, $data, $_current_data);

		// if subtype is standard or gallery we set default paly item in none
		if($data['subtype'] === 'standard' || $data['subtype'] === 'gallery')
		{
			$data['play_item'] = 'none';
		}

		return $data;
	}


	// add new news
	public static function add($_args)
	{
		$data = self::check_validate($_args, []);

		if(!$data['title'])
		{
			$data['title'] = self::suggest_new_name(T_("News"));
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