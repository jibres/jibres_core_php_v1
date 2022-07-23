<?php
namespace content_site\assemble;


class link
{

	public static function generate($_link_detail, $_only_link = false)
	{
		$related_id       = a($_link_detail, 'related_id');

		$target_blank = false;

		$link = \lib\store::url();

		switch (a($_link_detail, 'pointer'))
		{
			case 'homepage':
				$link = $link;
				break;

			case 'products':
				$link .= '/p';

				if($related_id)
				{
					$link .= '/'. $related_id;
				}
				break;

			case 'posts':
				$link .= '/n';

				if($related_id)
				{
					$link .= '/'. \dash\coding::encode($related_id);
				}
				break;

			case 'forms':
				$link .= '/f';

				if($related_id)
				{
					$link .= '/'. $related_id;
				}
				break;

			case 'tags':
			case 'category':
				$link .= '/category';

				if($related_id)
				{
					$link .= '?id='. $related_id;
				}
				break;

			case 'hashtag':
				$link .= '/hashtag';

				if($related_id)
				{
					$link .= '?id='. \dash\coding::encode($related_id);
				}
				break;

			case 'socialnetwork':
				if(!a($_link_detail, 'socialnetwork'))
				{
					// nothing
				}
				else
				{
					$social_detail = \lib\store::social($_link_detail['socialnetwork']);

					$link = a($social_detail, 'link');
					$target_blank = true;
				}
				break;

			case 'other':
				if(!a($_link_detail, 'url'))
				{
					// nothing
				}
				else
				{
					$target_blank = true;
					$link = $_link_detail['url'];
				}
				break;

			case 'file':
				if(!a($_link_detail, 'url'))
				{
					// nothing
				}
				else
				{
					$target_blank = true;
					$link = \lib\filepath::fix($_link_detail['url']);
				}
				break;

			case 'title':
			case 'separator':
			case 'selffile':
			default:
				// have no link
				// nothing
				break;
		}

		$result = [];
		$result['link'] = $link;

		$result['target_blank'] = $target_blank;
		if($target_blank)
		{
			$result['target_blank_html'] = ' target="_blank"';
		}

		if($_only_link)
		{
			return $link;
		}


		return $result;
	}

}
?>