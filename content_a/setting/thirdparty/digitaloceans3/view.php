<?php
namespace content_a\setting\thirdparty\digitaloceans3;

class view
{
	public static function config()
	{
		\dash\face::title(T_('DigitalOcean S3'));

		// back
		\dash\data::back_text(T_('Third Party Services'));
		\dash\data::back_link(\dash\url::that());

		$data = \lib\app\setting\get::upload_provider();

		\dash\data::dataRow($data);

		\dash\data::digitaloceans3(a($data, 'digitalocean'));

		if(\dash\detect\device::detectPWA())
		{
			\dash\face::btnSave('aThirdParty');
		}
	}
}
?>