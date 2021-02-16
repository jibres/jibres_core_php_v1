<?php
namespace content_crm\ticket\view;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');


		if(\dash\request::post('newbranch') && \dash\request::post('branch'))
		{
			$result = \dash\app\ticket\add::branch($id, \dash\request::post('branch'));

			if(isset($result['id']))
			{
				\dash\redirect::to(\dash\url::this(). '/view?id='. $result['id']);
			}

			return true;
		}

		if(\dash\request::post('setstatus') === 'set' || \dash\request::post('setsolved') === 'set')
		{
			$msg  = T_("Ok");
			$post = [];
			if(\dash\request::post('setstatus') === 'set')
			{
				$post['status'] = \dash\request::post('status');
				$msg = T_("Ticket was archived");
			}

			if(\dash\request::post('setsolved') === 'set')
			{
				$post['solved'] = \dash\request::post('solved') ? 0 : 1;

				if($post['solved'])
				{
					$msg = T_("Ticket was solved");
				}
				else
				{
					$msg = T_("Ticket set as not solved");
				}
			}

			if(!empty($post))
			{
				\dash\app\ticket\edit::edit($post, $id);
			}

			if(\dash\engine\process::status())
			{
				\dash\notif::clean();
				\dash\notif::ok($msg);
				\dash\redirect::pwd();
			}
			return;

		}



		$post =
		[
			'content'     => \dash\request::post_raw('answer'),
			'sendmessage' => !\dash\request::post('sendmessage'),
			'note'        => \dash\request::post('note'),
		];

		\dash\app\ticket\answer::add($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
