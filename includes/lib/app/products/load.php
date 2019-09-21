<?php
namespace lib\app\products;

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

}
?>