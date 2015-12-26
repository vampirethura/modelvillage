$('.deletion-modal').on('click', function(event){
    var href = $(this).attr('href');
    var message = $(this).attr('data-content');
    var title = $(this).attr('data-title');

    var modalbox =
    '<div id="deleteModal" class="modal modal-danger">' +
      '<div class="modal-dialog">' +
        '<div class="modal-content">' +
          '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            '<h4 class="modal-title">' + title +'</h4>' +
          '</div>' +
          '<div class="modal-body">' +
            '<p id="msg-content"></p>' +
          '</div>' +
          '<div class="modal-footer">' +
            '<form id="deleteForm" action="" method="POST">' +
              '<input type="hidden" name="_method" value="delete">'+
              '<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>' +
              '<button type="submit" class="btn btn-outline">Save changes</button>' +
            '</form>' +
          '</div>' +
        '</div><!-- /.modal-content -->' +
      '</div><!-- /.modal-dialog -->' +
    '</div><!-- /.modal -->';

    if (!$('#deleteModal').length) {
        $('body').append(modalbox);
    }

    $('#deleteModal').find('#msg-content').text(message);
    $('#deleteForm').attr('action', href);
    $('#deleteModal').modal({show:true});
});

$('.removal-modal').on('click', function(event){
    var href = $(this).attr('href');
    var message = $(this).attr('data-content');
    var title = $(this).attr('data-title');

    var modalbox =
    '<div id="removeModal" class="modal modal-danger">' +
      '<div class="modal-dialog">' +
        '<div class="modal-content">' +
          '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            '<h4 class="modal-title">' + title +'</h4>' +
          '</div>' +
          '<div class="modal-body">' +
            '<p id="msg-content"></p>' +
          '</div>' +
          '<div class="modal-footer">' +
            '<form id="removeForm" action="" method="POST">' +
              '<input type="hidden" name="_method" value="delete">'+
              '<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>' +
              '<button type="submit" class="btn btn-outline">Save changes</button>' +
            '</form>' +
          '</div>' +
        '</div><!-- /.modal-content -->' +
      '</div><!-- /.modal-dialog -->' +
    '</div><!-- /.modal -->';

    if (!$('#removeModal').length) {
        $('body').append(modalbox);
    }

    $('#removeModal').find('#msg-content').text(message);
    $('#removeForm').attr('action', href);
    $('#removeModal').modal({show:true});
});
