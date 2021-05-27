<?php
namespace content_love\business\domain\detail;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain Detail"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::that());

		\content_love\business\domain\load::dashboardDetail();


		if(\dash\data::dataRow_store_id())
		{
			$load_store = \lib\app\store\get::data_by_id(\dash\data::dataRow_store_id());
			\dash\data::storeDetail($load_store);

			if(isset($load_store['owner']))
			{
				$user_id = \dash\coding::encode($load_store['owner']);
				$user_detail = \dash\app\user::get($user_id);
				\dash\data::ownerDetail($user_detail);
			}




		}



	}
}
?>
