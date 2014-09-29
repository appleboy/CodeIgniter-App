<script id="handlebar-topic-list" type="text/x-handlebars-template">
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
            {{#is_login}}<th>動作</th>{{/is_login}}
          </tr>
        </thead>
        <tbody id="topic-list">
        {{#each items}}
        <tr>
          <td>{{@index}}</td>
          <td></td>
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

</script>
