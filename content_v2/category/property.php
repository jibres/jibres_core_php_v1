<?php
namespace content_v2\category;


class property
{
	public static function route($_category_id)
	{
		if(\dash\request::is('get'))
		{
			$result = self::property($_category_id);
			\content_v2\tools::say($result);
		}
		else
		{
			\content_v2\tools::invalid_method();
		}
	}


	private static function property($_category_id)
	{
		$detail =
		[
			[
				'title' => 'مشخصات فیزیکی',
				'list'  =>
				[
					'وزن'   => ['۹ کیلو گرم', '۱۲ کیلو گرم', '۱۸ کیلو گرم'],
					'ابعاد' => ['15*15*12'],
				]
			],
			[
				'title' => 'مشخصات فنی',
				'list'  =>
				[
					'cpu'     => ['۹ هسته ای', '۳ هسته ای'],
					'garanty' => ['ایران جیبرس'],
				]
			],

		];
		return $detail;
	}


}
?>