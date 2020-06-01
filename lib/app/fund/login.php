<?php
namespace lib\app\fund;


class login
{

	public static function check()
	{
		$fund_login_id = \dash\session::get('fund_login_id');
		if(!$fund_login_id)
		{
			$no_fund = \dash\session::get('no_fund');
			if($no_fund)
			{
				return;
			}

			$fund_list = \lib\app\fund\search::all_list();

			if(!$fund_list)
			{
				\dash\session::set('no_fund', true);
				return;
			}

			if(count($fund_list) === 1)
			{
				if(isset($fund_list[0]['id']))
				{
					\dash\session::set('fund_login_id', $fund_list[0]['id']);
					\dash\redirect::to(\dash\url::here(). '/sale');
					return;
				}
			}

			\dash\redirect::to(\dash\url::here(). '/fund');
		}

	}


	public static function set($_fund_id)
	{
		if($_fund_id && is_numeric($_fund_id))
		{
			\dash\session::set('fund_login_id', $_fund_id);
			\dash\redirect::to(\dash\url::here(). '/sale');
		}
	}


	public static function get()
	{
		$fund_login_id = \dash\session::get('fund_login_id');
		if($fund_login_id)
		{
			return $fund_login_id;
		}

		return null;
	}
}
?>