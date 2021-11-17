<?php
namespace content_a\setting\thirdparty\goftino;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Goftino'));

		// back
		\dash\data::back_text(T_('Third Party Services'));
		\dash\data::back_link(\dash\url::that());

		if(\dash\detect\device::detectPWA())
		{
			\dash\face::btnSave('aThirdParty');
		}
	}
}
?>