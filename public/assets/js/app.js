(function($){

  var app = {
    init: function(){
      var self = this;
      self.handlebarHelper();
      // load main template
      self.initTopicList();
      self.initAction();
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
      $.get('/api/topic/list', function(data){
        $('#topic-list').remove();
        $('#main').append(self.template('topic-list', data));
      });
    },

    initAction: function() {
      var self = this;
      $(document).on('click', '.btn-danger', function(e) {
        var self = this;
        e.preventDefault();
        var id = $(this).data('id');
        alertify.confirm("Do you want to delete this news?", function (e) {
          if (e) {
            $.ajax({
              url: '/api/topic/' + id,
              type: 'DELETE',
              success: function(data) {
                $(self).parent().parent().remove();
                alertify.success("刪除成功");
              },
              error: function(jqXHR, textStatus, errorThrown ) {
                console.log(jqXHR);
                console.log(textStatus);
              }
            });
          }
        });
      });

      $(document).on('click', '.btn-info, .btn-success', function(e) {
        e.preventDefault();
        var id = +$(this).data('id') || 0;

        if (id == 0) {
          $('#editor').html(self.template('topic-editor'));
          $(document).scrollTo('#editor', 800 );
          return true;
        }

        $.ajax({
          url: '/api/topic/' + id,
          type: 'GET',
          success: function(data) {
            $('#editor').html(self.template('topic-editor', data));
            $(document).scrollTo('#editor', 800 );
          },
          error: function(jqXHR, textStatus, errorThrown ) {
            console.log(jqXHR);
            console.log(textStatus);
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

        $.ajax({
          url: (id > 0) ? '/api/topic/' + id : '/api/topic',
          type: (id > 0) ? 'PUT' : 'POST',
          data: data,
          success: function(data) {
            self.initTopicList();
          },
          error: function(jqXHR, textStatus, errorThrown ) {
            console.log(jqXHR);
            console.log(textStatus);
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