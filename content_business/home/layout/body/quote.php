<?php

$quote = [];

if(isset($line_detail['value']['quote']) && is_array($line_detail['value']['quote']))
{
	$quote = $line_detail['value']['quote'];
}
// @TODO @Reza . if count of quote > 3 get random
?>

<?php if($quote) {?>


<div class="avand">
	<div class="f">

	<?php foreach ($quote as $key => $value) {?>
      <div class="c4 m6 s12 pA15">
        <div class="item f f-column justify-between">
          <p class="flex-1"><?php echo \dash\get::index($value, 'text') ?></p>
          <div class="fiveStar"><?php if(\dash\get::index($value, 'star')) { echo str_repeat('<span></span>', \dash\get::index($value, 'star')); } ?></div>

          <footer class="f align-center from">
            <div class="cauto"><img class="avatar" src="<?php echo \lib\filepath::fix(\dash\get::index($value, 'image')); ?>" alt="<?php echo \dash\get::index($value, 'displayname'); ?>"></div>
            <div class="cauto pLa10">
              <div class="name"><?php echo \dash\get::index($value, 'displayname') ?></div>
              <div class="position"><?php echo \dash\get::index($value, 'job') ?></div>
            </div>
          </footer>

    	</div>
      </div>

    <?php } //endif ?>

	</div>
</div>
<?php } //endif ?>
