    <div class="page-header">
      <h1>建立新聞</h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        <form role="form" action="/topic/create" method="POST">
          <div class="form-group">
            <label for="title">標題</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="請輸入標題">
          </div>
          <div class="form-group">
            <label for="description">描述</label>
            <textarea class="form-control" rows="3" id="description" name="description"></textarea>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="is_feature"> 是否置頂
            </label>
          </div>
          <button type="submit" class="btn btn-default">送出</button>
        </form>
      </div>
    </div>
