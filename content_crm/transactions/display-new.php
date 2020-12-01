<section class="emptyState">
  <img src="<?php echo \dash\url::cdn(); ?>/img/gif/jibres-empty-1.gif" alt='<?php echo T_("Empty State") ?>'>
  <h2><?php echo T_("There are no items here!") ?></h2>
<?php if(\dash\data::action_icon() === 'plus') {?>
  <h3><?php echo T_("Start adding your item") ?></h3>
  <a href="<?php echo \dash\data::action_link(); ?>"><?php echo \dash\data::action_text(); ?></a>
<?php }?>
</section>
