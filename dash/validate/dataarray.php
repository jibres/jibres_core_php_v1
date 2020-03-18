<?php
namespace dash\validate;

class dataarray
{



	public static function enum($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
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

		if(isset($_meta['enum']) && is_array($_meta['enum']))
		{
			if(!in_array($data, $_meta['enum']))
			{
				if($_notif)
				{
					\dash\notif::error(T_("Invalid data for :val", ['val' => $_field_title]), ['element' => $_element]);
				}
				return false;
			}
		}
		else
		{
			if($_notif)
			{
				\dash\notif::error(T_("Enum condition must be array"), ['element' => $_element]);
			}
			return false;
		}

		return $data;
	}



	public static function tag($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		if(!is_array($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be array", ['val' => $_field_title]), ['element' => $_element]);
			}
			return false;
		}

		$new_tag = [];
		$count = 0;
		foreach ($data as $tag)
		{
			$count++;
			$temp = \dash\validate::string_30($tag);
			if(isset($temp))
			{
				$new_tag[] = $temp;
			}

			if($count > 20)
			{
				break;
			}
		}

		$new_tag = array_unique($new_tag);
		$new_tag = array_filter($new_tag);

		return $new_tag;
	}
}
?>
