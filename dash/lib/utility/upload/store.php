<?php
namespace dash\utility\upload;


trait store
{

	public static function upload_store($_options = [])
	{
		$default_options =
		[
			'debug'        => null,
			'upload_name'  => null,
			'userstore_id' => null,
			'related'      => null,
			'related_id'   => null,
			'max_upload'   => null,
			'store_id'     => null,
		];

		$_options = array_merge($default_options, $_options);

		if(is_null($_options['max_upload']))
		{
			$_options['max_upload'] = self::max_file_upload_size();
		}

		// check upload name
		if(!$_options['upload_name'])
		{
			\dash\notif::error(T_("Upload name not found"));
			return false;
		}

		if(!$_options['store_id'])
		{
			\dash\notif::error(T_("Store id not found"));
			return false;
		}

		// 1. check upload process and validate it
		$invalid = self::invalid($_options['upload_name']);
		if($invalid)
		{
			// we have error in file
			return false;
		}

		if(self::$fileSize > $_options['max_upload'])
		{
			\dash\notif::error(T_("The size of file is larger than the upload space you have"), 'file', 'size');
			return false;
		}

		// 3. Check for record exist in db or not
		$duplicate = \dash\db\files::duplicate(self::$fileMd5);

		if($duplicate)
		{
			// in duplicate mode debug
			if($_options['debug'])
			{
				\dash\notif::ok(T_("File successful uploaded"));
			}

			return $duplicate;
		}

		$move_to    = root. 'public_html/';

		$folder_id  = 'files/';
		$folder_id  .= \dash\coding::encode($_options['store_id']);
		$folder_id  .= '/'. date("Ym");

		$folder_loc = $move_to . $folder_id;

		if($folder_loc && !is_dir($folder_loc))
		{
			\dash\file::makeDir($folder_loc, 0775, true);
		}

		$qry_count     = \dash\db\files::attachment_count();
		$file_id       = $qry_count + 1;

		$new_file_name = md5(self::$fileFullName). '.'. self::$fileExt;

		$url_full      = $folder_loc. '/'. $file_id. '-' . $new_file_name;

		$path = str_replace($move_to, '', $url_full);

		if(!self::transfer($url_full, $folder_loc))
		{
			\dash\notif::error(T_('Fail on tranfering file'));
			return false;
		}

		$file_ext   = self::$fileExt;

		switch ($file_ext)
		{
			case 'jpg':
			case 'jpeg':
			case 'png':
			case 'gif':
				$extlen     = mb_strlen(self::$fileExt);
				$url_file   = substr($url_full, 0, -$extlen-1);
				$url_thumb  = $url_file.'-thumb.'.self::$fileExt;
				$url_normal = $url_file.'-normal.'.self::$fileExt;
				$url_large = $url_file.'-large.'.self::$fileExt;

				\dash\utility\image::load($url_full);

				// large image
				\dash\utility\image::thumb(900, 600);
				\dash\utility\image::save($url_large);

				// normal image
				\dash\utility\image::thumb(600, 400);
				\dash\utility\image::save($url_normal);

				// thumb image
				\dash\utility\image::thumb(150, 150);
				\dash\utility\image::save($url_thumb);

				break;

			default:
				// nothing
				break;
		}


		$inset_files_record                 = [];
		$inset_files_record['userstore_id'] = $_options['userstore_id'];
		$inset_files_record['md5']          = self::$fileMd5;
		$inset_files_record['filename']     = self::$fileName ? addslashes(self::$fileName) : T_("Untitled file");
		$inset_files_record['title']        = null;
		$inset_files_record['desc']         = null;
		$inset_files_record['alt']          = null;
		$inset_files_record['type']         = self::$fileType;
		$inset_files_record['mime']         = self::$fileMime;
		$inset_files_record['ext']          = self::$fileExt;
		$inset_files_record['folder']       = $folder_id;
		$inset_files_record['path']         = $path;
		$inset_files_record['size']         = intval(self::$fileSize);
		$inset_files_record['status']       = null;
		$inset_files_record['datecreated']  = date("Y-m-d H:i:s");

		$new_id = \dash\db\files::insert($inset_files_record);

		if(!$new_id)
		{
			if($_options['debug'])
			{
				\dash\notif::error("Can not upload your file");
			}
			return false;
		}

		// $insert_file_usage                 = [];
		// $insert_file_usage['file_id']      = $new_id;
		// $insert_file_usage['userstore_id'] = $_options['userstore_id'];
		// $insert_file_usage['related']      = $_options['related'];
		// $insert_file_usage['related_id']   = $_options['related_id'];
		// $insert_file_usage['datecreated']  = date("Y-m-d H:i:s");

		// $new_usage_id = \dash\db\files::insert_usage($insert_file_usage);

		$inset_files_record['id'] = $new_id;

		if($_options['debug'])
		{
			\dash\notif::ok("File successful uploaded");
		}

		return $inset_files_record;
	}
}
?>