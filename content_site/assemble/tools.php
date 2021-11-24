<?php
namespace content_site\assemble;


class tools
{

	public static function section_id($_model, $_id)
	{
		return 'id="'.self::section_id_raw(...func_get_args()).'"';
	}

	public static function section_id_raw($_model, $_id)
	{
		return $_model. '-'. $_id;
	}

}
?>