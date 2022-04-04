<?php
namespace lib\app\domains;


class get
{
	public static function my_domain_id_api()
	{

		$id     = \dash\request::get('id');
		$domain = \dash\request::get('domain');

		if($domain && !$id)
		{
			$load_domain = \lib\app\nic_domain\get::is_my_domain($domain);

			if(!$load_domain)
			{
				\dash\header::status(403);
			}

			if(isset($load_domain['verify']) && $load_domain['verify'])
			{
				// no problem
			}
			else
			{
				if(in_array(\dash\url::subchild(), ['holder', 'dns', 'transfer']))
				{
					\dash\header::status(403, T_("Can not change this domain detail"));
				}
			}

			$id = a($load_domain, 'id');
		}

		if(!$id)
		{
			\dash\header::status(403);
		}

		return $id;
	}
}
?>