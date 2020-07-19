<?php
namespace dash\validate;
/**
 * Class for validate args
 */
class irnic
{

	public static function irnic_id($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);

		if($data === false || $data === null)
		{
			return $data;
		}


		if(!preg_match("/^[A-Za-z0-9\-]+$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid IRNIC id"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(substr_count($data, '-') > 1)
		{
			if($_notif)
			{
				\dash\notif::error(T_("The IRNIC id must have one separator"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(substr($data, -6) !== '-irnic')
		{
			$data = $data. '-irnic';
		}

		return $data;
	}



}
?>