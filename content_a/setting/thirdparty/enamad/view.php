<?php
namespace content_a\setting\thirdparty\enamad;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Enamad'));

		// back
		\dash\data::back_text(T_('Third Party Services'));
		\dash\data::back_link(\dash\url::that());

		if(\dash\detect\device::detectPWA())
		{
			\dash\face::btnSave('aThirdParty');
		}

		$storeData = \dash\data::store_store_data();
		$enamad = isset($storeData['enamad']) ? $storeData['enamad'] : null;
		if($enamad)
		{
			$explode_enamad = explode('_', $enamad);
			if(isset($explode_enamad[0]))
			{
				\dash\data::enamadID($explode_enamad[0]);
			}

			if(isset($explode_enamad[1]))
			{
				\dash\data::enamadCode($explode_enamad[1]);
			}
		}

		$get = \lib\app\setting\tools::get('enamad', 'enamad_static_file');
		if(isset($get['value']))
		{
			\dash\data::enamadStaticFile($get['value']);
		}
	}
}
?>