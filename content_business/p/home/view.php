<?php
namespace content_business\p\home;

class view
{
	public static function config()
	{
		$id = \dash\data::dataRow_id();

		// auto add product to cart and redirec to cart
		if(\dash\request::key_exists('order', 'GET'))
		{
			$result = \lib\app\cart\add::new_cart_website($id, 1);
			\dash\redirect::to(\dash\url::kingdom(). '/cart');
		}
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());



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



		self::set_product_title_page();
	}


	private static function set_product_title_page()
	{

		\dash\face::title(\dash\data::dataRow_title() . ' | '. \lib\store::title());
		\dash\face::titlePWA(\lib\store::title());

		if(\dash\data::dataRow_thumb())
		{
			\dash\face::cover(\dash\data::dataRow_thumb());
			\dash\face::twitterCard('summary_large_image');
		}

		\dash\face::seo(\dash\data::dataRow_title());

		$currency = \lib\store::currency();
		$seo_desc = [];

		if(\dash\data::dataRow_finalprice() !== \dash\data::dataRow_price())
		{
			if(\dash\data::dataRow_price())
			{
				$seo_desc[] = T_("List Price"). ' '. \dash\fit::number(\dash\data::dataRow_price());
			}

			if(\dash\data::dataRow_discountpercent())
			{
				$seo_desc[] = T_("Discount"). ' '. \dash\fit::number(\dash\data::dataRow_discountpercent()). T_("%");
			}
		}

		if(\dash\data::dataRow_finalprice())
		{
			$seo_desc[] = T_("Price"). ' '. \dash\fit::number(\dash\data::dataRow_finalprice()). ' '. $currency;
		}

		if(\dash\data::dataRow_seodesc())
		{
			$seo_desc[] = \dash\data::dataRow_seodesc();
		}

		if(!empty($seo_desc))
		{
			$seo_desc = implode(' | ' , $seo_desc);
			\dash\face::desc($seo_desc);
		}
	}
}
?>