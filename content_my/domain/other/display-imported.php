
<?php $sortLink = \dash\data::sortLink(); ?>


<?php if (\dash\detect\device::detectPWA()) { ?>
<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
       <a class="item f" href="<?php echo \dash\url::this(); ?>/setting?domain=<?php echo a($value, 'name'); ?>">
        <div class="key"><code><?php echo a($value, 'name'); ?></code></div>
        <div class="go"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php } else { ?>

<div class="fs12">
    <table class="tbl1 v1 responsive">
        <thead>
            <tr class="fs09">
                <th><?php echo T_("Domain"); ?></th>
                <th><?php echo T_("Date created"); ?></th>

            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr <?php  if(a($value, 'status') === 'disable') { echo 'class="negative"'; }?> >
                <td>
                    <a href="<?php echo \dash\url::this(); ?>/setting?domain=<?php echo a($value, 'name'); ?>" class="link flex"><code><?php echo a($value, 'name'); ?></code></a>
                </td>
                <td>
                	<?php echo \dash\fit::date_time(a($value, 'datecreated')) ?>
                </td>


            </tr>
            <?php } //endfor ?>
        </tbody>
    </table>
</div>
<?php } //endif ?>
<?php \dash\utility\pagination::html(); ?>