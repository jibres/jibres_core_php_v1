<?php
namespace content_a\product\import;
use \lib\utility;
use \lib\debug;

class model extends \content_a\main\model
{

	/**
	 * Gets the post.
	 *
	 * @return     array  The post.
	 */
	public static function getImportFile()
	{
		$product_list = null;

		if($file = utility::files('product_list'))
		{
			if(isset($file['type']))
			{
				if($file['type'] !== 'text/csv')
				{
					debug::error(T_("Please upload a csv file"), 'product_list');
					return false;
				}

				if(isset($file['tmp_name']))
				{
					$product_list = file_get_contents($file['tmp_name']);
					return $product_list;
				}
			}
			else
			{
				return false;
			}
		}
		return false;
	}


	/**
	 * Posts an importproduct.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function post_import($_args)
	{
		$list = self::getImportFile();

		if($list === false)
		{
			return false;
		}

		\lib\app\product::import($list);

		if(debug::$status)
		{
			$this->redirector($this->url('baseFull'). '/product/search');
		}

	}
}
?>