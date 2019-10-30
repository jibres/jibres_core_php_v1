<?php
namespace dash\utility\upload;


trait store
{


	/**
	 * upload and insert post record in database
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function store_upload($_options = [])
	{
		$default_options =
		[
			// the file path to download and move
			// @example : http://domain.com/file.jpg
			// @example : /var/www/html/file.jpg
			// leave null to get file from $_FILES
			'file_path'           => null,
			// the user inserted the attachment
			'user_id'             => false,
			// folder size of file
			// every folder have 1000 files
			'folder_size'         => 1000,
			// the upload name in <form> in html
			'upload_name'         => 'upfile',
			// file move to this location
			// if use from $_FILE this option is useless
			// the apache move the file to public_html of site
			// when you are set a file_path to download and move
			// we need to move() the file and the move() function need to real location
			'move_to'             => root. 'public_html/',
			// folder prefix
			// this option set after 'move_to' option
			// in upload mode [apache upload the file] this option afte folder public_html of site
			'folder_prefix'       => 'files/',
			// crop file [image file]
			// creat the thump image file
			'crop'                => true,
			// resize file
			// no thing ye...
			'resize'              => true,
			// copy file, we not delete the masert file
			// this option is useless because we get the file in tmp folder
			// we must to delete it
			'copy'                => false,
			'move'                => true,
			// the protocol of resive file
			// for example http, https, ftp,	sftp, null: local
			// we get the protocol from firt of 'file_path'
			// this method autmatic was set
			'protocol'            => null,
			// the user name of ftp or sftp protocol
			'username'            => null,
			// the password of ftp or sftp protocol
			'password'            => null,
			// the file meta in post talbe
			// default meta of post is mime, type, size, ext, url, thumb, normal
			// you can set this index to replace the index or inser new index to
			// merge this array and your array
			'meta'                => [],
			// the parent id of post record
			'parent'              => null,
			// the post status
			'status'              => 'draft',
			// save file in temp directory
			// whitout save in database
			'save_as_tmp'         => false,
			// the tmp_path
			'tmp_path'            => implode(DIRECTORY_SEPARATOR, ['files','tmp']). DIRECTORY_SEPARATOR,
			// use max size remaining
			'max_upload' => self::max_file_upload_size(),
			'debug'               => true,

		];

		// insert detail of this file to database

		$_options = array_merge($default_options, $_options);

		if(is_null($_options['max_upload']))
		{
			$_options['max_upload'] = self::max_file_upload_size();
		}

		// check upload name
		if(!$_options['upload_name'])
		{
			\dash\notif::error(T_("upload name not found"));
			return false;
		}

		// check foler prefix
		if(!$_options['folder_prefix'])
		{
			\dash\notif::error(T_("folder prefix not found"));
			return false;
		}

		// check user id
		// if((!$_options['user_id'] || !is_numeric($_options['user_id'])) && $_options['save_as_tmp'] === false)
		// {
		// 	\dash\notif::error(T_("user id not set"));
		// 	return false;
		// }

		if(isset($_options['user_id']))
		{
		}

		// get the protocol
		$protocol = null;

		// default upload file from upload in server
		// you can move from read path in new path
		// by set 'file_path' = [real file path]
		$upload_from_path = false;

		// check file path
		if($_options['file_path'] !== null)
		{
			if(preg_match("/^(http|https|ftp|sftp)\:/", $_options['file_path'], $protocol))
			{
				if(isset($protocol[1]))
				{
					$protocol = $protocol[1];
				}
			}

			$file_path = null;

			switch ($protocol)
			{
				case 'http':
				case 'https':
				case 'ftp':
				case 'sftp':
					$file_path = \dash\file::open($_options['file_path'], ['max_size' => $_options['max_upload']]);
					break;

				default:
					$file_path = $_options['file_path'];
					break;
			}

			self::$real_file_path   = $_options['file_path'];
			self::$upload_from_path = $file_path;
			$upload_from_path       = true;
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


		// save file as tmp in tmp_path
		if($_options['save_as_tmp'] === true)
		{
			return self::temp_donwload(null, $_options, true);
		}

		// 2. Generate file_id, folder_id and url


		$qry_count     = \dash\db\files::attachment_count();

		$folder_prefix = $_options['folder_prefix'];
		$folder_id     = ceil(((int) $qry_count + 1) / $_options['folder_size']);


		$folder_loc    = $folder_prefix . $folder_id;

		if($folder_loc && !is_dir($folder_loc))
		{
			\dash\file::makeDir($folder_loc, 0775, true);
		}

		$file_id       = $qry_count % $_options['folder_size'] + 1;

		if(self::$md5Name)
		{
			$new_file_name = md5(self::$fileFullName). '.'. self::$fileExt;
		}
		else
		{
			$new_file_name = self::$fileFullName;
		}


		$url_full      = "$folder_loc/$file_id-" . $new_file_name;


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

		// 4. transfer file to project folder with new name
		if($upload_from_path)
		{
			if(!\dash\file::rename(self::$upload_from_path, $_options['move_to']. $url_full, true))
			{
				\dash\notif::error(T_('Fail on tranfering file, upload from path'));
				return false;
			}
			$real_url_full = $_options['move_to']. $url_full;

			if($_options['copy'] === false || $_options['move'] === true)
			{
				\dash\file::delete(self::$upload_from_path);
			}
		}
		else
		{
			if(!self::transfer($url_full, $folder_loc))
			{
				\dash\notif::error(T_('Fail on tranfering file'));
				return false;
			}
			$real_url_full = $url_full;
		}

		$file_ext   = self::$fileExt;


		$url_thumb  = null;
		$url_normal = null;


		// 5. get filemeta data
		$file_meta         = [];
		$file_meta['mime'] = self::$fileMime;
		$file_meta['type'] = self::$fileType;
		$file_meta['size'] = self::$fileSize;
		$file_meta['ext']  = $file_ext;
		$file_meta['url']  = $url_full;


		switch ($file_ext)
		{
			case 'jpg':
			case 'jpeg':
			case 'png':
			case 'gif':
				if($_options['crop'] === true)
				{
					$extlen     = mb_strlen(self::$fileExt);
					$url_file   = substr($url_full, 0, -$extlen-1);
					$url_thumb  = $url_file.'-thumb.'.self::$fileExt;
					$url_normal = $url_file.'-normal.'.self::$fileExt;
					$url_large = $url_file.'-large.'.self::$fileExt;

					\dash\utility\image::load($real_url_full);

					// large image
					\dash\utility\image::thumb(900, 600);
					\dash\utility\image::save($url_large);
					$file_meta['large'] = $url_large;

					// normal image
					\dash\utility\image::thumb(600, 400);
					\dash\utility\image::save($url_normal);
					$file_meta['normal'] = $url_normal;

					// thumb image
					\dash\utility\image::thumb(150, 150);
					\dash\utility\image::save($url_thumb);
					$file_meta['thumb']  = $url_thumb;

					$option_crop_size = \dash\option::config('crop_size');
					if($option_crop_size && is_array($option_crop_size))
					{
						foreach ($option_crop_size as $key => $value)
						{
							if(isset($value[0]) && isset($value[1]))
							{
								$key_url = $url_file. '-'. $key. '.'. self::$fileExt;
								\dash\utility\image::thumb($value[0], $value[1]);
								\dash\utility\image::save($key_url);
								$file_meta[$key]  = $url_thumb;
							}
						}
					}
				}
				break;
		}


		$file_meta = array_merge($file_meta, $_options['meta']);

		$url_slug = self::$fileMd5;
		$url_body = $folder_id. "_". $file_id;
		$page_url = self::sp_generateUrl($url_slug, $url_body, $file_meta['type']. "/");

		if( strpos($file_meta['mime'], 'image') !== false)
		{
			list($file_meta['width'], $file_meta['height']) = getimagesize($url_full);
		}

		$file_meta = json_encode($file_meta, JSON_UNESCAPED_UNICODE);

		// 6. add uploaded file record to db
		// $insert_attachment =
		// [
		// 	'title'       => self::$fileName ? addslashes(self::$fileName) : rand(1,999),
		// 	'slug'        => self::$fileMd5,
		// 	'meta'        => $file_meta,
		// 	'type'        => 'attachment',
		// 	'url'         => $page_url,
		// 	'user_id'     => $_options['user_id'],
		// 	'status'      => $_options['status'],
		// 	'parent'      => $_options['parent'],
		// 	'publishdate' => date('Y-m-d H:i:s')
		// ];
		// $new_id = \dash\db\posts::insert($insert_attachment);

		$inset_files_record                = [];
		$inset_files_record['user_id']     = $_options['user_id'];
		$inset_files_record['md5']         = self::$fileMd5;
		$inset_files_record['filename']    = self::$fileName ? addslashes(self::$fileName) : rand(1,999);
		$inset_files_record['title']       = null;
		$inset_files_record['desc']        = null;
		$inset_files_record['useage']      = null;
		$inset_files_record['type']        = self::$fileType;
		$inset_files_record['mime']        = self::$fileMime;
		$inset_files_record['ext']         = self::$fileExt;
		$inset_files_record['folder']      = $folder_id;
		$inset_files_record['path']        = $url_full;
		// $inset_files_record['meta']        = $file_meta;

		if(\dash\option::config('upload_subdomain'))
		{
			$master_file_url  = '';
			$master_file_url .= \dash\url::protocol(). '://';
			$master_file_url .= \dash\option::config('upload_subdomain'). '.';
			$master_file_url .= \dash\url::domain(). '/';
			$master_file_url .= $url_full;
		}
		else
		{
			$master_file_url = \dash\url::site(). '/'. $url_full;
		}

		$inset_files_record['url']         = $master_file_url;
		$inset_files_record['size']        = intval(self::$fileSize);
		$inset_files_record['status']      = $_options['status'];
		$inset_files_record['datecreated'] = date("Y-m-d H:i:s");

		$new_id = \dash\db\files::insert($inset_files_record);

		$inset_files_record['id'] = $new_id;

		$url = \dash\temp::get('upload');

		if(isset($url['url']))
		{
			$url = $url['url'];
		}
		else
		{
			$url = null;
		}
		\dash\temp::set('upload', ["id" => \dash\db::insert_id(), 'url' => $url, 'size' => self::$fileSize]);
		if($_options['debug'])
		{
			\dash\notif::ok("File successful uploaded");
		}

		return $inset_files_record;
	}
}
?>