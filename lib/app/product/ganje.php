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


	public static function add_from_id($_id)
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
}
?>