<?php
namespace content_a\setting\thirdparty\crisp;

class view
{
	public static function config()
	{
		\dash\face::title('Crisp');

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