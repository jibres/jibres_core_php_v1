<?php
namespace content_subdomain\p\home;

class view
{
	public static function config()
	{
		$id = \dash\data::dataRow_id();

		\dash\face::title(\lib\store::title(). ' | '. \dash\data::dataRow_title());

		$property_list = \lib\app\product\property::get_pretty($id);
		\dash\data::propertyList($property_list);


		$customer_review = \lib\app\product\comment::customer_review($id);
		\dash\data::customerReview($customer_review);
	}
}
?>