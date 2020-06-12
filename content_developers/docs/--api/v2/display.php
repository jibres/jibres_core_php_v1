<?php
// add api static contents
require_once(root. 'content_developers/docs/001-intro.php');
require_once(root. 'content_developers/docs/002-endpoint.php');
require_once(root. 'content_developers/docs/003-requests.php');
require_once(root. 'content_developers/docs/004-responses.php');

foreach (\dash\data::projectDoc() as $key => $value)
{
    require_once($value);
}
?>


