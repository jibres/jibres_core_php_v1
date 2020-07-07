<?php
namespace lib\app\irvat;


class login
{

	public static function check()
	{
		$irvat_login_id = \dash\session::get('irvat_login_id');
		if(!$irvat_login_id)
		{
			$no_irvat = \dash\session::get('no_irvat');
			if($no_irvat)
			{
				return;
			}

			$irvat_list = \lib\app\irvat\search::all_list();

			if(!$irvat_list)
			{
				\dash\session::set('no_irvat', true);
				return;
			}

			if(count($irvat_list) === 1)
			{
				if(isset($irvat_list[0]['id']))
				{
					\dash\session::set('irvat_login_id', $irvat_list[0]['id']);
					return;
				}
			}

			\dash\redirect::to(\dash\url::here(). '/irvat');
		}

	}


	public static function set($_irvat_id)
	{
		if($_irvat_id && is_numeric($_irvat_id))
		{
			\dash\session::set('irvat_login_id', $_irvat_id);
			\dash\redirect::to(\dash\url::here(). '/sale');
		}
	}


	public static function get()
	{
		$irvat_login_id = \dash\session::get('irvat_login_id');
		if($irvat_login_id)
		{
			return $irvat_login_id;
		}

		return null;
	}
}
?>