<?php
namespace content_crm;

class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);

		\dash\upload\size::set_default_file_size('crm');


		\dash\data::include_m2(true);
		\dash\data::include_m2_search(\dash\url::kingdom(). '/a/setting/search/full');
		\dash\data::include_m2_searchPlaceHolder(T_('Search'));
	}
}
?>