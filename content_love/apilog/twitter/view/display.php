<div class="tblBox ltr">
  <table class="tbl1 v4">
    <tbody>
    <?php foreach (\dash\data::dataRow() as $key => $value) {?>
      <tr>
        <td class="collapsing font-14"><?php echo $key ?></td>
        <td>
<pre><?php
            if(substr($value, 0, 1 ) === '{' || substr($value, 0, 1 ) === '[')
            {
              $value = json_decode($value, true);
              $value = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            }
            echo $value;
?></pre>
        </td>
      </tr>
    <?php } //endfor ?>

    </tbody>
  </table>
</div>
