<?php
namespace content_a\products\edit;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');



		\dash\face::title(T_("Edit Product"));

		\dash\face::btnNext(\dash\url::this(). '/next/'. \dash\request::get('id'));
		\dash\face::btnPrev(\dash\url::this(). '/prev/'. \dash\request::get('id'));
		\dash\face::btnSave('aProductData');
		\dash\face::btnSaveValue('master');


		// back
		\dash\data::back_text(T_('Products'));
		\dash\data::back_link(\lib\backlink::products());


		if(\dash\data::productDataRow_url())
		{
			\dash\face::btnView(\dash\data::productDataRow_url());
		}


		\dash\data::maxUploadSize(\dash\upload\size::MB(1, true));


		$variants_list = \lib\app\product\variants::get($id);
		\dash\data::variantsList($variants_list);

		$company_list = \lib\app\product\company::list();
		\dash\data::listCompanies($company_list);

		$unit_list = \lib\app\product\unit::list();
		\dash\data::listUnits($unit_list);

		$category_list = \lib\app\category\get::all_category();
		$category_list = array_reverse($category_list);
		\dash\data::listCategory($category_list);

		$all_tag = \lib\app\product\tag::all_tag();
		\dash\data::allTagList($all_tag);

		$tag_list = \lib\app\product\tag::get($id);
		if(!is_array($tag_list))
		{
			$tag_list = [];
		}
		\dash\data::tagsSavedTitle(array_column($tag_list, 'title'));


		$property_list = \lib\app\product\property::get_count($id);
		\dash\data::propertyCount($property_list);

		$comment_list = \lib\app\product\comment::get_count($id);
		\dash\data::commentCount($comment_list);

		$cat_list = \lib\app\category\get::product_cat($id);
		if(is_array($cat_list) && $cat_list)
		{
			$cat_list = array_column($cat_list, 'title');
		}
		else
		{
			$cat_list = [];
		}

		\dash\data::listSavedCat($cat_list);


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
					if(isset($value['id']) && floatval($value['id']) !== floatval($id))
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


		if(\dash\data::productDataRow_status() === 'deleted')
		{
			\dash\data::productIsDeleted(true);
			$title = \dash\data::productDataRow_title();
			\dash\face::title($title. ' ('. T_("Deleted"). ')');

		}

		$productSettingSaved = \lib\app\setting\get::product_setting();
		\dash\data::productSettingSaved($productSettingSaved);

		$productImageRatioHtml = 'data-ratio=1 data-ratio-free';
		if(isset($productSettingSaved['ratio_detail']['ratio']))
		{
			$productImageRatioHtml = 'data-ratio='. $productSettingSaved['ratio_detail']['ratio'];
		}
		\dash\data::productImageRatioHtml($productImageRatioHtml);
	}
}
?>