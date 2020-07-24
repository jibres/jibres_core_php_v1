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
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::title(\lib\store::title(). ' | '. \dash\data::dataRow_title());
		\dash\face::titlePWA(\lib\store::title());

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


		$myCart = \lib\website::cart_detail();

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

		if(\dash\data::dataRow_child() && is_array(\dash\data::dataRow_child()) && count(\dash\data::dataRow_child()) === 1)
		{
			$child = \dash\data::dataRow_child();
			if(isset($child[0]))
			{
				$child = $child[0];
				if(isset($child['id']) && \dash\data::dataRow_id() != $child['id'])
				{
					\dash\redirect::to($child['url']);
				}
			}
		}
		// pwa header
		// \dash\data::menu_link(true);
		\dash\data::cart_link(\dash\fit::number(\lib\website::cart_count()));
		\dash\data::search_link(\dash\url::kingdom().'/search');
	}
}
?>