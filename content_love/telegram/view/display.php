<?php $data = \dash\data::dataRow(); ?>
<div class="box">
  <div class="body">
    <div class="tblBox">
      <table class="tbl1 v4">
        <tbody>
          <?php foreach ($data as $key => $value)
          {
            echo '<tr>';
              echo '<td>';
              echo $key;
              echo '</td>';
              echo '<td>';
            if(substr(strval($value), 0, 1) === '[' || substr(strval($value), 0, 1) === '{')
            {
              $temp = json_decode($value, true);
              if(!is_array($temp))
              {
                echo $value;
              }
              else
              {
                echo '<pre>';
                echo json_encode($temp, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                echo '</pre>';
              }

            }
            else
            {
              echo $value;
            }

              echo '</td>';
            echo '</tr>';
          }
          ?>

            <tr><td><?php echo $key ?></td><td><?php echo $value; ?></td></tr>


        </tbody>
      </table>
    </div>
  </div>
</div>
