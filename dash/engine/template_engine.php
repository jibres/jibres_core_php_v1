<?php
namespace dash\engine;
/**
 * dash main configure
 */
class template_engine
{
	public static function shoot()
	{
		$nativeTemplate = \autoload::fix_os_path(root. ltrim(\dash\engine\mvc::get_dir_address().'\display.php', '\\'));

		if(is_file($nativeTemplate))
		{

			return true;
		}

		return false;
	}
}
?>
