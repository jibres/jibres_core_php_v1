<?php
namespace content_c\store\add;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Add New Store"));
		\dash\data::page_desc(T_("Add with simple detail and config more after adding new store."));

		$termLink = '<a href="'. \dash\url::kingdom(). '/terms" target="_blank">'. T_('Terms of Service') .'</a>';
		\dash\data::termOfService(T_("By press Create button, you're agreeing to our :term.", ['term' => $termLink]));
	}
}
?>
