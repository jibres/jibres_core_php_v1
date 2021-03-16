<table class="tbl1 v4 font-14">
    <thead>
        <tr>
            <th>id</th>
            <th>Code</th>
            <th>Date</th>
            <th>Valid</th>
            <th>Type</th>
            <th>Message</th>
            <th>User</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>
            <td><?php echo a($value, 'id') ?></td>
            <td><?php echo a($value, 'code') ?></td>

            <td><?php echo \dash\fit::date_time(a($value, 'datecreated')) ?></td>
            <td><?php echo a($value, 'valid') ?></td>
            <td><?php echo a($value, 'errortype') ?></td>
            <td><?php echo a($value, 'message') ?></td>
             <td class="collapsing">
                  <a href="<?php echo \dash\url::that(). '?user='. a($value, 'user_id'); ?>" class="f align-center userPack">
                    <div class="c pRa10">
                      <div class="mobile" data-copy="<?php echo a($value, 'mobile'); ?>"><?php echo \dash\fit::mobile(a($value, 'mobile')); ?></div>
                      <div class="name"><?php echo a($value, 'displayname'); ?></div>
                    </div>
                    <img class="cauto" src="<?php echo a($value, 'avatar'); ?>">
                  </a>
                </td>
        </tr>
        <?php } //endfor ?>
    </tbody>
</table>



<?php \dash\utility\pagination::html(); ?>

