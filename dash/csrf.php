<?php
namespace dash;


class csrf
{

	public static function set($_redirect = false)
	{
		$request = \dash\request::is();
		$request = mb_strtolower($request);

		if($request === 'get')
		{
			// nothing
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




	private static function make()
	{
		$token = '';
		$token .= (string) time();
		$token .= (string) rand();
		$token .= (string) microtime();
		$token .= (string) rand();
		$token .= (string) rand();
		$token .= '$_<3_$';
		$token .= \dash\url::pwd();
		$token = md5($token);

		$insert =
		[
			'token'       => $token,
			'urlmd5'      => md5(\dash\url::pwd()),
			'url'         => \dash\validate::string(\dash\url::pwd(), false),
			'status'      => 'active',
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$csrf_id = \dash\db\csrf\insert::new_record($insert);

		$result =
		[
			'token' => $token,
		];

		\dash\data::csrfDetail($result);

		return $result;
	}


	public static function get_json($_new = false)
	{
		if($_new)
		{
			self::make();
		}

		$csrf = \dash\data::csrfDetail();

		if(!$csrf)
		{
			return null;
		}

		$csrf_string = [];

		if($csrf && is_array($csrf))
		{
			foreach ($csrf as $key => $value)
			{
				$csrf_string[] = '"'. $key. '":"'. $value. '"';
			}
		}

		if(!empty($csrf_string))
		{
			$csrf_string = implode(",", $csrf_string);
			return ",". $csrf_string;
		}

		return null;

	}



	private static function check()
	{
		if(!\dash\request::post('csrftoken'))
		{
			return false;
		}

		$token = \dash\request::post('csrftoken');
		$token = \dash\validate::md5($token, false);

		if(!$token)
		{
			return false;
		}

		$urlmd5 = md5(\dash\url::pwd());

		// check exist token and is active
		$check  = \dash\db\csrf\get::check($token, $urlmd5);

		if(!isset($check['id']))
		{
			return false;
		}

		\dash\db\csrf\update::set_used($check['id']);

		return true;
	}


	public static function html($_new = true)
	{
		if($_new)
		{
			self::make();
		}

		$csrf = \dash\data::csrfDetail();

		if(!isset($csrf['token']))
		{
			self::make();
			$csrf = \dash\data::csrfDetail();
		}


		if(isset($csrf['token']))
		{
			echo '<div class="hide"><input type="hidden" name="csrftoken" value="'. $csrf['token']. '"></div>';
		}
	}



	public static function clean()
	{
		\dash\db\csrf\delete::clean();
	}

}