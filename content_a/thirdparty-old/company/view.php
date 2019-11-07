<?php
namespace content_a\thirdparty\company;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Company detail'));
		\dash\data::page_desc(T_('Set and check company detail for legal account.'));
		\dash\data::page_pictogram('registered');

		if(\dash\permission::check("thirdPartyPermissionChange"))
		{
			$perm_list = \dash\permission::groups();
			\dash\data::permGroup(array_keys($perm_list));
		}

		\content_a\thirdparty\load::fixTitle();
	}
}
?>
