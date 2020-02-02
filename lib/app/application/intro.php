<?php
namespace lib\app\application;


class intro
{

	public static function set($_intro)
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

		foreach ($ok_intro as $key => $value)
		{
			$my_key   = 'page_'. $key;

			if(array_key_exists('title', $value))
			{
				$get      = \lib\db\setting\get::by_cat_key_value('intro', $my_key, 'title');

				if(!isset($get['id']))
				{
					$insert =
					[
						'cat'   => 'intro',
						'key'   => $my_key,
						'value' => 'title',
						'json'  => $value['title'],
					];

					\lib\db\setting\insert::new_record($insert);
				}
				else
				{
					\lib\db\setting\update::by_cat_key_value('intro', $my_key, 'title', $value['title']);
				}
			}

			if(array_key_exists('desc', $value))
			{
				$get      = \lib\db\setting\get::by_cat_key_value('intro', $my_key, 'desc');

				if(!isset($get['id']))
				{
					$insert =
					[
						'cat'   => 'intro',
						'key'   => $my_key,
						'value' => 'desc',
						'json'  => $value['desc'],
					];

					\lib\db\setting\insert::new_record($insert);
				}
				else
				{
					\lib\db\setting\update::by_cat_key_value('intro', $my_key, 'desc', $value['desc']);
				}
			}

			if(isset($value['file']) && $value['file'])
			{
				$get      = \lib\db\setting\get::by_cat_key_value('intro', $my_key, 'file');

				if(!isset($get['id']))
				{
					$insert =
					[
						'cat'   => 'intro',
						'key'   => $my_key,
						'value' => 'file',
						'json'  => $value['file'],
					];

					\lib\db\setting\insert::new_record($insert);
				}
				else
				{
					\lib\db\setting\update::by_cat_key_value('intro', $my_key, 'file', $value['file']);
				}
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
				'desc'  => T_("Sale and Enjoy"),
				'file'  => \dash\url::icon(),
			],

			2 =>
			[
				'title' => T_("Jibres"),
				'desc'  => T_("Sale and Enjoy"),
				'file'  => \dash\url::icon(),
			],

			3 =>
			[
				'title' => T_("Jibres"),
				'desc'  => T_("Sale and Enjoy"),
				'file'  => \dash\url::icon(),
			],
		];

		foreach ($result as $key => $value)
		{

			$index = substr($value['key'], 5);

			if(!isset($intro[$index]))
			{
				$intro[$index] = [];
			}

			if($value['value'] == 'title' && $value['json'])
			{
				$intro[$index]['title'] = $value['json'];
			}

			if($value['value'] == 'desc' && $value['json'])
			{
				$intro[$index]['desc'] = $value['json'];
			}

			if($value['value'] == 'file' && $value['json'])
			{
				$intro[$index]['file'] = \lib\filepath::fix($value['json']);
			}
		}

		return $intro;
	}

}
?>