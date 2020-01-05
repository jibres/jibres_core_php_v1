<?php
namespace content_a\setting\pos;


class model
{
	public static function post()
	{
		$post =
		[
			'barcode' =>  \dash\request::post('barcode'),
			'scale'   =>  \dash\request::post('scale')
		];

		\lib\app\setting\setup::save_pos($post);

	}
}
?>
