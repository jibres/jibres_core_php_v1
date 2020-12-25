<?php
namespace content_a\products\comment\view;

class controller extends \content_cms\comments\view\controller
{
	public static function routing()
	{
		parent::routing();

		\dash\data::editCommentModule(\dash\url::that(). '/edit');
		\dash\data::viewCommentModule(\dash\url::that(). '/view');
		\dash\data::listCommentMoudle(\dash\url::that());
	}
}
?>