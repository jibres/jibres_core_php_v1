<?php
namespace lib\app\export;

class directory
{

	private static function get($_type, $_name)
	{
		$master_dir = YARD. 'jibres_temp/stores/export/';
		$master_dir .= \lib\store::id().'/';
		$master_dir .= $_type. '/';

		if(!\dash\file::exists($master_dir))
        {
            \dash\file::makeDir($master_dir, null, true);
        }

        return $master_dir. $_name. '.csv';
	}


	public static function product($_name)
	{
		return self::get('product', $_name);
	}

	public static function form_answer($_name)
	{
		return self::get('form', $_name);
	}


}
?>