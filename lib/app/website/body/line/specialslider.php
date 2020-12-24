<?php
namespace lib\app\website\body\line;

class specialslider
{

	public static function suggest_new_name()
	{
		$count_specialslider = \lib\db\setting\get::count_platform_cat_key('website', 'homepage', 'body_line_specialslider');
		$count_specialslider = intval($count_specialslider) + 1;

		return T_("Slider"). ' '. \dash\fit::number($count_specialslider);
	}


	public static function get($_id)
	{
		$result = \lib\app\website\body\get::line_setting($_id);

		if(isset($result['type']) && $result['type'] === 'specialslider')
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("This is not a specialslider"));
			return false;
		}

		if(isset($result['specialslider']) && is_array($result['specialslider']))
		{
			$result['specialslider'] = array_map(['self', 'ready'], $result['specialslider']);
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
				case 'image':
					if(isset($value))
					{

						$image_file_addr = \lib\filepath::fix_real_path($value);
						$ratio = \dash\utility\image::get_ratio($image_file_addr);
						$result['image_ratio'] = $ratio;
						$result['image_ratio_title'] = \lib\ratio::ratio_title($ratio);

						$result[$key] = \lib\filepath::fix($value);
					}
					else
					{
						$result[$key] = null;
					}
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


	// add new specialslider
	public static function add($_args)
	{
		$data = self::check_validate($_args);

		if(!$data)
		{
			return false;
		}

		// if(!$data['url'])
		// {
		// 	\dash\notif::error(T_("Please set the link"), 'url');
		// 	return false;
		// }

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

		$line_id = \lib\app\website\body\add::line('specialslider');

		$saved_option = self::inline_get($line_id);

		$saved_option['specialslider'] = [];

		$saved_option['specialslider'][] =
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

		// retrun id to redirect to this specialslider
		return ['id' => \dash\coding::encode($line_id)];
	}


	public static function remove($_line_id, $_specialslider_index)
	{
		$line_id = \dash\validate::code($_line_id);
		$line_id = \dash\coding::decode($line_id);

		if(!$line_id)
		{
			return false;
		}
		if(!is_numeric($_specialslider_index))
		{
			\dash\notif::error(T_("Slider index must be a number"));
			return false;
		}

		$saved_value = self::inline_get($line_id);

		if(!$saved_value || !isset($saved_value['specialslider']))
		{
			return false;
		}

		$saved_specialslider = $saved_value['specialslider'];


		if(!array_key_exists($_specialslider_index, $saved_specialslider))
		{
			\dash\notif::error(T_("Invalid special slider index"));
			return false;
		}

		unset($saved_specialslider[$_specialslider_index]);

		$saved_specialslider = array_values($saved_specialslider);

		$saved_value['specialslider'] = $saved_specialslider;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Slider page was removed"));

		return true;
	}


	public static function set_sort($_line_id, $_specialslider_sort)
	{
		$line_id = \dash\validate::code($_line_id);
		$line_id = \dash\coding::decode($line_id);

		if(!$line_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		if(!$_specialslider_sort || !is_array($_specialslider_sort))
		{
			\dash\notif::error(T_("Invalid sort detail"));
			return false;
		}

		$specialslider_sort = [];

		foreach ($_specialslider_sort as $key => $value)
		{
			if(!is_numeric($value))
			{
				\dash\notif::error(T_("Invalid sort index"));
				return false;
			}

			$specialslider_sort[] = intval($value);
		}

		$saved_value = self::inline_get($line_id);

		if(!$saved_value || !isset($saved_value['specialslider']))
		{
			\dash\notif::error(T_("Slider detail not found"));
			return false;
		}

		$saved_specialslider = $saved_value['specialslider'];

		foreach ($specialslider_sort as $new_index => $old_index)
		{
			if(!array_key_exists($old_index, $saved_specialslider))
			{
				\dash\redirect::pwd();
				return false;
			}

			$saved_specialslider[$old_index]['sort'] = $new_index;
		}


		$sort_column = array_column($saved_specialslider, 'sort');

		if(count($sort_column) !== count($_specialslider_sort))
		{
			\dash\redirect::pwd();
			return;
		}

		$my_sorted_list = $saved_specialslider;

		array_multisort($my_sorted_list, SORT_ASC, SORT_NUMERIC, $sort_column);

		$saved_specialslider = $my_sorted_list;

		$saved_specialslider = array_values($saved_specialslider);

		$saved_value['specialslider'] = $saved_specialslider;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Sorted"));
		return true;

	}


	public static function edit($_args, $_line_id, $_specialslider_index = null)
	{
		$data      = self::check_validate($_args);

		if(!$data)
		{
			return false;
		}

		$line_option = \lib\app\website\body\template::get('specialslider');

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

		if(!$saved_value || !isset($saved_value['specialslider']))
		{
			return false;
		}

		$saved_specialslider = $saved_value['specialslider'];

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

		if(is_numeric($_specialslider_index))
		{
			if(!array_key_exists($_specialslider_index, $saved_specialslider))
			{
				\dash\notif::error(T_("Slider index not found"));
				return false;
			}

			$edit_index_mode = true;

			if(!$image_path)
			{
				$image_path = isset($saved_specialslider[$_specialslider_index]['image']) ? $saved_specialslider[$_specialslider_index]['image'] : null;
			}
		}

		if(!$image_path)
		{
			\dash\notif::error(T_("Please upload an image file"), 'image');
			return false;
		}

		// if(!$data['url'])
		// {
		// 	\dash\notif::error(T_("Please set the link"), 'url');
		// 	return false;
		// }


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
			$saved_specialslider[$_specialslider_index] = $ready_to_save;
			\dash\notif::ok(T_("Page special slider edited"));
		}
		else
		{

			$saved_specialslider[] = $ready_to_save;

			if(isset($line_option['max_capacity']) && is_numeric($line_option['max_capacity']))
			{
				if(count($saved_specialslider) > intval($line_option['max_capacity']))
				{
					\dash\notif::error(T_("Maximum capacity of this special slider is full"));
					return false;
				}
			}

			\dash\notif::ok(T_("Slider page added"));
		}

		$sort_column = array_column($saved_specialslider, 'sort');

		if(count($sort_column) === count($saved_specialslider))
		{
			$my_sorted_list = $saved_specialslider;

			array_multisort($my_sorted_list, SORT_ASC, SORT_NUMERIC, $sort_column);

			$saved_specialslider = $my_sorted_list;
		}

		$saved_specialslider = array_values($saved_specialslider);

		$saved_value['specialslider'] = $saved_specialslider;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		return true;
	}
}
?>