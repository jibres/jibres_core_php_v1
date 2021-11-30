<?php
namespace content_site\footer;


class share
{



	public static function set_responsive_option_footer()
	{
		if(\dash\permission::supervisor())
		{
			return
			[
				'responsive_footer' =>
				[
					'responsive_footer_btn_title',
					'responsive_footer_btn_icon',
					'responsive_footer_btn_link',
				],
			];
		}
		return [];

	}
}
?>