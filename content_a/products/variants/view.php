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


		if(\dash\data::productDataRow_child() && is_array(\dash\data::productDataRow_child()))
		{
			$currentVariants = [];

			foreach (\dash\data::productDataRow_child() as $key => $value)
			{
				if(\dash\get::index($value, 'optionname1') && !isset($currentVariants[\dash\get::index($value, 'optionname1')]))
				{
					$currentVariants[\dash\get::index($value, 'optionname1')]  = [];
				}

				if(\dash\get::index($value, 'optionvalue1'))
				{
					$currentVariants[\dash\get::index($value, 'optionname1')][]  = \dash\get::index($value, 'optionvalue1');
				}

				if(\dash\get::index($value, 'optionname2') && !isset($currentVariants[\dash\get::index($value, 'optionname2')]))
				{
					$currentVariants[\dash\get::index($value, 'optionname2')]  = [];
				}

				if(\dash\get::index($value, 'optionvalue2'))
				{
					$currentVariants[\dash\get::index($value, 'optionname2')][]  = \dash\get::index($value, 'optionvalue2');
				}

				if(\dash\get::index($value, 'optionname3') && !isset($currentVariants[\dash\get::index($value, 'optionname3')]))
				{
					$currentVariants[\dash\get::index($value, 'optionname3')]  = [];
				}

				if(\dash\get::index($value, 'optionvalue3'))
				{
					$currentVariants[\dash\get::index($value, 'optionname3')][]  = \dash\get::index($value, 'optionvalue3');
				}

			}

			$currentVariants = array_map('array_unique', $currentVariants);

			$remain_count = 0;
			if(count($currentVariants) === 2)
			{
				$remain_count = 1;
			}

			if(count($currentVariants) === 1)
			{
				$remain_count = 2;
			}
			\dash\data::remainCount($remain_count);

			\dash\data::currentVariants($currentVariants);
		}
	}
}
?>
