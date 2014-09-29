(function($){

  var app = {
    init: function(){
      var self = this;
      // load main template
      self.initTopicList();
      self.initDeleteButton();
    },

    template: function(id, data) {
      var source   = $("#handlebar-" + id).html();
      data = data || {};
      var output = Handlebars.compile(source);

      return output(data);
    },

    initTopicList: function() {
      var self = this;
      $.get('/api/topic', function(data){
        console.log(data);
        $('#main').append(self.template('topic-list', data));
      });
    },

    initDeleteButton: function() {
      $(document).on('click', '.btn-danger', function(e) {
        e.preventDefault();
        var self = this;
        var id = $(this).data('id');
        if (window.confirm("Do you want to delete this news?")) {
          $.ajax({
            url: '/api/topic/' + id,
            type: 'DELETE',
            success: function(data) {
              $(self).parent().parent().remove();
            },
            error: function(jqXHR, textStatus, errorThrown ) {
              console.log(jqXHR);
              console.log(textStatus);
            }
          });
        }
      });
    }
  };

  window.app = app;

})(jQuery);

$(document).ready(function() {
  app.init();
});