<?php
namespace content_enter\loginas;


class view
{
	public static function config()
	{
		// \dash\data::page_title(T_('Login as'));
		\dash\data::page_desc(\dash\data::page_title());

		$logitToSubdomain = \dash\data::logitToSubdomain();

		$load_store_detail = \lib\app\store\get::by_subdomain($logitToSubdomain);
		if(isset($load_store_detail['id']))
		{
			$load_store_detail_data = \lib\app\store\get::data_by_id($load_store_detail['id']) ;

			if(!isset($load_store_detail_data['id']))
			{
				\dash\redirect::to(\dash\url::kingdom());
			}

			if(array_key_exists('logo', $load_store_detail_data) && !$load_store_detail_data['logo'])
			{
				$load_store_detail_data['logo'] = \dash\app::static_logo_url();
			}

			\dash\data::joinToStore($load_store_detail_data);
		}

	}
}
?>