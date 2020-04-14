<?php
namespace content_my\domain\buy;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Buy domain"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this());

		if(\dash\data::haveBuyDomain())
		{
			$my_setting = \lib\app\nic_usersetting\get::get();
			\dash\data::userSetting($my_setting);


			if(\lib\nic\mode::api())
			{
				$get_api = new \lib\nic\api();
				$list    = $get_api->contact_fetch_all();
			}
			else
			{
				$list    = \lib\app\nic_contact\search::my_list();
			}

			\dash\data::myContactList($list);
			foreach ($list as $key => $value)
			{
				if(isset($value['nic_id']))
				{
					if((isset($value['isdefault']) && $value['isdefault'] ) || count($list) === 1)
					{
						\dash\data::myContactListDefault($value['nic_id']);
					}
				}
			}

		}

	}
}
?>