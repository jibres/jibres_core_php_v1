<?php
namespace content_my\domain\buy;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Buy domain"));

		\content_my\domain\stepGuide::set();
		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		\dash\notif::clean();
		\dash\engine\process::continue();


		\dash\data::irOneYearPrice(\lib\app\nic_domain\price::register('1year'));

		if(!\dash\data::haveBuyDomain())
		{
			if(\dash\data::getDomain())
			{
				$sugest_domain = \lib\app\nic_domain\suggestion::get(\dash\data::getDomain());
				\dash\data::domainSuggestion($sugest_domain);

				// $sugest_domain4 = \lib\app\nic_domain\suggestion::get4(\dash\data::getDomain());
				// \dash\data::domainSuggestion4($sugest_domain4);
			}

			$new_result = [];
			if(\dash\data::infoResult() && is_array(\dash\data::infoResult()))
			{
				foreach (\dash\data::infoResult() as $key => $value)
				{
					if(isset($value['tld']))
					{
						if(!isset($new_result['other']))
						{
							$new_result['other'] = [];
						}

						if($value['tld'] === 'ir')
						{
							$new_result['ir'][$key] = $value;
							$new_result['other'][$key] = $value;
						}
						else
						{
							$new_result['other'][$key] = $value;
						}
					}
				}
			}
			if(isset($new_result['ir']))
			{
				\dash\data::domain_ir($new_result['ir']);
			}

			if(isset($new_result['other']))
			{
				\dash\data::domain_ir_stat($new_result['other']);
			}
		}

		if(\dash\data::haveBuyDomain())
		{
			\dash\notif::clean();
			\dash\engine\process::continue();

			\dash\data::userSettingDataRow(\lib\app\nic_usersetting\get::get());

			\dash\data::internationalPriceList([]);
			$domain = \dash\data::myDomain();
			if(!\dash\validate::ir_domain($domain, false))
			{
				$price_list = \lib\app\onlinenic\price::get_list($domain, 'register');
				\dash\data::internationalPriceList($price_list);

			}
			\dash\notif::clean();
			\dash\engine\process::continue();

			\dash\data::defaultNDS1(\lib\app\nic_usersetting\defaultval::ns1(\dash\data::myDomain()));
			\dash\data::defaultNDS2(\lib\app\nic_usersetting\defaultval::ns2(\dash\data::myDomain()));

			$my_setting = \lib\app\nic_usersetting\get::get();

			if(isset($my_setting['autorenewperiod']))
			{
				$autorenewperiod = $my_setting['autorenewperiod'];
			}
			else
			{
				$autorenewperiod = \lib\app\nic_usersetting\defaultval::autorenewperiod();
			}

			$my_setting['autorenewperiod'] = $autorenewperiod;

			\dash\data::userSetting($my_setting);

			\dash\notif::clean();
			\dash\engine\process::continue();
			$list    = \lib\app\nic_contact\search::my_list();


			\dash\data::myContactList($list);
			if(is_array($list))
			{
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
}
?>