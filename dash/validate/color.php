<?php
namespace dash\validate;

class color
{



	public static function color($_data, $_notif = false, $_element = null, $_field_title = null, $_meta = [])
	{
		$data = $_data;

		if($data === null || $data === '')
		{
			return null;
		}

		$meta        = $_meta;
		$meta['min'] = 4;
		$meta['max'] = 7;

		$data = \dash\validate\text::string($data, $_notif, $_element, $_field_title, $meta);

		if($data === false || $data === null)
		{
			return $data;
		}

		$color_reg  = "/^#[0-9a-f]{3}([0-9a-f]{3})?$/";

		if(!preg_match($color_reg, $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Invalid Color format"), ['element' => $_element]);
				\dash\cleanse::$status = false;
			}

			return false;
		}

		return $data;

	}
}
?>
