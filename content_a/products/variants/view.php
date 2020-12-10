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

		if(\dash\data::productDataRow_first_sale())
		{
			\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));
		}
		else
		{
		  if(
		      (!\dash\data::productDataRow_variant_child() && !\dash\data::productDataRow_parent() && !\dash\data::productDataRow_variants()) ||
		      (!\dash\data::productDataRow_variant_child() && !\dash\data::productDataRow_parent() && \dash\data::productDataRow_variants() && \dash\request::get('makevariants'))
		    )
		  {
			\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));
		  }
		  elseif(!\dash\data::productDataRow_variant_child() && !\dash\data::productDataRow_parent() && \dash\data::productDataRow_variants())
		  {
		   	// nothing
		  }
		  elseif(\dash\data::productDataRow_variant_child())
		  {
		   	// nothing
		  }
		  elseif(\dash\data::productDataRow_parent())
		  {
			\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));
		  }
		  else
		  {
			\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));
		  }
		}



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

		\dash\data::countChild(0);

		if(\dash\data::productDataRow_child() && is_array(\dash\data::productDataRow_child()))
		{
			$currentVariants = [];
			\dash\data::countChild(count(\dash\data::productDataRow_child()));

			foreach (\dash\data::productDataRow_child() as $key => $value)
			{
				if(a($value, 'optionname1') && !isset($currentVariants[a($value, 'optionname1')]))
				{
					$currentVariants[a($value, 'optionname1')]  = [];
				}

				if(a($value, 'optionvalue1'))
				{
					$currentVariants[a($value, 'optionname1')][]  = a($value, 'optionvalue1');
				}

				if(a($value, 'optionname2') && !isset($currentVariants[a($value, 'optionname2')]))
				{
					$currentVariants[a($value, 'optionname2')]  = [];
				}

				if(a($value, 'optionvalue2'))
				{
					$currentVariants[a($value, 'optionname2')][]  = a($value, 'optionvalue2');
				}

				if(a($value, 'optionname3') && !isset($currentVariants[a($value, 'optionname3')]))
				{
					$currentVariants[a($value, 'optionname3')]  = [];
				}

				if(a($value, 'optionvalue3'))
				{
					$currentVariants[a($value, 'optionname3')][]  = a($value, 'optionvalue3');
				}

			}

			$currentVariants = array_map('array_unique', $currentVariants);
			foreach ($currentVariants as $key => $value)
			{
				if(empty($value))
				{
					unset($currentVariants[$key]);
				}
			}


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
