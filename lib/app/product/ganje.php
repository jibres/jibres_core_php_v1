<?php
namespace lib\app\product;


class ganje
{
	public static function search(string $_search) : array
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
			\dash\notif::error(T_("Product not found"));
			return false;
		}

		$ganje_product = $ganje['result'];

		return $ganje_product;
	}


	public static function add_from_id($_id)
	{
		$ganje_product = self::fetch_by_id($_id);
		if(!$ganje_product)
		{
			return false;
		}

		$gallery_raw = [];
		if(a($ganje_product, 'gallery_array'))
		{
			$gallery_raw = array_column($ganje_product['gallery_array'], 'path');
		}


		$category = [];
		if(a($ganje_product, 'category'))
		{
			$category = array_column($ganje_product['category'], 'title');
		}

		$add_new_product =
		[
			'title'           => a($ganje_product, 'title'),
			'title2'          => a($ganje_product, 'title2'),
			'barcode'         => a($ganje_product, 'barcode'),
			'slug'            => a($ganje_product, 'slug'),
			'gallery_raw'     => $gallery_raw,
			'category'        => $category,
			'ganje_id'        => a($ganje_product, 'id'),
			'ganje_lastfetch' => date("Y-m-d H:i:s"),
		];

		$result = \lib\app\product\add::add($add_new_product);

		return $result;

	}


	public static function fill_args(array $_args) : array
	{
		if(!isset($_args['add_from_ganje_id']))
		{
			return $_args;
		}

		if(!\dash\validate::id($_args['add_from_ganje_id'], false))
		{
			return $_args;
		}

		$ganje_product = \lib\app\product\ganje::fetch_by_id($_args['add_from_ganje_id']);
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

			$_args['category'] = $ganje_category;


			if(a($ganje_product, 'property'))
			{
				$_args['property'] = $ganje_product['property'];
			}


			$_args['title2'] = a($ganje_product, 'title2');
			$_args['slug']   = a($ganje_product, 'slug');

		}

		return $_args;
	}
}
?>