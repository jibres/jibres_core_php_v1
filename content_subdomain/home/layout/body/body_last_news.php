
<?php
\dash\data::allPostList(\dash\app\posts::get_post_list(['pagenation' => true]));

if(\dash\data::allPostList())
{
?>

<main>



<?php
foreach (\dash\data::allPostList() as $key => $post)
{
?>


<article>
  <header>
    <h2><a href="<?php echo \dash\get::index($post, 'link'); ?>"><?php echo \dash\get::index($post, 'title'); ?></a></h2>
    <div class="meta">
<?php if(\dash\get::index($post, 'subtitle')) {?>
      <div class="fs09"><?php echo \dash\get::index($post, 'subtitle'); ?></div>
<?php } //endif ?>
      <time datetime="<?php echo \dash\get::index($post, 'publishdate'); ?>"><?php echo \dash\fit::date_human(\dash\get::index($post, 'publishdate')); ?></time>
    </div>
  </header>
  <section>
<?php if(\dash\get::index($post, 'meta', 'thumb')) {?>

    <a href="<?php echo \dash\get::index($post, 'link'); ?>" class="thumb">
      <img src="<?php echo \dash\get::index($post, 'meta', 'thumb'); ?>" alt="<?php echo \dash\get::index($post, 'title'); ?>">
    </a>
<?php } //endif ?>
    <p><?php echo \dash\get::index($post, 'excerpt'); ?></p>
    <div class="more"><a href="<?php echo \dash\get::index($post, 'link'); ?>"><?php echo T_("Keep Reading"); ?> <span class="sf-angle-double-right"></span></a></div>
  </section>
</article>

<?php
} // end foreach
?>
</main>



<?php
} // end if
\dash\utility\pagination::html();
?>
