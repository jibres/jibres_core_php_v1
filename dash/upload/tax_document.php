<?php
namespace dash\upload;

/**
 * Class for upload.
 */
class tax_document
{

	/**
	 * Removes a tax_document gallery.
	 * @param      <type>   $_tax_document_id  The tax_document identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function remove_tax_document_gallery($_tax_document_id, $_file_id)
	{
		if(!$_tax_document_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		if(!$_file_id)
		{
			return false;
		}

		\dash\db\fileusage::remove_usage_file_id('tax_document_gallery', $_tax_document_id, $_file_id);
	}


	public static function set_tax_document_gallery($_tax_document_id)
	{
		if(!$_tax_document_id)
		{
			\dash\notif::error(T_("Post not found"));
			return false;
		}

		$meta =
		[
			'allow_size' => \dash\upload\size::MB(1),
			'ext' =>
			[
				'doc','docx','xls','xlsx','ppt','pptx','ppsx','zip','rar','jpeg','jpg','png','pdf',
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
			'related'     => 'tax_document_gallery',
			'related_id'  => $_tax_document_id,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$check_duplicate_usage = \dash\db\fileusage::duplicate_whit_file_id('tax_document_gallery', $_tax_document_id, $file_detail['id']);

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