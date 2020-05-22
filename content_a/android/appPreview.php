<?php
if(\dash\data::splashSaved_start() && \dash\data::splashSaved_end())
{
	$style = 'background: linear-gradient(0deg, '. \dash\data::splashSaved_start(). ', '. \dash\data::splashSaved_end().');';
}
else
{
	$style = 'background: linear-gradient(0deg, #5583EE, #41D8DD);';
}

$text_color = \dash\data::splashSaved_text_color();
if(!$text_color)
{
	$text_color = '#000000';
}

$meta_color = \dash\data::splashSaved_meta_color();
if(!$meta_color)
{
	$meta_color = '#333333';
}
?>

<section class="mobileFrame" data-splash style="<?php echo $style; ?>">
  <div class="screen">
    <img id='finalImage' src="<?php echo \dash\data::appDetail_logo(); ?>" alt='<?php echo \dash\data::appDetail_title(); ?>'>
    <h2 style="color: <?php echo $text_color; ?>"><?php echo \dash\data::appDetail_title(); ?></h2>
    <h3 style="color: <?php echo $meta_color; ?>"><?php echo \dash\data::appDetail_slogan(); ?></h3>
    <div class="desc" style="color: <?php echo $meta_color; ?>"><?php echo \dash\data::appDetail_desc(); ?></div>
  </div>
</section>