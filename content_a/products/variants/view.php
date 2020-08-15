<?php
namespace content_a\products\variants;


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

		\dash\face::title(T_("Variants"). ' | '. $title);


		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/child?id='. \dash\request::get('id'));


		if(\dash\data::productDataRow_url())
		{
			\dash\face::btnView(\dash\data::productDataRow_url());
		}

		\dash\face::help(\dash\url::support().'/variants');


		$variants_list = \lib\app\product\variants::get($id);
		\dash\data::variantsList($variants_list);




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
			// \dash\face::btnDuplicate(\dash\url::this(). '/duplicate?id='. $id);
		}
	}
}
?>
