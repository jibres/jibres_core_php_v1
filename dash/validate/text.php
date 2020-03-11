<?php
namespace dash\validate;
/**
 * Class for validate args
 */
class text
{

	public static function string($_data, $_notif = false, $_length = null, $_element = null, $_field_title = null, $_meta = [])
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

		$length = $_length;

		if(!$length)
		{
			$length = 100000;
		}

		if(mb_strlen($data) > $length)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field :val must be less than :length character", ['val' => $_field_title, 'length' => \dash\fit::number($length)]), ['element' => $_element, 'code' => 1605]);
			}
			return false;
		}


		if(isset($_meta['min']) && is_numeric($_meta['min']))
		{
			if(mb_strlen($data) < intval($_meta['min']))
			{
				if($_notif)
				{
					\dash\notif::error(T_("Field :val must be larger than :length character", ['val' => $_field_title, 'length' => \dash\fit::number($_meta['min'])]), ['element' => $_element, 'code' => 1607]);
				}
				return false;
			}
		}


		$data = preg_replace("/[\r\n]{2,}/", "\n", $data);

		if(isset($_meta['need_new_line']) && $_meta['need_new_line'])
		{
			// we dont remove \n because need new line
		}
		else
		{
			// remove \n from string
			$data = preg_replace("/[\n]/", " ", $data);
		}

		// remove 2 space in everywhere
		$data = preg_replace("/\h+/", " ", $data);

		$data_before = $data;

		$data = strip_tags($data);

		$data = str_replace('"',  '', $data);
		$data = str_replace("'",  '', $data);
		$data = str_replace("\\", '', $data);
		$data = str_replace("`",  '', $data);
		$data = str_replace('<?', '', $data);
		$data = str_replace('?>', '', $data);
		$data = str_replace('../', '', $data);
		$data = str_replace('<script', '', $data);


		if(mb_strlen($data_before) !== mb_strlen($data))
		{
			\dash\notif::warn(T_("We have removed some unauthorized characters from your text"), ['element' => $_element, 'code' => 1700]);
		}

		$data = addslashes($data);
		// trim needless to aletr to user
		$data = trim($data);

		return $data;
	}


	public static function title($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		return self::string($_data, $_notif, 200, $_element, $_field_title);
	}


	public static function address($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		return self::string($_data, $_notif, 200, $_element, $_field_title, ['min' => 5]);
	}


	public static function desc($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		return self::string($_data, $_notif, 1000, $_element, $_field_title, ['need_new_line' => true]);
	}



	public static function username($_data, $_notif = false, $_element = null, $_field_title = null)
	{

		$data = self::string($_data, $_notif, 50, $_element, $_field_title, ['min' => 5]);

		if($data === false)
		{
			return false;
		}

		$data = \dash\utility\convert::to_en_number($data);

		$data_before = $data;

		$data = preg_replace("/\_{2,}/", "_", $data);
		$data = preg_replace("/\-{2,}/", "-", $data);
		$data = str_replace('_-',  '', $data);
		$data = str_replace('-_',  '', $data);

		$data = trim($data, '_-');

		$data = mb_strtolower($data);

		if(!$data)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Username should contain a valid Latin letter"), ['element' => $_element, 'code' => 1750]);
			}
			return false;
		}

		if(mb_strlen($data_before) !== mb_strlen($data))
		{
			\dash\notif::warn(T_("We have removed _- characters from username"), ['element' => $_element, 'code' => 1700]);
		}

		// duble check because we remove some data
		if(mb_strlen($data) < 5)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Field username must be larger than 5 character"), ['element' => $_element, 'code' => 1607]);
			}
			return false;

		}


		if(!preg_match("/^[A-Za-z0-9_-]+$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Only [A-Za-z0-9_-] can use in username"), ['element' => $_element, 'code' => 1750]);
			}
			return false;
		}

		if(!preg_match("/[A-Za-z]+/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("You must use a one character from [A-Za-z] in the username"), ['element' => $_element, 'code' => 1750]);
			}
			return false;
		}

		if(is_numeric($data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Username should contain a Latin letter"), ['element' => $_element, 'code' => 1750]);
			}
			return false;
		}

		if(is_numeric(substr($data, 0, 1)))
		{
			if($_notif)
			{
				\dash\notif::error(T_("The username must begin with latin letters"), ['element' => $_element, 'code' => 1750]);
			}
			return false;
		}


		return $data;
	}




	public static function email($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = self::string($_data, $_notif, 50, $_element, $_field_title, ['min' => 5]);

		if($data === false)
		{
			return false;
		}

		if(!filter_var($data, FILTER_VALIDATE_EMAIL))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Email is invalid"), ['element' => $_element, 'code' => 1605]);
			}
			return false;
		}

		return $data;
	}


}
?>