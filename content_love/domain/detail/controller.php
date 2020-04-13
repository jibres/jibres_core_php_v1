<?php
namespace content_love\domain\detail;


class controller
{
	public static function routing()
	{


		$id = \dash\request::get('id');

		if($id)
		{
			$load_domain = \lib\app\nic_domain\get::only_by_id($id);
			if(!$load_domain)
			{
				\dash\header::status(403);
			}

			\dash\data::myDomain($load_domain['name']);
			\dash\data::domainDetail($load_domain);
		}
		else
		{
			\dash\redirect::to(\dash\url::this());
		}


	}
}
?>