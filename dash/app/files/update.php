<?php
namespace dash\app\files;


class update
{
	public static function set_post_fileuseage_editor($_post_id)
	{

		$id = \dash\coding::decode($_post_id);

		if(!$id || !\dash\user::id())
		{
			return false;
		}

		$get_unknown_fileusage = \dash\db\files::set_unknown_fileusage('post_gallery_editor', \dash\user::id(), $id);

	}
}
?>