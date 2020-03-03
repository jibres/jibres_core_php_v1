<?php
namespace content_v2\category\property;


class view
{

	public static function config()
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

		\content_v2\tools::say($detail);

	}

}
?>