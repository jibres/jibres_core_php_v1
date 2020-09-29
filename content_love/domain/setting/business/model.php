<?php
namespace content_love\domain\setting\business;


class model
{
	public static function post()
	{
		if(\dash\request::post('adddomain') === 'adddomain')
		{
			$post              = [];
			$post['domain']    = \dash\data::domainDetail_name();
			$post['domain_id'] = \dash\coding::decode(\dash\data::domainDetail_id());

			\lib\app\business_domain\add::add($post);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}
	}
}
?>