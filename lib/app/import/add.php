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

		$file_name = 'import-products-'. date("Y-m-d"). '-'. date("His"). '-'. rand(11111, 99999);

		$file_detail = \dash\upload\importexport::push_import_file('import', $file_name, 'products');

		if(!$file_detail)
		{
			return false;
		}

		$insert =
		[
			'type'        => $_type,
			'mode'        => 'import',
			'file'        => $file_detail['path'],
			'meta'        => null,
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
