<?php
if(!\dash\request::get('list'))
{
    require_once('display-maybemydomain.php');
}
elseif(\dash\request::get('list') === 'renew')
{
    require_once('display-maybemydomain.php');
}
elseif(\dash\request::get('list') === 'import')
{
    require_once('display-imported.php');

}
elseif(\dash\request::get('list') === 'available')
{
    require_once('display-availabledomain.php');
}
else
{
    // nothing
}
?>