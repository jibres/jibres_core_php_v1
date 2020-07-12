<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class irvat
{

	/**
	 * Removes a irvat gallery.
	 * @param      <type>   $_irvat_id  The irvat identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function remove_irvat_gallery($_irvat_id, $_file_id)
	{
		if(!$_irvat_id)
		{
			\dash\notif::error(T_("Factor not found"));
			return false;
		}

		if(!$_file_id)
		{
			return false;
		}

		\dash\db\fileusage::remove_usage_file_id('irvat_gallery', $_irvat_id, $_file_id);
	}


	public static function set_irvat_gallery($_irvat_id)
	{
		if(!$_irvat_id)
		{
			\dash\notif::error(T_("Factor not found"));
			return false;
		}

		$meta =
		[
			'allow_size' => \dash\upload\size::MB(1),
			'ext' =>
			[
				'jpeg','jpg','png','pdf',			// image
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
			'related'     => 'irvat_gallery',
			'related_id'  => $_irvat_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate_whit_file_id('irvat_gallery', $_irvat_id, $file_detail['id']);

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