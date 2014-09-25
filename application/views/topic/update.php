    <div class="page-header">
      <h1>更新新聞</h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        <form role="form" action="/topic/edit/<?php echo $item->id; ?>" method="POST">
          <div class="form-group">
            <label for="title">標題</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="請輸入標題" value="<?php echo htmlspecialchars($item->title); ?>">
          </div>
          <div class="form-group">
            <label for="description">描述</label>
            <textarea class="form-control" rows="3" id="description" name="description"><?php echo htmlspecialchars($item->description); ?></textarea>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="is_feature" <?php if ($item->is_feature == "1"):?>checked<?php endif;?>> 是否置頂
            </label>
          </div>
          <button type="submit" class="btn btn-default">送出</button>
        </form>
      </div>
    </div>
