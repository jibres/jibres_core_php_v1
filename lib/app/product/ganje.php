<?php
namespace lib\app\product;


class ganje
{
	/**
	 * Searches for the first match.
	 *
	 * @param      string  $_search  The search
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	public static function search($_search) : array
	{
		if(!$_search)
		{
			return [];
		}

		$ganje = \lib\api\business\ganje::search($_search);

		$list = [];

		if(isset($ganje['result']) && is_array($ganje['result']) && $ganje['result'])
		{
			$list = $ganje['result'];
		}

		return $list;

	}


	/**
	 * Fetches a by identifier.
	 *
	 * @param      <type>  $_id    The identifier
	 *
	 * @return     bool    The by identifier.
	 */
	public static function fetch_by_id($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$ganje = \lib\api\business\ganje::detail($id);

		if(!$ganje || !isset($ganje['result']) || !is_array(a($ganje, 'result')))
		{
			return false;
		}

		$ganje_product = $ganje['result'];

		return $ganje_product;
	}


	/**
	 * Fetches a by barcode.
	 *
	 * @param      <type>  $_barcode  The barcode
	 *
	 * @return     bool    The by barcode.
	 */
	public static function fetch_by_barcode($_barcode)
	{
		$barcode = \dash\validate::string_100($_barcode);
		if(!$barcode)
		{
			return false;
		}

		$ganje = \lib\api\business\ganje::barcode($barcode);

		if(!$ganje || !isset($ganje['result']) || !is_array(a($ganje, 'result')))
		{
			return false;
		}

		$ganje_product = $ganje['result'];

		if(isset($ganje_product[0]))
		{
			$ganje_product = $ganje_product[0];
		}

		return $ganje_product;
	}



	/**
	 * Get ganje product by id or by barcode
	 *
	 * @param      <type>  $_id       The identifier
	 * @param      <type>  $_barcode  The barcode
	 *
	 * @return     <type>  The by identifier barcode.
	 */
	public static function fetch_by_id_barcode($_id, $_barcode)
	{
		if($_id)
		{
			return self::fetch_by_id($_id);
		}
		elseif($_barcode)
		{
			return self::fetch_by_barcode($_barcode);
		}
	}


	/**
	 * Fill add or edit request args by ganje detail
	 *
	 * @param      array  $_args  The arguments
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function fill_args(array $_args) : array
	{
		if(!isset($_args['add_from_ganje']))
		{
			return $_args;
		}

		// detect and load ganje product
		if(a($_args, 'add_from_ganje_type') === 'id')
		{
			$ganje_product = \lib\app\product\ganje::fetch_by_id($_args['add_from_ganje']);
		}
		elseif(a($_args, 'add_from_ganje_type') === 'barcode')
		{
			$ganje_product = \lib\app\product\ganje::fetch_by_barcode($_args['add_from_ganje']);
		}
		else
		{
			return $_args;
		}

		if($ganje_product)
		{

			$_args['ganje_id']        = a($ganje_product, 'id');
			$_args['ganje_lastfetch'] = date("Y-m-d H:i:s");


			$ganje_gallery_raw = [];
			if(a($ganje_product, 'gallery_array'))
			{
				$ganje_gallery_raw = array_column($ganje_product['gallery_array'], 'path');
			}

			$_args['gallery_raw'] = $ganje_gallery_raw;


			$ganje_category = [];
			if(a($ganje_product, 'category'))
			{
				$ganje_category = array_column($ganje_product['category'], 'title');
			}


			if(!a($_args, 'category'))
			{
				$_args['category'] = $ganje_category;
			}


			if(a($ganje_product, 'property') && !a($_args, 'property'))
			{
				$_args['property'] = $ganje_product['property'];
			}

			if(!a($_args, 'title'))
			{
				$_args['title'] = a($ganje_product, 'title');
			}

			if(!a($_args, 'title2'))
			{
				$_args['title2'] = a($ganje_product, 'title2');
			}

			if(!a($_args, 'slug'))
			{
				$_args['slug']   = a($ganje_product, 'slug');
			}

			if(!a($_args, 'desc'))
			{
				$_args['desc']   = a($ganje_product, 'desc');
			}
		}

		return $_args;
	}



	public static function detect_update(array $_proudct_detail)
	{
		if(a($_proudct_detail, 'ganje_lastfetch'))
		{
			if(strtotime($_proudct_detail['ganje_lastfetch']) >= \lib\api\business\ganje::get_lastupdate(true))
			{
				return null;
			}
		}

		$ganje_identify = null;
		$ganje_type     = null;

		if(a($_proudct_detail, 'barcode'))
		{
			$ganje_identify = $_proudct_detail['barcode'];
			$ganje_type     = 'barcode';
		}
		elseif(a($_proudct_detail, 'barcode2'))
		{
			$ganje_identify = $_proudct_detail['barcode2'];
			$ganje_type     = 'barcode';
		}
		elseif(a($_proudct_detail, 'ganje_id'))
		{
			$ganje_identify = $_proudct_detail['ganje_id'];
			$ganje_type     = 'id';
		}
		elseif(a($_proudct_detail, 'title'))
		{
			$ganje_identify = $_proudct_detail['title'];
			$ganje_type     = 'title';
		}
		elseif(a($_proudct_detail, 'title2'))
		{
			$ganje_identify = $_proudct_detail['title2'];
			$ganje_type     = 'title';
		}
		else
		{
			// nothing detect fo search in ganje
			return null;
		}

		$ganje_product = [];

		switch ($ganje_type)
		{
			case 'barcode':
				$ganje_product = self::fetch_by_barcode($ganje_identify);
				break;

			case 'id':
				$ganje_product = self::fetch_by_id($ganje_identify);
				break;

			case 'title':
				// $ganje_product = self::fetch_by_title($ganje_identify);
				return null;
				break;

			default:
				return null;
				break;
		}

		\lib\db\products\update::ganje_lastfetch($_proudct_detail['id']);

		/**

			TODO:
			- compare title
			- compare gallery
			- compare category
			- compare property
			- compare desc
		 */

		return;

		var_dump($ganje_product);

		var_dump($ganje_identify, $ganje_type);exit;

		var_dump($_proudct_detail);exit;
	}
}
?>