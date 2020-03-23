<?php
namespace lib\app\application;


class splash
{

	public static function set_android_theme($_args)
	{

		$condition =
		[
			'theme'     => ['enum' => array_column(self::theme_color(), 'key')],
			'start'     => 'string',
			'end'       => 'string',
			'colortext' => 'string',
			'colordesc' => 'string',
		];

		$require = ['theme'];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$theme      = $data['theme'];
		$theme      = explode('_', $theme);

		$theme_array =
		[
			'start'      => $theme[0],
			'end'        => $theme[1],
			'text_color' => $theme[2],
			'meta_color' => $theme[3],
		];

		$theme = json_encode($theme_array);

		$get = \lib\db\setting\get::platform_cat_key('android', 'splash', 'splash_theme');

		if(isset($get['id']))
		{
			\lib\db\setting\update::value($theme, $get['id']);
		}
		else
		{
			$insert =
			[
				'platform' => 'android',
				'cat'      => 'splash',
				'key'      => 'splash_theme',
				'value'    => $theme,
			];

			\lib\db\setting\insert::new_record($insert);
		}

		\dash\notif::ok(T_('Application splash setting saved'));
		return true;

	}


	public static function get_android()
	{
		$result = \lib\db\setting\get::platform_cat_key('android', 'splash', 'splash_theme');

		if(isset($result['value']) && is_string($result['value']))
		{
			$result = json_decode($result['value'], true);
			if(!is_array($result))
			{
				$result = [];
			}

			if(isset($result['start']) && isset($result['end']) && isset($result['text_color']) && isset($result['meta_color']))
			{
				$key = implode('_', [$result['start'], $result['end'], $result['text_color'], $result['meta_color']]);
				$result['key'] = $key;
			}
		}
		else
		{
			$result = [];
		}

		return $result;

	}



	public static function theme_color()
	{
		$theme_color =
		[
			'gradient0'  => ['start' => '#6DE195',   'end' => '#C4E759', 'text_color' => '#000000', 'meta_color' => '#333333', 'title' => 'gradient0'],
			'gradient1'  => ['start' => '#41C7AF',   'end' => '#54E38E', 'text_color' => '#000000', 'meta_color' => '#333333', 'title' => 'gradient1'],
			'gradient2'  => ['start' => '#99E5A2',   'end' => '#D4FC78', 'text_color' => '#000000', 'meta_color' => '#333333', 'title' => 'gradient2'],
			'gradient3'  => ['start' => '#ABC7FF',   'end' => '#C1E3FF', 'text_color' => '#000000', 'meta_color' => '#333333', 'title' => 'gradient3'],
			'gradient4'  => ['start' => '#6CACFF',   'end' => '#8DEBFF', 'text_color' => '#ffffff', 'meta_color' => '#eeeeee', 'title' => 'gradient4'],
			'gradient5'  => ['start' => '#5583EE',   'end' => '#41D8DD', 'text_color' => '#ffffff', 'meta_color' => '#eeeeee', 'title' => 'gradient5'],
			'gradient6'  => ['start' => '#A16BFE',   'end' => '#DEB0DF', 'text_color' => '#ffffff', 'meta_color' => '#eeeeee', 'title' => 'gradient6'],
			'gradient7'  => ['start' => '#D279EE',   'end' => '#F8C390', 'text_color' => '#ffffff', 'meta_color' => '#eeeeee', 'title' => 'gradient7'],
			'gradient8'  => ['start' => '#F78FAD',   'end' => '#FDEB82', 'text_color' => '#000000', 'meta_color' => '#333333', 'title' => 'gradient8'],
			'gradient9'  => ['start' => '#BC3D2F',   'end' => '#A16BFE', 'text_color' => '#ffffff', 'meta_color' => '#eeeeee', 'title' => 'gradient9'],
			'gradient10' => ['start' => '#A43AB2',   'end' => '#E13680', 'text_color' => '#ffffff', 'meta_color' => '#eeeeee', 'title' => 'gradient10'],
			'gradient11' => ['start' => '#9D2E7D',   'end' => '#E16E93', 'text_color' => '#ffffff', 'meta_color' => '#eeeeee', 'title' => 'gradient11'],
			'gradient12' => ['start' => '#F5CCF6',   'end' => '#F1EEF9', 'text_color' => '#000000', 'meta_color' => '#333333', 'title' => 'gradient12'],
			'gradient13' => ['start' => '#F0EFF0',   'end' => '#FAF8F9', 'text_color' => '#000000', 'meta_color' => '#333333', 'title' => 'gradient13'],
			'gradient14' => ['start' => '#121317',   'end' => '#323B42', 'text_color' => '#ffffff', 'meta_color' => '#eeeeee', 'title' => 'gradient14'],
		];

		foreach ($theme_color as $key => $value)
		{
			$theme_color[$key]['key'] = implode('_', [$value['start'], $value['end'], $value['text_color'], $value['meta_color']]);
		}

		return $theme_color;
	}


}
?>