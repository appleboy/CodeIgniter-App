<script id="handlebar-topic-list" type="text/x-handlebars-template">
  <div id="topic-list">
  <div class="page-header">
    <h1>新聞列表&nbsp;<button type="button" class="btn btn-success">建立新聞</button></h1>
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
            {{#is_login}}<th>動作</th>{{/is_login}}
          </tr>
        </thead>
        <tbody id="topic-list">
        {{#each items}}
        <tr>
          <td>{{@index}}</td>
          <td>{{#ifCond is_feature "1"}}<span class='label label-warning'>置頂</span>{{/ifCond}}</td>
          <td>{{user.username}}</td>
          <td>{{title}}</td>
          <td>{{description}}</td>
          <td>{{created_at}}</td>
          <td>{{updated_at}}</td>
          {{#../is_login}}
          <td>
            <a href="/topic/delete/{{id}}" data-id="{{id}}" class="btn btn-sm btn-danger">刪除</a>
            <a href="/topic/edit/{{id}}" data-id="{{id}}" class="btn btn-sm btn-info">修改</a>
          </td>
          {{/../is_login}}
        </tr>
        {{/each}}
        </tbody>
      </table>
    </div>
  </div>
  <div id="editor"></div>
  </div>
</script>

<script id="handlebar-topic-editor" type="text/x-handlebars-template">
  <div class="row">
    <div class="col-md-12">
      <form role="form" action="/topic" method="POST">
        <div class="form-group">
          <label for="title">標題</label>
          <input type="text" class="form-control title" id="title" name="title" value="{{title}}" placeholder="請輸入標題">
        </div>
        <div class="form-group">
          <label for="description">描述</label>
          <textarea class="form-control description" rows="3" id="description" name="description">{{description}}</textarea>
        </div>
        <div class="checkbox">
          <label>
            <input class="is_feature" type="checkbox" name="is_feature" value="1" {{#ifCond is_feature "1"}}checked{{/ifCond}}> 是否置頂
          </label>
        </div>
        <button type="submit" class="btn btn-default" data-id="{{id}}">送出</button>
      </form>
    </div>
  </div>
</script>
