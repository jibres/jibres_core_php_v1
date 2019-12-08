<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class product
{

	/**
	 * Removes a product gallery.
	 * @param      <type>   $_product_id  The product identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function remove_product_gallery($_product_id, $_file_id)
	{
		if(!$_product_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		if(!$_file_id)
		{
			return false;
		}

		\dash\db\fileusage::remove_usage_file_id('product_gallery', $_product_id, $_file_id);
	}


	public static function set_product_gallery($_product_id)
	{
		if(!$_product_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		$file_detail = \dash\upload\file::upload('gallery');

		if(!$file_detail)
		{
			return false;
		}

		$fileusage =
		[
			'file_id'     => $file_detail['id'],
			'user_id'     => \dash\user::id(),
			'title'       => null,
			'alt'         => null,
			'desc'        => null,
			'related'     => 'product_gallery',
			'related_id'  => $_product_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate_whit_file_id('product_gallery', $_product_id, $file_detail['id']);

		if(isset($check_duplicate_usage['id']))
		{
			\dash\db\fileusage::update_file_id($check_duplicate_usage['id'], $file_detail['id']);
		}
		else
		{
			\dash\db\fileusage::insert($fileusage);
		}

		return $file_detail;
	}



}
?>