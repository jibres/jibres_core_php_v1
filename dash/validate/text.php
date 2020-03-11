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


		$data_before = $data;

		// remove \n from string
		$data = preg_replace("/[\n]/", " ", $data);

		// remove 2 space in everywhere
		$data = preg_replace("/\h+/", " ", $data);

		$data = strip_tags($data);

		$data = str_replace('"',  '', $data);
		$data = str_replace("'",  '', $data);
		$data = str_replace("\\", '', $data);
		$data = str_replace("`",  '', $data);
		$data = str_replace('<?', '', $data);
		$data = str_replace('?>', '', $data);
		$data = str_replace('../', '', $data);
		$data = str_replace('<script', '', $data);

		$data = addslashes($data);

		if(mb_strlen($data_before) !== mb_strlen($data))
		{
			\dash\notif::warn(T_("We have removed some unauthorized characters from your text"), ['element' => $_element, 'code' => 1700]);
		}

		// trim needless to aletr to user
		$data = trim($data);

		return $data;
	}

}
?>