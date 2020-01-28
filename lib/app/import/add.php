<?php
namespace lib\app\import;

class add
{
	public static function product()
	{
		$detail = self::new_import('product');
		if(!$detail || !isset($detail['id']))
		{
			return false;
		}

		$id = $detail['id'];

		$pre_check = \lib\app\import\product::pre_check($detail);

		if(!$pre_check)
		{
			\lib\db\import\update::set_failed($id);
			return false;
		}

		return true;

	}


	private static function new_import($_type)
	{
		$check_duplicate = \lib\db\import\get::check_duplicate($_type);
		if($check_duplicate)
		{
			\dash\notif::error(T_("Your request was saved before. please wait to import process is complete"));
			return false;
		}


		$check_day_limit = \lib\db\import\get::check_day_limit($_type, date("Y-m-d"));
		if(intval($check_day_limit) >= 5)
		{
			\dash\notif::error(T_("Your can make 5 import in every day"));
			return false;
		}

		$upload_setting =
		[
			'ext'        => 'csv',
			'allow_size' => (5*1024*1024),
		];

		$meta = [];

		$file_detail = \dash\upload\file::upload('import', $upload_setting);

		if(!$file_detail || !isset($file_detail['path']) || !isset($file_detail['id']))
		{
			return false;
		}

		$path = root. 'public_html/'. $file_detail['path'];

		$meta['id'] = $file_detail['id'];

		if($meta)
		{
			$meta = json_encode($meta, JSON_UNESCAPED_UNICODE);
		}
		else
		{
			$meta = null;
		}

		$insert =
		[
			'type'        => $_type,
			'mode'        => 'import',
			'file'        => $path,
			'meta'        => $meta,
			'creator'     => \dash\user::id(),
			'status'      => 'awaiting',
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$import_id = \lib\db\import\insert::new_record($insert);
		if($import_id)
		{
			$insert['id'] = $import_id;
			return $insert;
		}
		else
		{
			\dash\notif::ok(T_("Can not save your import request"));
			return false;
		}


	}
}
?>