<?php
namespace lib\app\business_domain;

class filter
{
	use \dash\datafilter;

	public static function sort_list_array($_module = null)
	{
		// public => true means show in api and site


		$sort_list[] = ['title' => T_("Domain name ASC"), 		'query' => ['sort' => 'domain',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Domain name DESC"), 		'query' => ['sort' => 'domain',		 'order' => 'desc'], 	'public' => false];


		return $sort_list;
	}




	private static function list_of_filter($_module = null)
	{

		$list = [];

		$all_status = ['pending','failed','ok','pending_delete','deleted','inprogress','dns_not_resolved'];
		foreach ($all_status as $key => $value)
		{
			$list['status_'. $value] =
			[
				'key'            => 'status_'. $value,
				'group'          => T_("Status"),
				'title'          => T_(ucfirst($value)),
				'query'			 => ['status' => $value],
				'public'         => false,
			];

		}


		$all_cdn = ['arvancloud', 'cloudflare', 'enterprise',];

		foreach ($all_cdn as $key => $value)
		{
			$list['cdn_'. $value] =
			[
				'key'            => 'cdn_'. $value,
				'group'          => T_("CDN"),
				'title'          => T_(ucfirst($value)),
				'query'			 => ['cdn' => $value],
				'public'         => false,
			];
		}

		$list['have_subdomain']           = ['key' => 'have_subdomain' , 		'group'  => T_("Subdomain"), 'title' => T_("With subdomain"), 		'query' => ['ws' => 'y'], 'public' => false, ];
		$list['have_not_subdomain']       = ['key' => 'have_not_subdomain' , 	'group'  => T_("Subdomain"), 'title' => T_("Without subdomain"),  'query' => ['ws' => 'n'], 'public' => false, ];

		$list['have_master']              = ['key' => 'have_master' , 			'group'  => T_("Master domain"), 'title' => T_("Is master domain"), 		'query' => ['md' => 'y'], 'public' => false, ];
		$list['have_not_master']          = ['key' => 'have_not_master' , 		'group'  => T_("Master domain"), 'title' => T_("Is not master domain"),  'query' => ['md' => 'n'], 'public' => false, ];
		$list['have_redirect_master']     = ['key' => 'have_redirect_master' , 	'group'  => T_("Master domain"), 'title' => T_("Is enable redirect to master domain"), 		'query' => ['rtmd' => 'y'], 'public' => false, ];
		$list['have_not_redirect_master'] = ['key' => 'have_notredirect_master','group'  => T_("Master domain"), 'title' => T_("Is not enable redirect to master domain"),  'query' => ['rtmd' => 'n'], 'public' => false, ];


		$list['have_domain_id']           = ['key' => 'have_domain_id' , 		'group'  => T_("Domain"), 'title' => T_("Have domain id"), 		'query' => ['hdid' => 'y'], 'public' => false, ];
		$list['have_not_domain_id']       = ['key' => 'have_not_domain_id' , 	'group'  => T_("Domain"), 'title' => T_("Have not domain id"),  'query' => ['hdid' => 'n'], 'public' => false, ];

		$list['have_store_id']            = ['key' => 'have_store_id' , 		'group'  => T_("Business"), 'title' => T_("Connect to business"), 		'query' => ['cb' => 'y'], 'public' => false, ];
		$list['have_not_store_id']        = ['key' => 'have_not_store_id' , 	'group'  => T_("Business"), 'title' => T_("Not connect to business"),  'query' => ['cb' => 'n'], 'public' => false, ];


		$list['check_dns_ok']             = ['key' => 'check_dns_ok' , 			'group'  => T_("DNS"), 'title' => T_("DNS resolved"), 		'query' => ['checkdns' => 'y'], 'public' => false, ];
		$list['check_dns_nok']            = ['key' => 'check_dns_ok' , 			'group'  => T_("DNS"), 'title' => T_("DNS not resolved"), 		'query' => ['checkdns' => 'n'], 'public' => false, ];
		$list['dns_ok']                   = ['key' => 'dns_ok' , 				'group'  => T_("DNS"), 'title' => T_("DNS ok"), 		'query' => ['dnsok' => 'y'], 'public' => false, ];
		$list['dns_nok']                  = ['key' => 'dns_ok' , 				'group'  => T_("DNS"), 'title' => T_("DNS not ok"), 		'query' => ['dnsok' => 'n'], 'public' => false, ];

		$list['cdn_panel_ok']             = ['key' => 'cdn_panel_ok' , 			'group'  => T_("DNS"), 'title' => T_("DNS resolved"), 		'query' => ['cdnpanale' => 'y'], 'public' => false, ];
		$list['cdn_panel_nok']            = ['key' => 'cdn_panel_ok' , 			'group'  => T_("DNS"), 'title' => T_("DNS not resolved"), 		'query' => ['cdnpanale' => 'n'], 'public' => false, ];

		$list['https_request_ok']         = ['key' => 'https_request_ok' , 		'group'  => T_("HTTPS"), 'title' => T_("HTTPS request sended"), 		'query' => ['httpsrequest' => 'y'], 'public' => false, ];
		$list['https_request_nok']        = ['key' => 'https_request_ok' , 		'group'  => T_("HTTPS"), 'title' => T_("HTTPS request not sended"), 		'query' => ['httpsrequest' => 'n'], 'public' => false, ];
		$list['https_verify_ok']          = ['key' => 'https_verify_ok' , 		'group'  => T_("HTTPS"), 'title' => T_("HTTPS verify sended"), 		'query' => ['httpsverify' => 'y'], 'public' => false, ];
		$list['https_verify_nok']         = ['key' => 'https_verify_ok' , 		'group'  => T_("HTTPS"), 'title' => T_("HTTPS verify not sended"), 		'query' => ['httpsverify' => 'n'], 'public' => false, ];



		return $list;

	}

}
?>