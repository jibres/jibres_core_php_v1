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

		$redirect_to_parent = false;
		if(!$id)
		{
			$redirect_to_parent = true;
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

		// redirect child to parent
		if($redirect_to_parent && isset($detail['parent']) && $detail['parent'])
		{
			$get = \dash\request::get();
			$get['id'] = $detail['parent'];
			$url = \dash\url::current(). '?'. http_build_query($get);
			\dash\redirect::to($url);
		}

		if(isset($detail['variant_child']) && $detail['variant_child'])
		{
			$load_child = \lib\db\products\get::variants_load_child($id);
			if($load_child)
			{
				$detail['child'] = array_map(['\\lib\\app\\product\\ready', 'row'], $load_child);

				$stockallchild = 0;
				foreach ($detail['child'] as $key => $value)
				{
					if(isset($value['trackquantity']) && $value['trackquantity'] && array_key_exists('stock', $value))
					{
						$stockallchild += floatval($value['stock']);
					}
				}
				$detail['stockallchild'] = $stockallchild;
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
		$detail = \lib\app\product\get::site($_id, ['load_gallery' => true]);
		if(!$detail)
		{
			// access denied or invalid id
			return false;
		}


		if(isset($detail['variant_child']) && $detail['variant_child'])
		{
			$detect_min_variant_price = [$detail];
			\lib\app\product\search::detect_min_variant_price($detect_min_variant_price);
			$detect_min_variant_price = $detect_min_variant_price[0];
			$detail                   = $detect_min_variant_price;
		}


		$load_child = [];
		if(isset($detail['variant_child']) && $detail['variant_child'])
		{
			$load_child = \lib\db\products\get::variants_load_child($_id);
		}
		elseif(isset($detail['parent']) && $detail['parent'])
		{
			$load_child = \lib\db\products\get::variants_load_family($_id, $detail['parent']);
		}

		if($load_child && is_array($load_child))
		{
			$detail['child'] = [];

			foreach ($load_child as $key => $value)
			{
				$detail['child'][] = \lib\app\product\ready::row($value, ['load_gallery' => true]);
			}
		}



		// sed dataRow to load detail in html
		\dash\data::productDataRow($detail);

		return $detail;
	}
}
?>