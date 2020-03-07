<?php
namespace lib\app\application;


class intro
{

	public static function set_android($_intro)
	{

		if(!$_intro || !is_array($_intro))
		{
			\dash\notif::error(T_("Please set your intro setting"), 'intro');
			return false;
		}


		$ok_intro = [];
		$index = 1;

		foreach ($_intro as $key => $value)
		{
			if(substr($key, 0, 5) !== 'intro')
			{
				continue;
			}

			if(!array_key_exists('title', $value))
			{
				continue;
			}

			if(!array_key_exists('desc', $value))
			{
				continue;
			}


			if(mb_strlen($value['title']) > 50)
			{
				\dash\notif::error(T_("Splash page title must be less than 50 character"), 'title'. $index);
				return false;
			}

			if(mb_strlen($value['desc']) > 100)
			{
				\dash\notif::error(T_("Splash page desc must be less than 100 character"), 'desc'. $index);
				return false;
			}

			$ok_intro[$index] =
			[
				'title' => $value['title'],
				'desc'  => $value['desc'],
				'file'  => $value['file'],
			];

			$index++;

		}

		if(!$ok_intro)
		{
			\dash\notif::error(T_("Please fill the intro detail"));
			return false;
		}

		$theme = isset($_intro['theme']) ? $_intro['theme'] : null;
		if(!$theme)
		{
			\dash\notif::error(T_("Please choose your intro theme"));
			return false;
		}

		if(!in_array($theme, ['theme1','theme2','theme3','theme4','theme5']))
		{
			\dash\notif::error(T_("Invalid intro theme"));
			return false;
		}

		\lib\db\setting\update::overwirte_platform_cat_key($theme, 'android', 'intro', 'intro_theme');

		foreach ($ok_intro as $key => $value)
		{
			$my_key   = 'page_'. $key;

			$my_value = json_encode($value, JSON_UNESCAPED_UNICODE);

			$get      = \lib\db\setting\get::platform_cat_key('android', 'intro', $my_key);

			if(isset($get['id']))
			{
				if(isset($get['value']) && is_string($get['value']))
				{
					$meta = json_decode($get['value'], true);
					if(isset($meta['file']) && $meta['file'] && !$value['file'])
					{
						$value['file'] = $meta['file'];
						$my_value = json_encode($value, JSON_UNESCAPED_UNICODE);
					}
					\lib\db\setting\update::value($my_value, $get['id']);
				}
			}
			else
			{
				$insert =
				[
					'platform' => 'android',
					'cat'      => 'intro',
					'key'      => $my_key,
					'value'    => $my_value,
				];

				\lib\db\setting\insert::new_record($insert);
			}
		}


		\dash\notif::ok(T_("Application intro set"));
		return true;
	}


	public static function get()
	{
		$result = \lib\db\setting\get::platform_cat('android', 'intro');
		if(!$result || !is_array($result))
		{
			$result = [];
		}

		$intro =
		[
			1 =>
			[
				'title' => T_("Jibres"),
				'desc'  => T_("Sell and Enjoy"),
				'image'  => \dash\url::icon(),
			],

			2 =>
			[
				'title' => T_("Jibres"),
				'desc'  => T_("Sell and Enjoy"),
				'image'  => \dash\url::icon(),
			],

			3 =>
			[
				'title' => T_("Jibres"),
				'desc'  => T_("Sell and Enjoy"),
				'image'  => \dash\url::icon(),
			],
		];

		$theme = null;

		foreach ($result as $key => $value)
		{
			if($value['key'] === 'intro_theme')
			{
				$theme = $value['value'];
				continue;
			}

			$index = substr($value['key'], 5);

			if(!isset($intro[$index]))
			{
				$intro[$index] = [];
			}

			$meta = json_decode($value['value'], true);

			if(isset($meta['title']))
			{
				$intro[$index]['title'] = $meta['title'];
			}

			if(isset($meta['desc']))
			{
				$intro[$index]['desc'] = $meta['desc'];
			}

			if(isset($meta['file']) && $meta['file'])
			{
				$intro[$index]['image'] = \lib\filepath::fix($meta['file']);
			}
		}

		$intro['theme'] = $theme;

		return $intro;
	}

}
?>