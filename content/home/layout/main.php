<?php
require_once \dash\layout\func::display();
if(\dash\detect\device::detectPWA())
{
	require_once root.'content/home/layout/pwa-footer.php';
}
 ?>