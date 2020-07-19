<?php
namespace dash\validate;

class location
{



	public static function country($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 1, 'max' => 100]);

		if($data === false)
		{
			return false;
		}

		if(!\dash\utility\location\countres::check($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid country"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}


		return $data;
	}



	public static function province($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 1, 'max' => 100]);

		if($data === false)
		{
			return false;
		}

		if(!\dash\utility\location\provinces::check($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid province"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}



	public static function city($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 1, 'max' => 100]);

		if($data === false)
		{
			return false;
		}


		return $data;
	}



}
?>
