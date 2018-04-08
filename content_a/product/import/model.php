<?php
namespace content_a\product\import;


class model extends \content_a\main\model
{
	public static function getImportFile()
	{
		$product_list = null;

		if($file = \dash\request::files('product_list'))
		{
			if(isset($file['type']))
			{
				if($file['type'] !== 'text/csv' && $file['type'] !== "application/vnd.ms-excel")
				{
					\dash\notif::error(T_("Please upload a csv file"), 'product_list');
					return false;
				}

				if(isset($file['tmp_name']))
				{
					$product_list = $file['tmp_name'];
					return $product_list;
				}
			}
			else
			{
				return false;
			}
		}
		\dash\notif::error(T_("No file was sended"));
		return false;
	}


	public function post_import($_args)
	{
		$list = self::getImportFile();

		if($list === false)
		{
			return false;
		}

		$imported = \lib\app\product::import($list);

		if(\dash\engine\process::status())
		{
			// clean all cache
			\lib\app\product::clean_cache();

			\dash\notif::ok(T_("Import product successfully complete"));
			\dash\redirect::to(\dash\url::here(). '/product');
		}

	}
}
?>
