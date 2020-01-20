<?php
namespace content_api\v1\product;


class property
{
	public static function route($_product_id)
	{
		if(\dash\request::is('get'))
		{
			$result = self::get_property($_product_id);
			\content_api\v1\tools::say($result);
		}
		else
		{
			\content_api\v1\tools::invalid_method();
		}
	}


	private static function get_property($_product_id)
	{
		$detail =
		[
			[
				'title'  => 'مشخصات فیزیکی',
				'list' =>
				[
					'وزن'    => '۹ کیلو گرم',
					'ابعاد' => '15*15*12',
				]
			],
			[
				'title'  => 'مشخصات فنی',
				'list' =>
				[
					'cpu'    => '۹ هسته ای',
					'garanty' => 'ایران جیبرس',
				]
			],

		];
		return $detail;
	}
}
?>