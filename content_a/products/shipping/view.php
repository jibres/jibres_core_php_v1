<?php
namespace content_a\products\shipping;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		// set page title from product title
		$title = \dash\data::productDataRow_title();
		if(!isset($title))
		{
			$title = T_("Without name");
		}

		\dash\face::title(T_("Shipping"). ' | '. $title);

		\dash\face::btnSave('form1');

		$company_list = \lib\app\product\company::list();
		\dash\data::listCompanies($company_list);

		$unit_list = \lib\app\product\unit::list();
		\dash\data::listUnits($unit_list);

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));

		if(\dash\data::productDataRow_status() === 'deleted')
		{
			\dash\data::productIsDeleted(true);
			\dash\face::title($title. ' ('. T_("Deleted"). ')');

		}

	}
}
?>
