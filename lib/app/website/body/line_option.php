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


	public static function set($_args, $_line_key)
	{
		$condition =
		[
			'url'    => 'string_200',
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

		switch ($line_option['key'])
		{
			case 'slider':
				$saved_option = self::slider($data, $line_option, $saved_option);
				break;

			default:
				# code...
				break;
		}

		if(!\dash\engine\process::status())
		{
			return false;
		}

		$saved_option = json_encode($saved_option, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::overwirte_platform_cat_key($saved_option, 'website', 'body_line_option', $_line_key);

		return true;
	}



	private static function slider($data, $line_option, $saved_option)
	{
		$image_path = null;
		if($data['image'])
		{
			$image_path = \dash\upload\website::upload_image('image');
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

		$saved_option[] =
		[
			'image'  => $image_path,
			'url'    => $data['url'],
			'target' => $data['target'],
		];

		\dash\notif::ok(T_("Slider page added"));

		return $saved_option;
	}
}
?>