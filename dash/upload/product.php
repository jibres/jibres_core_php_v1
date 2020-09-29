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

		$meta =
		[
			'allow_size' => \dash\upload\size::MB(1),
			'ext' =>
			[
				'jpeg','jpg','png',			// image
				'gif', 'mp4', 'ogv', 'ogg', 'webm',
			],
		];


		$file_detail = \dash\upload\file::upload('gallery', $meta);

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



	public static function set_product_gallery_from_url($_product_id, $_url)
	{

		// $url = strtok($url, '?');
		if(!$_product_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		if(!$_url)
		{
			return false;
		}


		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 90);
		curl_setopt($ch, CURLOPT_TIMEOUT, 90);
		curl_setopt($ch, CURLOPT_HEADER, 0);

		$response  = curl_exec($ch);
		$CurlError = curl_error($ch);
		$getInfo   = curl_getinfo($ch);

		curl_close ($ch);
		if($response)
		{
			$new_path = tempnam('/tmp', 'JIBRES_');
			\dash\file::write($new_path, $response);

			$meta =
			[
				'allow_size'       => \dash\upload\size::MB(1),
				'upload_from_path' => $new_path,
				'upload_name'      => 'gallery',
				'ext'              =>
				[
					'jpeg','jpg','png',			// image
				],
			];


			$file_detail = \dash\upload\file::upload(null, $meta);

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


	public static function set_product_gallery_editor($_product_id)
	{
		if(!$_product_id)
		{
			return null;
		}

		$meta =
		[
			'allow_size' => \dash\upload\size::MB(1),
			'ext' =>
			[
				'gif','jpeg','jpg','png',			// image
				'gif', 'mp4', 'ogv', 'ogg', 'webm',
			],
		];


		$file_detail = \dash\upload\file::upload('upload', $meta);

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
			'related'     => 'product_gallery_editor',
			'related_id'  => $_product_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate_whit_file_id('product_gallery_editor', $_product_id, $file_detail['id']);

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