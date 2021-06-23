<?php
namespace dash\validate;

class dataarray
{

	public static function isarray($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
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
				\dash\cleanse::$status = false;
			}
			return false;
		}


		return $data;
	}



	public static function json($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		$data = json_decode($data, true);
		if(!is_array($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be json", ['val' => $_field_title]), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $_data;
	}




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
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(isset($_meta['enum']) && is_array($_meta['enum']))
		{
			$my_enum = [];

			foreach ($_meta['enum'] as $value)
			{
				if($value === null)
				{
					$my_enum[] = null;
				}

				if(is_string($value))
				{
					$my_enum[] = $value;
				}

				if(is_numeric($value))
				{
					$my_enum[] = (string) $value;
				}
			}

			if(!in_array($data, $my_enum))
			{
				if($_notif)
				{
					\dash\notif::error(T_("Your entered value is outside the approved list for field :val", ['val' => $_field_title]), ['element' => $_element]);
					\dash\cleanse::$status = false;
				}
				return false;
			}
		}
		else
		{
			if($_notif)
			{
				\dash\notif::error(T_("Enum list must be array"), ['element' => $_element]);
				\dash\cleanse::$status = false;
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
				\dash\cleanse::$status = false;
			}
			return false;
		}

		$new_tag = [];
		$count = 0;
		foreach ($data as $tag)
		{
			$count++;
			if($count > 100)
			{
				\dash\notif::warn(T_("You can set maximum 100 tag"));
				break;
			}

			$temp = \dash\validate::string_50($tag, true, ['field_title' => $_field_title, 'element' => $_element]);
			if(isset($temp))
			{
				$new_tag[] = $temp;
			}

		}

		$new_tag = array_unique($new_tag);
		$new_tag = array_filter($new_tag);

		return $new_tag;
	}


	public static function tag_long($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
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
				\dash\cleanse::$status = false;
			}
			return false;
		}

		$new_tag = [];
		$count = 0;
		foreach ($data as $tag)
		{
			$count++;
			if($count > 100)
			{
				\dash\notif::warn(T_("You can set maximum 100 tag"));
				break;
			}

			$temp = \dash\validate::string_300($tag, true, ['field_title' => $_field_title, 'element' => $_element]);
			if(isset($temp))
			{
				$new_tag[] = $temp;
			}

		}

		$new_tag = array_unique($new_tag);
		$new_tag = array_filter($new_tag);

		return $new_tag;
	}


	public static function cat($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
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
				\dash\cleanse::$status = false;
			}
			return false;
		}

		$new_tag = [];
		$count = 0;
		foreach ($data as $tag)
		{
			$count++;
			if($count > 50)
			{
				\dash\notif::warn(T_("You can set maximum 50 cat"));
				break;
			}

			$temp = \dash\validate::string_50($tag, true, ['field_title' => $_field_title, 'element' => $_element]);
			if(isset($temp))
			{
				$new_tag[] = $temp;
			}

		}

		$new_tag = array_unique($new_tag);
		$new_tag = array_filter($new_tag);

		return $new_tag;
	}



	public static function sort_item($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		// var_dump($_data, $_POST['sort']);
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
				\dash\cleanse::$status = false;
			}
			return false;
		}

		$new_sort = [];
		foreach ($data as $key => $value)
		{
			$temp = \dash\validate::string_100($value);
			if(isset($temp))
			{
				$new_sort[] = $temp;
			}
		}

		return $new_sort;
	}


}
?>
