<?php
namespace dash\app\files;


class remove
{

	public static function remove($_id, $_force = false)
	{
		if(!\dash\permission::check('cmsManageAttachment'))
		{
			return false;
		}

		$id = \dash\coding::decode($_id);

		$load = \dash\app\files\get::inline_get($id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		$usage_list = \dash\db\files::get_usages($id);

		if($usage_list && !$_force)
		{
			\dash\notif::error(T_("This file is used in somewhere and can not be remove"));
			return false;
		}

		if($usage_list)
		{
			// need to load product record or post record and set null in galler or thumb
		}

		$position = 'jibres';
		if(\dash\engine\store::inStore())
		{
			$position = 'business';
		}

		$directory = \dash\upload\directory::move_to($position);

		$file_path = $directory. $load['path'];

		if(in_array($load['ext'], ['jpg', 'png', 'gif']))
		{
			$responsive_image = \dash\utility\image::responsive_image_size();

			foreach ($responsive_image as $width)
			{
				$new_path = str_replace('.'. $load['ext'], '-w'. $width. '.webp', $file_path);
				\dash\file::delete($new_path);
			}
		}

		\dash\file::delete($file_path);

		\dash\db\files::remove($load['id']);

		\dash\notif::ok(T_("File successfully removed"));

		return true;
	}


}
?>