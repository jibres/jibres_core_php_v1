<?php

$titleline = [];

if(isset($line_detail['value']['titleline']) && is_array($line_detail['value']['titleline']))
{
	$titleline = $line_detail['value']['titleline'];
}

if($titleline)
{
	echo '<h2 class="jTitle1">';
	echo a($titleline, 'titleline');
	echo '</h2>';
}

?>

<?php if(\dash\url::isLocal()) { ?>
<section class="avand-lg imgLine">
		<video controls="controls" preload="metadata" poster="http://cloud.talambar.local/jb2mm/202012/1-78dbe6f473836e1717a971b2fed5f550.jpg">
			 <source type="video/mp4" src="http://cloud.talambar.local/jb2mm/202012/9-eb5c1399a871211c7e7ed732d15e3a8b.mp4">
		</video>

		<div class="row padMore2">
			<div class="c-xs-12 c-sm-6 c-md-4">
				<a href=""><img src="http://cloud.talambar.local/jb2mm/202012/5-df2917707a77bfb3b735c34687b49eda.jpg"></a>
			</div>
			<div class="c-xs-12 c-sm-6 c-md-4">
				<a href=""><img src="http://cloud.talambar.local/jb2mm/202012/5-df2917707a77bfb3b735c34687b49eda.jpg"></a>
			</div>
			<div class="c-xs-12 c-sm-6 c-md-4">
				<a href=""><img src="http://cloud.talambar.local/jb2mm/202012/5-df2917707a77bfb3b735c34687b49eda.jpg"></a>
			</div>
			<div class="c-xs-12 c-sm-6 c-md-4">
				<a href=""><img src="http://cloud.talambar.local/jb2mm/202012/5-df2917707a77bfb3b735c34687b49eda.jpg"></a>
			</div>
			<div class="c-xs-12 c-sm-6 c-md-4">
				<a href=""><img src="http://cloud.talambar.local/jb2mm/202012/5-df2917707a77bfb3b735c34687b49eda.jpg"></a>
			</div>
			<div class="c-xs-12 c-sm-6 c-md-4">
				<a href=""><img src="http://cloud.talambar.local/jb2mm/202012/5-df2917707a77bfb3b735c34687b49eda.jpg"></a>
			</div>
		</div>
</section>



<?php } ?>

