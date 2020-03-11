<?php
namespace dash\validate;
/**
 * Class for validate args
 */
class text
{

	public static function string($_data, $_notif, $_length = null, $_element = null, $_field_title = null)
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		if(!is_string($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be string", ['val' => $_field_title]), ['element' => $_element, 'code' => 1600]);
			}
			return false;
		}

		if($_length)
		{
			if(mb_strlen($data) > $_length)
			{
				if($_notif)
				{
					\dash\notif::error(T_("Field :val must be less than :length character", ['val' => $_field_title, 'length' => \dash\fit::number($_length)]), ['element' => $_element, 'code' => 1605]);
				}
				return false;
			}
		}


		$data = str_replace('%', '', $data);

		return $data;
	}



}
?>