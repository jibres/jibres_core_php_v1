<?php
namespace content_a\accounting\doc\edit;

class model
{
	public static function post()
	{

		$id = \dash\request::get('id');

		if(\dash\request::post('uploaddoc') === 'uploaddoc')
		{
			self::upload_gallery($id);
			return;
		}

		if(\dash\request::post('fileaction') === 'remove')
		{
			self::remove_gallery($id);
			return false;
		}

		if(\dash\request::post('newlockstatus'))
		{
			$post =
			[
				'status' => \dash\request::post('newlockstatus'),
			];

			$result = \lib\app\tax\doc\edit::edit_status($post, \dash\request::get('id'));
			\dash\redirect::pwd();

		}

		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\tax\doc\remove::remove(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that());
			}
			return;
		}

		if(\dash\request::post('remove') === 'removedetail')
		{
			\lib\app\tax\docdetail\remove::remove(\dash\request::post('docdetailid'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}


		if(\dash\request::post('sortable') === 'sortable')
		{
			\lib\app\tax\docdetail\edit::sort(\dash\request::post('sort'), \dash\request::get('id'));
			return;
		}
		elseif(\dash\request::post('row') === 'row')
		{
			$post =
			[
				'tax_document_id' => \dash\request::get('id'),
				// 'debtor'          => \dash\request::post('debtor'),
				// 'creditor'        => \dash\request::post('creditor'),
				'type'            => \dash\request::post('type'),
				'value'            => \dash\request::post('value'),

				'desc'            => \dash\request::post('desc'),
				'assistant_id'    => \dash\request::post('assistant_id'),
				'details_title'      => \dash\request::post('details_title'),
			];
			if(\dash\data::editModeDetail())
			{
				$result = \lib\app\tax\docdetail\edit::edit($post, \dash\request::get('did'));
			}
			else
			{
				$result = \lib\app\tax\docdetail\add::add($post);
			}
		}
		else
		{
			$post =
			[
				'number' => \dash\request::post('number'),
				'desc'   => \dash\request::post('desc'),
				'date'   => \dash\request::post('date'),
			];

			$result = \lib\app\tax\doc\edit::edit($post, \dash\request::get('id'));
		}

		if(\dash\engine\process::status())
		{
			if(\dash\data::editModeDetail())
			{
				\dash\redirect::to(\dash\url::current(). '?id='. \dash\request::get('id'));
			}
			else
			{
				\dash\redirect::pwd();
			}
		}
	}



	/**
	 * Uploads a gallery.
	 * Use this function in api
	 */
	public static function upload_gallery($_id)
	{
		if(\dash\request::files('gallery'))
		{
			$uploaded_file = \dash\upload\tax_document::set_tax_document_gallery($_id);

			if(isset($uploaded_file['id']))
			{
				// save uploaded file
				\lib\app\tax\doc\gallery::gallery($_id, $uploaded_file, 'add');
			}

			if(!\dash\engine\process::status())
			{
				// \dash\notif::error(T_("Can not upload file"));
			}
			else
			{
				if(\dash\url::child() === 'add')
				{
					// nothing
				}
				else
				{
					\dash\notif::ok(T_("File successfully uploaded"));
	 				\dash\redirect::pwd();
				}
			}

			return true;
		}
		return false;

	}


	public static function remove_gallery($_id)
	{
		$fileid = \dash\request::post('fileid');
		\lib\app\tax\doc\gallery::gallery($_id, $fileid, 'remove');
		\dash\notif::ok(T_("File removed"));
		// \dash\redirect::pwd();
	}
}
?>
