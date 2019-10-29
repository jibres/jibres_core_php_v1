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
				\dash\redirect::to(\dash\url::this().'/general?id='. $_data[0]['id']);
			}
		}
	}


	// load one product by id in query string url
	public static function one()
	{
		// get id from url
		$id = \dash\request::get('id');

		// load detail
		$detail = \lib\app\product\get::get($id);
		if(!$detail)
		{
			// access denied or invalid id
			return false;
		}

		// sed dataRow to load detail in html
		\dash\data::productDataRow($detail);

		return $detail;
	}
}
?>