<?php
namespace content_support\message\edit;

class model
{




	public static function post()
	{

		$condition =
		[
			'parent'  => 'id',
			'id'      => 'id',
			'content' => 'html',
		];

		$args =
		[
			'parent'  => \dash\request::post('parent'),
			'id'      => \dash\request::get('id'),
			'content' => \dash\request::post('content') ? $_POST['content'] : null,

		];

		if(\dash\permission::supervisor() && \dash\request::post('removeMessage'))
		{
			$require = [];
		}
		else
		{
			$require = ['content'];
		}

		$meta =	[];

		$data = \dash\cleanse::input($args, $condition, $require, $meta);

		\dash\permission::check('supportEditMessage');

		if(\dash\permission::supervisor() && \dash\request::post('removeMessage'))
		{
			\dash\log::set('supportMessageDELETED', ['code' => $data['parent'], 'message_id' => $data['id']]);
			\dash\db\tickets::hard_delete($data['id']);
			if($data['parent'])
			{
				\dash\redirect::to(\dash\url::here().'/ticket/show?id='. $data['parent']);
			}
			else
			{
				\dash\redirect::to(\dash\url::here().'/ticket');
			}
		}


		$args =
		[
			'content' => $data['content'],
		];


		\content_support\message\edit\view::config();

		\dash\db\tickets::update($args, $data['id']);

		\dash\log::set('supportMessageEdit', ['code' => $data['id']]);

		\dash\notif::ok(T_("Ticket updated"));
		\dash\redirect::to(\dash\url::here().'/ticket/show?id='. $data['id']);

	}
}
?>