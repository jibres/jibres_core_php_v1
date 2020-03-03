<?php
namespace content_v2\product\property;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

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

		\content_v2\tools::say($detail);
	}

}
?>