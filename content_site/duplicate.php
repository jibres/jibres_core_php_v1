<?php
namespace content_site;


class duplicate
{

	public static function page($_id, $_args)
	{
		$load = \dash\app\posts\get::inline_get($_id);
		if(!$load)
		{
			return false;
		}

		if(!isset($_args['title']) || (isset($_args['title']) && !$_args['title']))
		{
			\dash\notif::error(T_("Please set posts title"), 'title');
			return false;
		}

		$load = array_merge($load, $_args);

		$check_duplicate_title = \dash\db\posts\get::check_duplicate_title($load['title'], $load['id']);

		if($check_duplicate_title)
		{
			\dash\notif::error(T_("Please change the posts name to copy"), 'title');
			return false;
		}

		$copy_posts = [];
		foreach ($load as $key => $value)
		{
			switch ($key)
			{
				case 'language':
				case 'title':
				case 'seotitle':
				case 'url':
				case 'content':
				case 'thumb':
				case 'cover':
				// case 'gallery':
				case 'subtitle':
				case 'excerpt':
				// case 'meta':
				case 'type':
				// case 'special':
				case 'comment':
				// case 'seorank':
				case 'showwriter':
				case 'showdate':
				case 'status':
				case 'parent':
				// case 'user_id':
				case 'publishdate':
				case 'subtype':
				case 'redirecturl':
				case 'specialaddress':
				// case 'analyzecontent':

					$copy_posts[$key] = $value;
					break;

				case 'datemodified':
				case 'datecreated':
				case 'slug':
				default:
					// skip othe field
					break;
			}
		}


		\dash\pdo::transaction();

		$result = \dash\app\posts\add::add($copy_posts);

		if(isset($result['post_id']))
		{
			\dash\notif::clean();

			$ok = \dash\db\posts\duplicate::make_duplicate_pagebuilder(\dash\coding::decode($result['post_id']), $load['id']);

			if($ok)
			{
				\dash\pdo::commit();

				\dash\notif::ok(T_("Duplicate created"));

				return $result['post_id'];
			}
			else
			{
				\dash\pdo::rollback();
			}
		}
		else
		{
			\dash\pdo::rollback();
			\dash\notif::error(T_("Can not make duplicate from this page"));
			return false;
		}


	}
}
?>