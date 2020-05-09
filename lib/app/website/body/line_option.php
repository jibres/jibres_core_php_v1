<?php
namespace lib\app\website\body;

class line_option
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

		if($_pretty)
		{
			foreach ($saved_option as $key => $value)
			{
				if(isset($value['image']))
				{
					$saved_option[$key]['image'] = \lib\filepath::fix($value['image']);
				}
			}
		}

		return $saved_option;
	}


	public static function slider($_args, $_line_key, $_slider_index = null, $_remove = false)
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

		$line_option = \lib\app\website\body\get::line_option($_line_key);

		if(!isset($line_option['key']))
		{
			\dash\notif::error(T_("Line detail not found"));
			return false;
		}

		$saved_option = self::get($_line_key, false);

		$edit_mode = false;

		$image_path = null;

		if($data['image'])
		{
			$image_path = \dash\upload\website::upload_image('image');
		}

		if(is_numeric($_slider_index))
		{
			if(!array_key_exists($_slider_index, $saved_option))
			{
				\dash\notif::error(T_("Slider index not found"));
				return false;
			}

			$edit_mode = true;

			if(!$image_path)
			{
				$image_path = isset($saved_option[$_slider_index]['image']) ? $saved_option[$_slider_index]['image'] : null;
			}
		}

		if(!$_remove)
		{
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
		}

		$ready_to_save =
		[
			'image'  => $image_path,
			'url'    => $data['url'],
			'alt'    => $data['alt'],
			'sort'   => $data['sort'],
			'target' => $data['target'],
		];

		if($edit_mode)
		{
			if($_remove)
			{
				unset($saved_option[$_slider_index]);
				\dash\notif::ok(T_("Page slider removed"));
			}
			else
			{
				$saved_option[$_slider_index] = $ready_to_save;
				\dash\notif::ok(T_("Page slider edited"));
			}
		}
		else
		{
			$saved_option[] = $ready_to_save;
			\dash\notif::ok(T_("Slider page added"));
		}

		$sort_column = array_column($saved_option, 'sort');

		if(count($sort_column) === count($saved_option))
		{
			$my_sorted_list = $saved_option;

			array_multisort($my_sorted_list, SORT_ASC, SORT_NUMERIC, $sort_column);

			$saved_option = $my_sorted_list;
		}


		$saved_option = json_encode($saved_option, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::overwirte_platform_cat_key($saved_option, 'website', 'body_line_option', $_line_key);


		return true;
	}
}
?>