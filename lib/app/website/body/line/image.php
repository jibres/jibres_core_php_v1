<?php
namespace lib\app\website\body\line;

class image
{

	public static function get($_id)
	{
		$result = \lib\app\website\body\get::line_setting($_id);

		if(isset($result['type']) && $result['type'] === 'image')
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("This is not a latest news"));
			return false;
		}

		if(isset($result['image']) && is_array($result['image']))
		{
			$result['image'] = self::ready($result['image']);
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
			'image'  => 'bit',
			'url'    => 'string_100',
			'alt'    => 'string_100',
			'target' => 'bit',
		];

		$require   = [];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


	// add new image
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


		$line_id = \lib\app\website\body\add::line('image');

		$saved_option = self::inline_get($line_id);

		$saved_option['image'] =
		[
			'image'  => $image_path,
			'url'    => $data['url'],
			'target' => $data['target'],
			'alt'    => $data['alt'],
		];


		$saved_option = json_encode($saved_option, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_option, $line_id);

		\dash\notif::ok(T_("Image box added"));

		// retrun id to redirect to this image
		return ['id' => \dash\coding::encode($line_id)];
	}


	public static function remove($_line_id, $_image_index)
	{
		$line_id = \dash\validate::code($_line_id);
		$line_id = \dash\coding::decode($line_id);

		if(!$line_id)
		{
			return false;
		}
		if(!is_numeric($_image_index))
		{
			\dash\notif::error(T_("Image box index must be a number"));
			return false;
		}

		$saved_value = self::inline_get($line_id);

		if(!$saved_value || !isset($saved_value['image']))
		{
			return false;
		}

		$saved_image = $saved_value['image'];


		if(!array_key_exists($_image_index, $saved_image))
		{
			\dash\notif::error(T_("Invalid image index"));
			return false;
		}

		unset($saved_image[$_image_index]);

		$saved_image = array_values($saved_image);

		$saved_value['image'] = $saved_image;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Image box was removed"));

		return true;
	}


	public static function edit($_args, $_line_id, $_image_index = null)
	{

		$data      = self::check_validate($_args);

		if(!$data)
		{
			return false;
		}

		$line_option = \lib\app\website\body\template::get('image');

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

		if(!$saved_value || !isset($saved_value['image']))
		{
			return false;
		}

		$saved_image = $saved_value['image'];


		$ready_to_save =
		[
			'image'  => $data['image'],
			'url'    => $data['url'],
			'alt'    => $data['alt'],
			'target' => $data['target'],
		];


		$saved_image = $ready_to_save;

		$saved_value['image'] = $saved_image;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Image box edited"));

		return true;
	}
}
?>