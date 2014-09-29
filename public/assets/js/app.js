(function($){

  var req = function(type, url, object) {
    $.ajax({
      url: url,
      type: type,
      data: (object.data) ? object.data : {},
      success: function(data) {
        if (object.cb) {
          object.cb(data);
        }
      },
      error: function(jqXHR, textStatus, errorThrown ) {
        alertify.error('伺服器發生錯誤');
      }
    });
  };

  var app = {
    init: function(){
      var self = this;
      self.handlebarHelper();
      // load main template
      self.initTopicList();
      // load button action
      self.initAction();
    },

    api: {
      GET: function(url, object) {
        req('GET', url, object);
      },
      POST: function(url, object) {
        req('POST', url, object);
      },
      PUT: function(url, object) {
        req('PUT', url, object);
      },
      DELETE: function(url, object) {
        req('DELETE', url, object);
      }
    },

    handlebarHelper: function(){
      Handlebars.registerHelper('ifCond', function(v1, v2, options) {
        if(v1 === v2) {
          return options.fn(this);
        }
        return options.inverse(this);
      });
    },

    template: function(id, data) {
      var source = $("#handlebar-" + id).html();
      data = data || {};
      var output = Handlebars.compile(source);

      return output(data);
    },

    initTopicList: function() {
      var self = this;
      self.api.GET('/api/topic/list', {
        cb: function(data) {
          $('#topic-list').remove();
          $('#main').append(self.template('topic-list', data));
        }
      });
    },

    initEditor: function(data) {
      var self = this;
      data = data || {};

      $('#editor').html(self.template('topic-editor', data));
      $(document).scrollTo('#editor', 800 );
    },

    initAction: function() {
      var self = this;
      var that = this;
      $(document).on('click', '.btn-danger', function(e) {
        var self = this;
        e.preventDefault();
        var id = $(this).data('id');
        alertify.confirm("Do you want to delete this news?", function (e) {
          if (e) {
            that.api.DELETE('/api/topic/' + id, {
              cb: function(data) {
                $(self).parent().parent().remove();
                alertify.success("刪除成功");
              }
            });
          }
        });
      });

      $(document).on('click', '.btn-info, .btn-success', function(e) {
        e.preventDefault();
        var id = +$(this).data('id') || 0;

        if (id == 0) {
          return self.initEditor();
        }

        self.api.GET('/api/topic/' + id, {
          cb: function(data) {
            self.initEditor(data);
          }
        });
      });

      $(document).on('click', '.btn-default', function(e) {
        e.preventDefault();
        var id = +$(this).data('id') || 0;

        var data = {
          title: $(".title").val(),
          description: $(".description").val(),
          is_feature: +$("input[name='is_feature']").prop('checked')
        };

        var type = (id > 0) ? 'PUT' : 'POST';
        var url = (id > 0) ? '/api/topic/' + id : '/api/topic';

        self.api[type](url, {
          data: data,
          cb: function() {
            self.initTopicList();
          }
        });
      });
    }
  };

  window.app = app;

})(jQuery);

$(document).ready(function() {
  app.init();
});