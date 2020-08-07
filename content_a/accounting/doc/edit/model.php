<?php
namespace content_a\accounting\doc\edit;

class model
{
	public static function post()
	{
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


		if(\dash\request::post('row') === 'row')
		{
			$post =
			[
				'tax_document_id' => \dash\request::get('id'),
				'debtor'          => \dash\request::post('debtor'),
				'desc'            => \dash\request::post('desc'),
				'creditor'        => \dash\request::post('creditor'),
				'assistant_id'    => \dash\request::post('assistant_id'),
				'details_id'      => \dash\request::post('details_id'),
			];

			$result = \lib\app\tax\docdetail\add::add($post);
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
			\dash\redirect::pwd();
		}
	}
}
?>
