<?php
namespace content_a\setting\thirdparty\awss3;

class view
{
	public static function config()
	{
		\dash\face::title(T_('AWS S3'));

		// back
		\dash\data::back_text(T_('Third Party Services'));
		\dash\data::back_link(\dash\url::that());

		$data = \lib\app\setting\get::upload_provider();

		\dash\data::dataRow($data);

		\dash\data::awss3(a($data, 'aws'));

		if(\dash\detect\device::detectPWA())
		{
			\dash\face::btnSave('aThirdParty');
		}
	}
}
?>