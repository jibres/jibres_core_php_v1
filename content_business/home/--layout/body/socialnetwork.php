<?php
$social = \lib\store::social();
if(isset($line_detail['value']['publish']) && $line_detail['value']['publish'] && $social)
{
	echo '<div class="avand-md mTB50-f">';
	echo '<h1>'. T_("Follow us on social network"). '</h1>';
	require_once(root. 'content_business/home/layout/template/socialnetwork.php');
	echo '</div>';
}
?>