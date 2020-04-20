<?php
namespace content_my\domain\buy;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Buy domain"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		if(!\dash\data::haveBuyDomain())
		{
			if(\dash\data::getDomain())
			{
				$sugest_domain = \lib\app\nic_domain\suggestion::get(\dash\data::getDomain());
				\dash\data::domainSuggestion($sugest_domain);
			}

			$new_result = [];
			if(\dash\data::infoResult() && is_array(\dash\data::infoResult()))
			{
				foreach (\dash\data::infoResult() as $key => $value)
				{
					if(isset($value['tld']))
					{
						if($value['tld'] === 'ir')
						{
							$new_result['ir'][$key] = $value;
						}
						else
						{
							if(!isset($new_result['other']))
							{
								$new_result['other'] = [];
							}

							$new_result['other'][$key] = $value;
						}
					}
				}
			}

			\dash\data::domain_ir($new_result['ir']);
			\dash\data::domain_ir_other($new_result['other']);
		}

		if(\dash\data::haveBuyDomain())
		{
			$my_setting = \lib\app\nic_usersetting\get::get();
			if(isset($my_setting['ns1']) && $my_setting['ns1'])
			{
				// nothing
			}
			else
			{
				$my_setting['ns1'] = 'w.ns.arvancdn.com';
			}

			if(isset($my_setting['ns2']) && $my_setting['ns2'])
			{
				// nothing
			}
			else
			{
				$my_setting['ns2'] = 'f.ns.arvancdn.com';
			}

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