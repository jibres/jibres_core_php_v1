<?php
namespace content_a\products\comment\edit;

class controller extends \content_cms\comments\edit\controller
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