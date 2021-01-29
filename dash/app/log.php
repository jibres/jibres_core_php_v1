<?php
namespace dash\app;


class log
{

	public static function set_readdate($_data, $_all = false, $_user_id = null)
	{
		if(!is_array($_data))
		{
			return false;
		}

		if(!$_user_id)
		{
			$_user_id = \dash\user::id();
		}

		if($_all)
		{
			return \dash\db\logs::set_readdate_user($_user_id);
		}
		else
		{

			$ids = array_column($_data, 'id_raw');
			$ids = array_filter($ids);
			$ids = array_unique($ids);

			if(!$ids)
			{
				return false;
			}

			$ids = implode(',', $ids);

			return \dash\db\logs::set_readdate($ids);
		}

	}


	public static function my_notif_count($_user_id = null)
	{
		if(!$_user_id || !is_numeric($_user_id))
		{
			$_user_id = \dash\user::id();
		}

		$count = null;

		if($_user_id)
		{
			$count = \dash\db\logs::my_notif_count($_user_id);
		}
		return intval($count);
	}

	/**
	 * Gets the course.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The course.
	 */
	public static function list($_string = null, $_args = [])
	{

		$default_meta =
		[
			'sort'  => null,
			'order' => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_meta, $_args);


		$_args['sort'] = null;



		$result            = \dash\db\logs::search($_string, $_args);
		$temp              = [];

		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}


	public static function check_caller_code($_caller, $_code)
	{
		$load = \dash\db\logs\get::by_caller_code($_caller, $_code);
		return $load;
	}


	public static function ready($_data)
	{
		return \dash\app\log\ready::row($_data);
	}


}
?>