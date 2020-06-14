<?php
namespace content_b1\product\comment;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		$result = \lib\app\product\comment::approved_of_product($id);

		$detail = [];
		$detail['star'] =
		[
			'total'  => 4.5,
			'person' => 182,
			'1'      => 2,
			'2'      => 3,
			'3'      => 2,
			'4'      => 2,
			'5'      => 1,
		];
		$detail['list'] = $result;

		\content_b1\tools::say($detail);
	}
}
?>