<?php
namespace lib\app\product;

class load
{
	public static function barcode_is_scaned($_data, $_search_string)
	{
		// redirect on barcode scan
		if(is_array($_data) && count($_data) === 1)
		{
			$barcode_is_scaned = false;
			if(isset($_data[0]['barcode']) && $_data[0]['barcode'] === $_search_string)
			{
				$barcode_is_scaned = true;
			}

			if(isset($_data[0]['barcode2']) && $_data[0]['barcode2'] === $_search_string)
			{
				$barcode_is_scaned = true;
			}

			if(isset($_data[0]['id']) && $barcode_is_scaned)
			{
				\lib\backlink::product_barcode_scaned();
				\dash\redirect::to(\dash\url::this().'/edit?id='. $_data[0]['id']);
			}
		}
	}


	// load one product by id in query string url
	public static function one($_id = null)
	{
		$id = $_id;

		if(!$id)
		{
			// get id from url
			$id = \dash\request::get('id');
		}

		// load detail
		$detail = \lib\app\product\get::get($id, ['load_gallery' => true]);
		if(!$detail)
		{
			// access denied or invalid id
			return false;
		}

		if(isset($detail['variant_child']) && $detail['variant_child'])
		{
			$load_child = \lib\db\products\get::variants_load_child($id);
			if($load_child)
			{
				$detail['child'] = array_map(['\\lib\\app\\product\\ready', 'row'], $load_child);
			}
		}

		$detail['first_sale'] = \lib\app\product\get::first_sale($id);

		// sed dataRow to load detail in html
		\dash\data::productDataRow($detail);

		return $detail;
	}





	// load one product by id in site
	public static function site($_id)
	{
		// load detail
		$detail = \lib\app\product\get::get($_id, ['load_gallery' => true]);
		if(!$detail)
		{
			// access denied or invalid id
			return false;
		}


		$parent_thumb = null;

		if(isset($detail['variant_child']) && $detail['variant_child'])
		{
			$variant_price = \lib\app\product\price::variant_price($_id);
			if(isset($variant_price['min_price']) && isset($variant_price['max_price']))
			{
				if($variant_price['min_price'] === $variant_price['max_price'])
				{
					$detail['variant_price'] = \dash\fit::number($variant_price['min_price']);
				}
				else
				{
					$detail['variant_price'] = \dash\fit::number($variant_price['min_price']) . ' ... '. \dash\fit::number($variant_price['max_price']);
				}
				$detail['price']      = 0;
				$detail['discount']   = 0;
				$detail['finalprice'] = 0;
			}
			else
			{
				$detail['variant_price'] = null;
			}
		}


		$load_child = [];
		if(isset($detail['variant_child']) && $detail['variant_child'])
		{
			if(isset($detail['thumb']))
			{
				$parent_thumb = $detail['thumb'];
			}
			$load_child = \lib\db\products\get::variants_load_child($_id);
		}
		elseif(isset($detail['parent']) && $detail['parent'])
		{
			$load_child = \lib\db\products\get::variants_load_family($_id, $detail['parent']);
			$load_parent = \lib\app\product\get::get($detail['parent']);
			if(isset($load_parent['thumb']))
			{
				$parent_thumb = $load_parent['thumb'];
			}
			if($parent_thumb && !\dash\get::index($detail['thumb']))
			{
				$detail['thumb'] = $parent_thumb;
			}

		}

		if($load_child && is_array($load_child))
		{
			$detail['child'] = [];

			foreach ($load_child as $key => $value)
			{
				$detail['child'][] = \lib\app\product\ready::row($value, ['load_gallery' => true, 'parent_thumb' => $parent_thumb]);
			}
		}



		// sed dataRow to load detail in html
		\dash\data::productDataRow($detail);

		return $detail;
	}
}
?>