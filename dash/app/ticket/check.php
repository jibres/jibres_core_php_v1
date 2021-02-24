<?php
namespace dash\app\ticket;

class check
{

	public static function variable($_args, $_id = null, $_website_mode = false)
	{
		$content_condition = 'desc';

		if(\dash\permission::check('crmTicketManager') && !$_website_mode)
		{
			$content_condition = 'html';
		}

		$condition =
		[
			'title'       => 'title',
			'status'      => ['enum' => ['approved','awaiting','unapproved','spam','deleted','filter','close', 'answered']],
			'via'         => ['enum' => ['site', 'telegram', 'sms', 'contact', 'admincontact', 'app']],
			'type'        => 'string_50',
			'subtype'        => 'string_50',
			'user_id'     => 'id',
			'guestid'     => 'md5',
			'sendmessage' => 'bit',
			'solved'      => 'bit',
			'file'        => 'string',
			'content'     => $content_condition,
			'parent'      => 'id',
			'base'        => 'id',
			'branch'      => 'id',
			'ip'          => 'bigint',
		];

		$require = ['content'];
		$meta    = [];

		$data    = \dash\cleanse::input($_args, $condition, $require, $meta);


		if(!$data['user_id'])
		{
			$data['user_id'] = \dash\user::id();
		}


		if(!$data['status'])
		{
			$data['status'] = 'awaiting';
		}


		$data['datecreated'] = date("Y-m-d H:i:s");
		$data['type']        = 'ticket';

		if(!$data['ip'])
		{
			$data['ip'] = \dash\server::iplong();
		}


		return $data;
	}

}
?>