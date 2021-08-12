<?php
namespace dash\upload;

/**
 * Class for size.
 */
class storage
{

	public static function limit()
	{
		if(\dash\engine\store::inStore())
		{
			if(is_numeric(\lib\store::detail('storage')))
			{
				$storage_limit = floatval(\lib\store::detail('storage')); // MB
				$storage_limit = $storage_limit * 1024 * 1024;
			}
			else
			{
				$storage_limit = 1000 * 1024 * 1024; // 1 GB
			}
		}
		else
		{
			// jibres have unlimit storage
			$storage_limit = 1000 * 1000 * 1024 * 1024; // 1TB
		}

		return $storage_limit;
	}


	public static function have_space($_size)
	{
		$storage_limit = self::limit();

		$total_used    = floatval(\dash\db\files::total_size());

		if(floatval($_size) + $total_used > $storage_limit )
		{
			\dash\log::debug_line(__LINE__, $_size, $total_used, $storage_limit);
			return false;
		}
		else
		{
			return true;
		}
	}

}
?>