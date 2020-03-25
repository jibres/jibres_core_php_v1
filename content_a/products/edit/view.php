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

		\dash\face::title($title);

		\dash\face::btnNext(\dash\url::this(). '/next/'. \dash\request::get('id'));
		\dash\face::btnPrev(\dash\url::this(). '/prev/'. \dash\request::get('id'));


		// back
		\dash\data::back_text(T_('Products'));
		\dash\data::back_link(\lib\backlink::products());


		if(\dash\data::productDataRow_url())
		{
			\dash\face::btnView(\dash\data::productDataRow_url());
		}




		$variants_list = \lib\app\product\variants::get($id);
		\dash\data::variantsList($variants_list);

		$company_list = \lib\app\product\company::list();
		\dash\data::listCompanies($company_list);

		$unit_list = \lib\app\product\unit::list();
		\dash\data::listUnits($unit_list);

		$category_list = \lib\app\category\search::list();
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
			\dash\face::btnDuplicate(\dash\url::this(). '/duplicate?id='. $id);
		}
	}
}
?>
