
<div class="fs12">
    <table class="tbl1 v1 responsive">
        <thead>
            <tr class="text-sm">

                <th data-sort="<?php echo a($sortLink, 'name', 'order'); ?>" ><a href="<?php echo a($sortLink, 'name', 'link'); ?>"><?php echo T_("Domain"); ?></a></th>

                <th class="text-left" data-sort="<?php echo a($sortLink, 'status', 'order'); ?>"><a href="<?php echo a($sortLink, 'status', 'link'); ?>"><?php echo T_("Status"); ?></a></th>
                <th class="text-left" data-sort="<?php echo a($sortLink, 'dateexpire', 'order'); ?>"><a href="<?php echo a($sortLink, 'dateexpire', 'link'); ?>"><?php echo T_("Expire date"); ?></a></th>
                <th class="text-left" data-sort="<?php echo a($sortLink, 'dateregister', 'order'); ?>"><a href="<?php echo a($sortLink, 'dateregister', 'link'); ?>"><?php echo T_("Create date"); ?></a></th>
                <th class="text-left" data-sort="<?php echo a($sortLink, 'dateupdate', 'order'); ?>"><a href="<?php echo a($sortLink, 'dateupdate', 'link'); ?>"><?php echo T_("Date modified"); ?></a></th>

                <th class="text-left"><?php echo T_("User"); ?></th>
            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr>
                <td>
                    <a href="<?php echo \dash\url::this(); ?>/setting?id=<?php echo a($value, 'id'); ?>" class="link-primary"><code><?php echo a($value, 'name'); ?></code></a>
                </td>

                <td class="collapsing text-left"><?php echo a($value, 'tstatus'); ?></td>
                <td class="collapsing text-left"><?php echo \dash\fit::date_time(a($value, 'dateexpire')); ?></td>
                <td class="collapsing text-left"><?php echo \dash\fit::date_time(a($value, 'dateregister')); ?></td>
                <td class="collapsing text-left"><?php echo \dash\fit::date_time(a($value, 'dateupdate')); ?></td>


                <td class="collapsing">
                  <a href="<?php echo \dash\url::that(). '?user='. \dash\coding::encode(a($value, 'user_id')); ?>" class="f align-center userPack">
                    <div class="c pRa10">
                      <div class="mobile"><?php echo \dash\fit::mobile(a($value, 'user_detail', 'mobile')); ?></div>
                      <div class="name"><?php echo a($value, 'user_detail', 'displayname'); ?></div>
                    </div>
                    <img class="cauto" src="<?php echo a($value, 'user_detail', 'avatar'); ?>">
                  </a>
                </td>

            </tr>
            <?php } //endfor ?>
        </tbody>
    </table>
</div>
<?php \dash\utility\pagination::html(); ?>
