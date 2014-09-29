    <div class="page-header">
      <h1>新聞列表</h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>重要</th>
              <th>建立者</th>
              <th>標題</th>
              <th>描述</th>
              <th>建立時間</th>
              <th>修改時間</th>
              <?php if(isset($is_login) and $is_login): ?><th>動作</th><?php endif;?>
            </tr>
          </thead>
          <tbody>
              <?php foreach ($items as $key => $row) {
                $label = ($row->is_feature == "1") ? "<span class='label label-warning'>置頂</span>" : "";
              ?>
              <tr>
                <td><?php echo ($key + 1); ?></td>
                <td><?php echo $label; ?></td>
                <td><?php echo isset($row->user->username) ? $row->user->username : ""; ?></td>
                <td><?php echo htmlspecialchars($row->title); ?></td>
                <td><?php echo htmlspecialchars($row->description); ?></td>
                <td><?php echo $row->created_at; ?></td>
                <td><?php echo $row->updated_at; ?></td>
                <?php if(isset($is_login) and $is_login): ?>
                <td>
                  <a href="/topic/delete/<?php echo $row->id; ?>" class="btn btn-sm btn-danger">刪除</a>
                  <a href="/topic/edit/<?php echo $row->id; ?>" class="btn btn-sm btn-info">修改</a>
                </td>
                <?php endif;?>
              </tr>
              <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
