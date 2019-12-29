<?php
namespace content_a\products\edit;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		// set page title from product title
		$title = \dash\data::productDataRow_title();
		if(!isset($title))
		{
			$title = T_("Whitout name");
		}

		\dash\data::page_title($title);

		$nex_prev_product = \lib\app\product\get::next_prev($id);
		if(isset($nex_prev_product['next']))
		{
			// nav
			\dash\data::page_next($nex_prev_product['next']);
		}
		else
		{
			\dash\data::page_next('disabled');
		}

		$nex_prev_product = \lib\app\product\get::next_prev($id);
		if(isset($nex_prev_product['prev']))
		{
			// nav
			\dash\data::page_prev($nex_prev_product['prev']);
		}
		else
		{
			\dash\data::page_prev('disabled');
		}


		// back
		\dash\data::page_backText(T_('Products'));
		\dash\data::page_backLink(\dash\url::this());


		\dash\data::page_view(\dash\url::here());
		// \dash\data::page_help(\dash\url::kingdom().'/support/test');

		// back to list of product
		\dash\data::badge_text(T_('Back'));
		\dash\data::badge_link(\dash\url::this());

		$variants_list = \lib\app\product\variants::get($id);
		\dash\data::variantsList($variants_list);

		$company_list = \lib\app\product\company::list();
		\dash\data::listCompanies($company_list);

		$unit_list = \lib\app\product\unit::list();
		\dash\data::listUnits($unit_list);

		$category_list = \lib\app\product\category::list();
		\dash\data::listCategory($category_list);


		$tag_list = \lib\app\product\tag::get($id);
		if(is_array($tag_list) && $tag_list)
		{
			$tagString = implode(',', array_column($tag_list, 'title'));
			\dash\data::tagString($tagString);
		}
		\dash\data::listTag($tag_list);


		$productDataRow = \dash\data::productDataRow();
		if(isset($productDataRow['parent']) && $productDataRow['parent'])
		{

			$parent = \lib\app\product\get::inline_get($productDataRow['parent']);
			\dash\data::productDataRow_parentDetail($parent);

			$family = \lib\app\product\variants::family($productDataRow['parent']);
			\dash\data::productFamily($family);

			$haveOtherChild = false;
			if(is_array($family))
			{
				foreach ($family as $key => $value)
				{
					if(isset($value['id']) && intval($value['id']) !== intval($id))
					{
						$haveOtherChild = true;
						break;
					}
				}
			}

			\dash\data::haveOtherChild($haveOtherChild);
		}
		else
		{
			// \dash\data::page_duplicate(\dash\url::this(). '/duplicate?id='. $id);
		}
	}
}
?>
