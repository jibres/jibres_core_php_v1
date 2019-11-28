<?php
namespace content_api\v1\category;


class datalist
{
	public static function route()
	{
		if(\dash\request::is('get'))
		{
			$result = self::list();
			\content_api\v1::say($result);
		}
		else
		{
			\content_api\v1::invalid_method();
		}
	}


	private static function list()
	{
		$detail = [];
		$detail[] =
		[
			'id'    => '2kf',
			'title' => 'Category 1',
			'image' => \content_api\v1\app\controller::sample_image(10),
		];

		$detail[] =
		[
			'id'    => '2kg',
			'title' => 'Category 2',
			'image' => \content_api\v1\app\controller::sample_image(11),
		];

		return $detail;
	}
}
?>