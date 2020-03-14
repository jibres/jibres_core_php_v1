<?php
namespace dash\validate;

class datetime
{



	public static function date($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		if(!is_string($data) && !is_numeric($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be string or number", ['val' => $_field_title]), ['element' => $_element]);
			}
			return false;
		}



		return $data;
	}


	public static function birthdate($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{

	}


	public static function datetime($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{

	}


	public static function time($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{

	}

}
?>
