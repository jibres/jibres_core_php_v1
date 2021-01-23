<?php $data = \dash\data::dataRow();?>
<nav class="items">
  <ul>
      <li>
      <a class="f item">
        <div class="key"><?php echo T_("ID") ?></div>
        <div class="value txtB"><?php echo \dash\fit::text(\dash\data::dataRow_id()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>

       <li>
      <a class="f item">
        <div class="key"><?php echo T_("Send Method") ?></div>
        <div class="value txtB"><?php echo \dash\data::dataRow_sendmethod(); ?></div>
        <div class="go detail"></div>
      </a>
     </li>


       <li>
      <a class="f item">
        <div class="key"><?php echo T_("Date send") ?></div>
        <div class="value txtB"><?php echo \dash\fit::date_time(\dash\data::dataRow_senddate()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>

    <li>
      <a class="f item" data-kerkere='.showResponse'>
        <div class="key"><?php echo T_("Date response") ?></div>
        <div class="value txtB"><?php echo \dash\fit::date_time(\dash\data::dataRow_responsedate()); ?></div>
        <div class="go detail"></div>
      </a>
     </li>
  </ul>
</nav>

<div class="box">
  <div class="pad">
      <p><?php echo nl2br(a($data, 'sendtext')); ?></p>
  </div>
</div>
<div class="showResponse" data-kerkere-content='hide'>
<pre><?php print_r(a($data, 'response')) ?></pre>
</div>

