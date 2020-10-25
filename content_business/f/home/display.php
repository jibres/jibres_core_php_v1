<?php
if(\dash\data::inquiryForm())
{
	require_once('display-form-inquiry.php');
}
else
{

	if(\dash\data::contactForm())
	{
		require_once('display-form.php');
	}
	else
	{
		require_once('display-list.php');
	}

}
?>