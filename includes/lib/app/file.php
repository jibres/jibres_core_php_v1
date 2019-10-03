<?php
namespace lib\app;


class file
{
	public static function multi_load($_ids)
	{
		if(!is_array($_ids))
		{
			return false;
		}

		$files = \dash\db\files::get_by_ids(implode(',', $_ids));
		if(is_array($files))
		{
			$files = array_map(['\\dash\\app\\file', 'ready'], $files);
		}

		return $files;
	}
}
?>