<?php
namespace lib\app\product;


class file
{

	public static function thumb($_gallery_url, $_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			return false;
		}

		$result = \lib\db\products::update(['thumb' => $_gallery_url], $id);
		return $result;
	}


	public static function gallery($_product_id, $_gallery_index, $_type = 'add')
	{
		$product_id = \dash\coding::decode($_product_id);

		if(!$product_id)
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$load_product_gallery = \lib\db\products::get(['id' => $product_id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(!array_key_exists('gallery', $load_product_gallery))
		{
			\dash\notif::error(T_("Product not found"));
			return false;
		}

		$gallery = $load_product_gallery['gallery'];

		if(is_string($gallery) && (substr($gallery, 0, 1) === '{' || substr($gallery, 0, 1) === '['))
		{
			$gallery = json_decode($gallery, true);
		}
		elseif(is_array($gallery))
		{
			// no thing
		}
		else
		{
			$gallery = [];
		}

		if($_type === 'add')
		{
			if(isset($gallery['gallery']) && is_array($gallery['gallery']))
			{
				if(in_array($_gallery_index, $gallery['gallery']))
				{
					\dash\notif::error(T_("Duplicate gallery in this gallery"));
					return false;
				}
				array_push($gallery['gallery'], $_gallery_index);
			}
			else
			{
				$gallery['gallery'] = [$_gallery_index];
			}
		}
		else
		{
			if(isset($gallery['gallery']) && is_array($gallery['gallery']))
			{
				if(!array_key_exists($_gallery_index, $gallery['gallery']))
				{
					\dash\notif::error(T_("Invalid gallery id"));
					return false;
				}
				unset($gallery['gallery'][$_gallery_index]);
			}

		}

		$gallery = json_encode($gallery, JSON_UNESCAPED_UNICODE);
		\dash\log::set('addProductGallery', ['data' => $product_id, 'datalink' => \dash\coding::encode($product_id)]);
		\lib\db\products::update(['gallery' => $gallery], $product_id);
		return true;

	}

}
?>