<?php
namespace content_a\products\home;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_products');



		if(\dash\request::get('fix') === 'barcode')
		{
			$unique = [];
			$ids = [];

			$query = "UPDATE products SET products.barcode = REPLACE(products.barcode, 'ز', 'C') WHERE products.barcode LIKE '%ز%' ";
			$result = \dash\db::query($query);
			var_dump($result);

			$query = "UPDATE products SET products.barcode2 = REPLACE(products.barcode2, 'ز', 'C') WHERE products.barcode2 LIKE '%ز%' ";
			$result = \dash\db::query($query);
			var_dump($result);

			exit;


			$list = \dash\db::get("SELECT products.id, products.title, products.barcode, products.barcode2 FROM products WHERE products.barcode LIKE '%ز%' or products.barcode2 LIKE '%ز%' ");

			foreach ($list as $key => $value)
			{
				$new_barcode = \dash\utility\convert::to_barcode($value['barcode']);
				$new_barcode2 = \dash\utility\convert::to_barcode($value['barcode2']);

				$xkey = $new_barcode. '_'. $new_barcode2;
				$xkey = $new_barcode2;

				if(isset($unique[$xkey]))
				{
					var_dump($xkey, $value);
				}
				else
				{
					$ids[] = $value['id'];
					$unique[$xkey] = $value;
				}
			}

			$xb = implode("','", array_keys($unique));
			$xid = implode(',', $ids);

			$query = "SELECT * FROM products WHERE (products.barcode IN ('$xb') OR products.barcode2 IN ('$xb') ) AND products.id NOT IN ($xid) ";
			var_dump(\dash\db::get($query));
			var_dump($unique);
			var_dump($list);exit;
		}
	}
}
?>
