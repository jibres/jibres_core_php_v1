<?php
if(\dash\data::contactForm())
{
	require_once('display-form.php');
}
else
{
	require_once('display-list.php');
}
?>