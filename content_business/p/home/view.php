<?php
namespace content_business\p\home;

class view
{
	public static function config()
	{
		$id = \dash\data::dataRow_id();

		// auto add product to cart and redirec to cart
		if(array_key_exists('order', $_GET))
		{
			$result = \lib\app\cart\add::new_cart_website($id, 1);
			\dash\redirect::to(\dash\url::kingdom(). '/cart');
		}


		\dash\face::title(\lib\store::title(). ' | '. \dash\data::dataRow_title());

		$property_list = \lib\app\product\property::get_pretty($id);
		\dash\data::propertyList($property_list);


		$customer_review = \lib\app\product\comment::customer_review($id);
		\dash\data::customerReview($customer_review);

		$commentList = \lib\app\product\comment::get_public_list(\dash\data::dataRow_id());
		\dash\data::commentList($commentList);


		$similar = \lib\app\product\search::get_similar_product(\dash\data::dataRow_id());
		\dash\data::similarProduct($similar);

		$product_setting = \lib\app\setting\get::product_setting();
		\dash\data::productSettingSaved($product_setting);


		$myCart = \lib\app\cart\search::my_detail();

		if($myCart && is_array($myCart))
		{
			foreach ($myCart as $key => $value)
			{
				if(isset($value['product_id']) && floatval($value['product_id']) === floatval($id))
				{
					\dash\data::productInCart(true);
					\dash\data::productInCartCount($value['count']);
				}
			}
		}
	}
}
?>