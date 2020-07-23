<?php
namespace dash\utility;


class hive
{
	public static function set($_redirect = false)
	{
		// if the user is login not check and not set
		// if(\dash\user::id())
		// {
		// 	return true;
		// }

		$request = \dash\request::is();
		$request = mb_strtolower($request);
		if($request === 'get')
		{
			self::make();
		}
		elseif($request === 'post')
		{
			if(!self::check())
			{
				if($_redirect)
				{
					\dash\redirect::pwd();
				}
				else
				{
					\dash\header::status(400, T_("Reload page to continue!"));
				}
			}
		}
		else
		{
			\dash\header::status(400, T_("You wander in a labyrinth!"));
		}
	}


	private static function hive_session_key()
	{
		return 'hive_'. \dash\url::current();
	}


	private static function make()
	{
		$hive = [];
		$element = [1, 2, 3];
		shuffle($element);

		$hive['check'. $element[0]] = '';
		$hive['check'. $element[1]] = md5((string) time(). (string) rand(). (string) rand());
		$hive['check'. $element[2]] = \dash\url::current();

		\dash\data::hive($hive);

		\dash\session::set(self::hive_session_key(), $hive);
	}


	public static function get_json()
	{
		$hive = \dash\data::hive();
		if(!$hive)
		{
			return null;
		}

		$hive_string = [];

		if($hive && is_array($hive))
		{
			foreach ($hive as $key => $value)
			{
				$myKey = null;
				switch ($key)
				{
					case 'check1':
						$myKey = 'hiveCheck1';
						break;

					case 'check2':
						$myKey = 'hiveCheck2';
						break;

					case 'check3':
						$myKey = 'hiveCheck3';
						break;
				}

				$hive_string[] = '"'. $myKey. '":"'. $value. '"';
			}
		}

		if(!empty($hive_string))
		{
			$hive_string = implode(",", $hive_string);
		}

		return ",". $hive_string;
	}


	private static function check()
	{
		$hive = \dash\session::get(self::hive_session_key());
		if(!$hive || !is_array($hive))
		{
			return false;
		}
		$hiveCheck1 = \dash\request::post('hiveCheck1');
		$hiveCheck2 = \dash\request::post('hiveCheck2');
		$hiveCheck3 = \dash\request::post('hiveCheck3');

		if(!array_key_exists('check1', $hive) || (array_key_exists('check1', $hive) && $hiveCheck1 != $hive['check1']))
		{
			return false;
		}

		if(!array_key_exists('check2', $hive) || (array_key_exists('check2', $hive) && $hiveCheck2 != $hive['check2']))
		{
			return false;
		}

		if(!array_key_exists('check3', $hive) || (array_key_exists('check3', $hive) && $hiveCheck3 != $hive['check3']))
		{
			return false;
		}

		return true;
	}


	public static function html()
	{
		echo '<div class="hide">';
		echo '<div>';
		echo '<input type="hidden" name="hiveCheck3" value="'. \dash\data::hive_check3(). '">';
		echo '</div>';
		echo '</div>';
		echo '<input type="hidden" name="hiveCheck1" value="'. \dash\data::hive_check1(). '">';
		echo '<div class="hide">';
		echo '<input type="text" name="hiveCheck2" value="'. \dash\data::hive_check2(). '">';
		echo '</div>';
	}

}