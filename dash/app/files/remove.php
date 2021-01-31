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

		$remove_on_s3 = false;
		$provider     = null;
		$bucket       = null;

		if(isset($load['folder']) && substr($load['folder'], 0, 3) === 's3/')
		{
			$split = explode('/', $load['folder']);

			if(isset($split[1]))
			{
				$provider = $split[1];
			}

			if(isset($split[2]))
			{
				$bucket = $split[2];
			}

			if($provider && $bucket)
			{
				// try to remove
				\dash\utility\s3aws\s3::set_provider($provider);

				$file_removed = \dash\utility\s3aws\s3::delete_file($load['path']);

				if(in_array($load['ext'], ['jpg', 'png', 'gif']))
				{
					$responsive_image = \dash\utility\image::responsive_image_size();

					foreach ($responsive_image as $width)
					{
						$new_path = str_replace('.'. $load['ext'], '-w'. $width. '.webp', $load['path']);
						\dash\utility\s3aws\s3::delete_file($new_path);
					}
				}

				if($file_removed)
				{
					\dash\notif::ok(T_("File removed from s3 platform"));
				}
				else
				{
					\dash\notif::warn(T_("We can not remove this file from s3 platform"));
				}

			}
			else
			{
				\dash\notif::warn(T_("Can not remove your file from s3 platform"));
			}
		}
		else
		{
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
		}


		\dash\db\files::remove($load['id']);

		\dash\notif::ok(T_("File successfully removed"));

		return true;
	}


}
?>