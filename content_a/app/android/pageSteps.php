<div class="stepGuide">
 <section>
  <div class="f"><?php
$mySteps = \content_a\app\android\view::stepSetup();
foreach ($mySteps as $key => $item)
{
	echo '<div class="c">';
	// echo '<a class="">';
	echo '<a class="item';
	if(isset($item['class']))
	{
		echo ' '. $item['class'];
	}
	echo '"';
	if(isset($item['link']))
	{
		echo ' href="'. $item['link']. '"';
	}
	echo '>';
	if(isset($item['title']))
	{
		echo $item['title'];
	}
	echo '</a>';
	echo '</div>';
}
?></div>
 </section>
</div>
