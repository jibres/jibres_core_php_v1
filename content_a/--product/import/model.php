<?php
namespace content_a\product\import;


class model
{
	public static function post()
	{
		\dash\permission::access('productImport');
		$list = self::getImportFile();

		if($list === false)
		{
			\dash\notif::error(T_("Please upload a csv file"), 'product_list');
			return false;
		}

		$imported = \lib\app\product\import::csv($list);

		if(\dash\engine\process::status())
		{
			// clean all cache
			\lib\app\product\dashboard::clean_cache();

			\dash\notif::ok(T_("Import product successfully complete"));
			\dash\redirect::to(\dash\url::here(). '/product');
		}
	}


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
				\dash\notif::error(T_("Please upload a csv file"), 'product_list');
				return false;
			}
		}
		\dash\notif::error(T_("No file was sended"));
		return false;
	}
}
?>
