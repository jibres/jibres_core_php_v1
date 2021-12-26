<?php
namespace content_b1\product\detail;


class view
{
	public static function config()
	{
		$id      = \dash\request::get('id');

		$barcode = \dash\request::get('barcode');

		$detail = [];

		if($id)
		{
			$detail = \lib\app\product\load::site($id, ['api_mode' => true]);
		}
		elseif($barcode)
		{
			$detail = \lib\app\product\load::site_by_barcode($barcode, ['api_mode' => true]);
		}


		\content_b1\tools::say($detail);
	}

}
?>