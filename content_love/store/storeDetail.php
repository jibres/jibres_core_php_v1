<nav class="items ltr">
  <ul>
    <li>
      <a class="f item">
        <div class="key">ID</div>
        <div class="value txtB"><?php echo $dataRow['id'] ?></div>
      </a>
    </li>
    <li>
      <a class="f item">
        <div class="key">Subdomain</div>
        <div class="value txtB"><?php echo $dataRow['subdomain'] ?></div>
      </a>
    </li>
    <li>
      <a class="f item">
        <div class="key">Fuel</div>
        <div class="value txtB"><?php echo $dataRow['fuel'] ?></div>
      </a>
    </li>
    <li>
      <a class="f item">
        <div class="key">Status</div>
        <div class="value txtB"><?php echo $dataRow['status'] ?></div>
      </a>
    </li>
    <li>
      <a class="f item">
        <div class="key">IP</div>
        <div class="value txtB"><?php echo long2ip($dataRow['ip']) ?></div>
      </a>
    </li>
    <li>
      <a class="f item">
        <div class="key">Date created</div>
        <div class="value txtB"><?php echo \dash\fit::date_time($dataRow['datecreated']) ?></div>
      </a>
    </li>
  </ul>
</nav>