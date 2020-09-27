<?php
namespace content_my\domain\setting\business;


class view
{
	public static function config()
	{
		\dash\face::title(\dash\data::domainDetail_name());

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this(). '/search');

		$myStore = \lib\app\store\mystore::list();

		if(isset($myStore['owner']) && is_array($myStore['owner']))
		{
			$myStore = $myStore['owner'];
		}
		else
		{
			$myStore = [];
		}


		\dash\data::myBusinessList($myStore);

		$myStoreIDS = array_column($myStore, 'store_id');

		$load_domain = \lib\app\business_domain\get::is_customer_domain(\dash\data::domainDetail_name());

		$domainConnected                = [];
		$domainConnectedToMyBusiness    = [];

		if(isset($load_domain['id']))
		{
			$domainConnected['ok'] = true;

			if(isset($load_domain['store_id']))
			{
				if(in_array($load_domain['store_id'], $myStoreIDS))
				{

					$domainConnectedToMyBusiness['ok'] = true;

					foreach ($myStore as $key => $value)
					{
						if(isset($value['store_id']) && floatval($value['store_id']) === floatval($load_domain['store_id']))
						{
							$domainConnectedToMyBusiness['detail'] = $value;
						}
					}
					// connected to my store
				}
			}
			else
			{
				// unknown error!
			}
		}
		else
		{
			// not connected to my store
		}

		\dash\data::domainConnected($domainConnected);
		\dash\data::domainConnectedToMyBusiness($domainConnectedToMyBusiness);

	}
}
?>