<?php
namespace content_a\setting\enamad;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Enamad'));
		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here(). '/website');

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
	}
}
?>