<?php
namespace dash\upload;

/**
 * Class for size.
 */
class directory
{
	/**
	 * Get upload directory
	 *
	 *
	 * use in this function and
	 * use in import product
	 *
	 * @param      string  $_type  The type
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function move_to($_type, $_remote_server = false)
	{
		$addr = null;

		if(!$_remote_server)
		{
			$addr .= YARD;
		}

		if($_type === 'jibres')
		{
			$addr .= 'talambar_dl/';
		}
		else
		{
			$addr .= 'talambar_cloud/';
		}

		if(\dash\url::isLocal())
		{
			$addr .= 'local/';
		}

		return $addr;
	}


	public static function get($_filename, $_remote_server = false)
	{
		if(\dash\engine\store::inStore())
		{
			return self::store_mode($_filename, $_remote_server);
		}
		else
		{
			return self::jibres_mode($_filename, $_remote_server);
		}
	}


	private static function store_mode($_filename, $_remote_server = false)
	{
		$move_to    = self::move_to('store', $_remote_server);


		$folder_id  = \dash\store_coding::encode_raw();
		$folder_id  .= '/'. date("Ym");

		$folder_loc = $move_to . $folder_id;

		if(!$_remote_server)
		{
			if($folder_loc && !is_dir($folder_loc))
			{
				\dash\file::makeDir($folder_loc, 0775, true);
			}
		}

		$qry_count     = \dash\db\files::attachment_count();
		$file_id       = $qry_count + 1;

		$full_addr      = $folder_loc. '/'. $file_id. '-'. $_filename;

		$path = str_replace($move_to, '', $full_addr);

		if(\dash\url::isLocal())
		{
			$path = 'local/'. $path;
		}


		$result           = [];
		$result['full']   = $full_addr;
		$result['path']   = $path;
		$result['folder'] = $folder_id;

		return $result;
	}



	public static function jibres_mode($_filename, $_remote_server = false)
	{
		$qry_count     = \dash\db\files::attachment_count();

		$move_to = self::move_to('jibres', $_remote_server);

		$folder_prefix = $move_to;

		$folder_id     = ceil(((int) $qry_count + 1) / 1000);

		$folder_loc    = $folder_prefix . $folder_id;

		if(!$_remote_server)
		{
			if($folder_loc && !is_dir($folder_loc))
			{
				\dash\file::makeDir($folder_loc, 0775, true);
			}
		}

		$file_id       = $qry_count % 1000 + 1;

		$full_addr      = $folder_loc. '/'. $file_id. '-'. $_filename;

		$path = str_replace($move_to, '', $full_addr);

		if(\dash\url::isLocal())
		{
			$path = 'local/'. $path;
		}

		$result           = [];
		$result['full']   = $full_addr;
		$result['path']   = $path;
		$result['folder'] = $folder_id;

		return $result;
	}

}
?>