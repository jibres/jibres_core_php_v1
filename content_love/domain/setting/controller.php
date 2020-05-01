<?php
namespace content_love\domain\setting;


class controller
{
	public static function routing()
	{

		$id = \dash\validate::code(\dash\request::get('id'));
		if($id)
		{
			$id = \dash\coding::decode($id);
			$load_domain = \lib\app\nic_domain\get::only_by_id($id);

			if(!$load_domain)
			{
				\dash\header::status(403);
			}

			$load_domain = \lib\app\nic_domain\ready::row($load_domain);

			if(isset($load_domain['name']))
			{
				\dash\data::myDomain($load_domain['name']);
			}

			\dash\data::domainDetail($load_domain);
		}
		else
		{
			\dash\redirect::to(\dash\url::this());
		}


	}
}
?>