<?php
if(\dash\data::displayShowPostList())
{
	require_once(root. '/content_cms/posts/home/display.php');
	// show post list
}
else
{
	require_once(core. '/layout/post/layout-v2.php');
}
?>