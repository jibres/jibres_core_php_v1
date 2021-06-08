<?php
namespace content_a\products\edit;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		\dash\data::editMode(true);

		\dash\face::title(T_("Edit Product"));

		\dash\face::btnNext(\dash\url::this(). '/next/'. \dash\request::get('id'));
		\dash\face::btnPrev(\dash\url::this(). '/prev/'. \dash\request::get('id'));
		\dash\face::btnSave('aProductData');
		\dash\face::btnSaveValue('master');


		// back
		\dash\data::back_text(T_('Products'));
		\dash\data::back_link(\lib\backlink::products());


		$productDataRow = \dash\data::productDataRow();

		if(a($productDataRow, 'status') === 'active')
		{
			\dash\face::btnView(\dash\data::productDataRow_url());
		}
		elseif(a($productDataRow, 'status') === 'draft')
		{
			\dash\face::btnPreview(\dash\data::productDataRow_url(). '?preview=yes');
		}

		$countOrdered = \lib\app\factor\get::product_count_ordered(\dash\request::get('id'));

		\dash\data::countOrdered($countOrdered);

		$variants_list = \lib\app\product\variants::get($id);
		\dash\data::variantsList($variants_list);

		$unit_list = \lib\app\product\unit::list();
		\dash\data::listUnits($unit_list);

		$category_list = \lib\app\tag\get::all_category();
		$category_list = array_reverse($category_list);
		\dash\data::listProductTag($category_list);

		$property_list = \lib\app\product\property::get_count($id);
		\dash\data::propertyCount($property_list);

		$comment_list = \dash\app\comment\get::product_comment_count($id);
		\dash\data::commentCount($comment_list);

		$cat_list = \lib\app\tag\get::product_cat($id);
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

		self::product_ratio();
	}


	public static function product_ratio()
	{

		$productSettingSaved = \lib\app\setting\get::product_setting();
		\dash\data::productSettingSaved($productSettingSaved);


		if(isset($productSettingSaved['ratio']))
		{
			$ratio = $productSettingSaved['ratio'];
		}
		else
		{
			$ratio = '1:1';
		}

		\lib\ratio::data_ratio_html($ratio);

	}
}
?>