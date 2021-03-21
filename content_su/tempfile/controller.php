<?php
namespace content_su\tempfile;

class controller
{
	public static function routing()
	{
		$dir = \dash\url::directory();
		$dir = str_replace('tempfile', '', $dir);

		if($dir)
		{
			$addr = YARD. 'jibres_temp/'. $dir;
			$addr = \autoload::fix_os_path($addr);
			if(is_file($addr) || is_dir($addr))
			{
				\dash\open::get();
			}

		}

	}
}
?>