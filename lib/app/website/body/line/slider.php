<?php
namespace lib\app\website\body\line;

class slider
{

	public static function get($_id)
	{
		$result = \lib\app\website\body\get::line_setting($_id);

		if(isset($result['type']) && $result['type'] === 'slider')
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("This is not a slider"));
			return false;
		}

		if(isset($result['slider']) && is_array($result['slider']))
		{
			foreach ($result['slider'] as $key => $value)
			{
				if(isset($value['image']))
				{
					$result['slider'][$key]['image'] = \lib\filepath::fix($value['image']);
				}
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
			'url'    => 'string_200',
			'alt'    => 'string_200',
			'sort'   => 'smallint',
			'image'  => 'bit',
			'target' => 'bit',
		];

		$require   = [];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


	// add new slider
	public static function add($_args)
	{
		$data = self::check_validate($_args);

		if(!$data)
		{
			return false;
		}

		if(!$data['url'])
		{
			\dash\notif::error(T_("Please set the link"), 'url');
			return false;
		}

		$image_path = null;

		if($data['image'])
		{
			$image_path = \dash\upload\website::upload_image('image');

			if(!\dash\engine\process::status())
			{
				return false;
			}
		}

		if(!$image_path)
		{
			\dash\notif::error(T_("Please upload an image file"), 'image');
			return false;
		}

		$line_id = \lib\app\website\body\add::line('slider');

		$saved_option = self::inline_get($line_id);

		$saved_option['slider'] = [];

		$saved_option['slider'][] =
		[
			'image'  => $image_path,
			'url'    => $data['url'],
			'alt'    => $data['alt'],
			'sort'   => $data['sort'],
			'target' => $data['target'],
		];


		$saved_option = json_encode($saved_option, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_option, $line_id);

		\dash\notif::ok(T_("Slider page added"));

		// retrun id to redirect to this slider
		return ['id' => \dash\coding::encode($line_id)];
	}



	public static function edit($_args, $_line_id, $_slider_index = null)
	{

		$condition =
		[
			'url'    => 'string_200',
			'alt'    => 'string_200',
			'sort'   => 'smallint',
			'image'  => 'bit',
			'target' => 'bit',
		];

		$require   = [];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		$line_option = \lib\app\website\body\template::get('slider');

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

		if(!$saved_value || !isset($saved_value['slider']))
		{
			return false;
		}

		$saved_slider = $saved_value['slider'];

		$edit_index_mode = false;

		$image_path = null;

		if($data['image'])
		{
			$image_path = \dash\upload\website::upload_image('image');

			if(!\dash\engine\process::status())
			{
				return false;
			}
		}

		if(is_numeric($_slider_index))
		{
			if(!array_key_exists($_slider_index, $saved_slider))
			{
				\dash\notif::error(T_("Slider index not found"));
				return false;
			}

			$edit_index_mode = true;

			if(!$image_path)
			{
				$image_path = isset($saved_slider[$_slider_index]['image']) ? $saved_slider[$_slider_index]['image'] : null;
			}
		}

		if(!$image_path)
		{
			\dash\notif::error(T_("Please upload an image file"), 'image');
			return false;
		}

		if(!$data['url'])
		{
			\dash\notif::error(T_("Please set the link"), 'url');
			return false;
		}


		$ready_to_save =
		[
			'image'  => $image_path,
			'url'    => $data['url'],
			'alt'    => $data['alt'],
			'sort'   => $data['sort'],
			'target' => $data['target'],
		];

		if($edit_index_mode)
		{
			$saved_slider[$_slider_index] = $ready_to_save;
			\dash\notif::ok(T_("Page slider edited"));
		}
		else
		{

			$saved_slider[] = $ready_to_save;

			if(isset($line_option['max_capacity']) && is_numeric($line_option['max_capacity']))
			{
				if(count($saved_slider) > intval($line_option['max_capacity']))
				{
					\dash\notif::error(T_("Maximum capacity of this slider is full"));
					return false;
				}
			}

			\dash\notif::ok(T_("Slider page added"));
		}

		$sort_column = array_column($saved_slider, 'sort');

		if(count($sort_column) === count($saved_slider))
		{
			$my_sorted_list = $saved_slider;

			array_multisort($my_sorted_list, SORT_ASC, SORT_NUMERIC, $sort_column);

			$saved_slider = $my_sorted_list;
		}

		$saved_slider = array_values($saved_slider);

		$saved_value['slider'] = $saved_slider;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		return true;
	}
}
?>