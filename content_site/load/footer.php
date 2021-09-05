<?php

\content_site\load\load::detect_footer();

$website_footer = \dash\data::website_footer();

echo a($website_footer, 'body_layout');

?>