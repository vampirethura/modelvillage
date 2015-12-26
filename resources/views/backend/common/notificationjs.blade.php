<script>
function checkNotification(){
  @if(count(Session::get('message')) != 0)
    var message_title = "{{isset(Session::get('message')['title']) ? Session::get('message')['title'] : ''}}";
    var message_body = "{{isset(Session::get('message')['body']) ? Session::get('message')['body'] : ''}}";
    var type = "{{isset(Session::get('message')['type']) ? Session::get('message')['type'] : ''}}";
    var message = "";
    if (message_title != '' && message_body != '') {
      if(type == ''){ type = 'info'; }
      $.notify({
        title: '<strong>'+ message_title +'</strong><br/>',
        message: message_body
      },{
        type: type
      });
    }else{
      message = "{{!is_array(Session::get('message')) ? Session::get('message') : ''}}";
      if (message != '') {
          $.notify(message);
      }
    }
  @endif
};
function addNotification(title, message, type){
  $.notify({
  	title: '<strong>' + title + '</strong><br/>',
  	message: message
  },{
    type: type
  });
};

@if(count($errors->all()) > 0)
var validation_errors = '';
@foreach ($errors->all("<li>:message</li>") as $key => $error)
    validation_errors += "{!!$error!!}";
@endforeach
addNotification("Validation Failed", validation_errors, 'error');
@endif
</script>
