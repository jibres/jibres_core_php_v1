<?php
namespace dash\upload;

/**
 * Class for size.
 */
class storage
{

	public static function have_space($_size)
	{
		if(\dash\engine\store::inStore())
		{
			if(is_numeric(\lib\store::detail('storage')))
			{
				$storage_limit = floatval(\lib\store::detail('storage'));
			}
			else
			{
				$storage_limit = 100 * 1024 * 1024; // 100 MB
			}

			$total_used    = floatval(\dash\db\files::total_size());

			if(floatval($_size) + $total_used > $storage_limit )
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			// jibres have unlimit storage
			return true;
		}
	}

}
?>