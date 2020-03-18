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

		$upload_setting =
		[
			'ext'        => ['csv'],
			'allow_size' => (5*1024*1024),
		];

		$meta = [];

		$file_detail = \dash\upload\file::upload('import', $upload_setting);
		if(!$file_detail || !isset($file_detail['path']) || !isset($file_detail['id']))
		{
			return false;
		}

		$path = \dash\upload\directory::move_to('store'). $file_detail['path'];


		$meta['file_id'] = $file_detail['id'];

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

		$get_last_awaiting = \lib\db\import\get::get_last_awaiting($_type);
		if(isset($get_last_awaiting['id']))
		{
			\lib\db\import\update::set_cancel($get_last_awaiting['id']);
		}

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
