$(function() {

    //If the example modal is present, configure it to load
    if ($('#commentBox').length !== 0) {
        $('#commentBox').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var type = button.data('type');

            var modal = $(this);

            //Get post ID for action links
            var postID = button.data('postid');

            //For new, we have to restore the modal!
            if(type === 'new'){
                modal.find('.modal-title').text('New Comment');

                
                modal.find('#authorField').val('');
                modal.find('#contentField').text('');
                modal.find('form').attr('action', url + 'comments/create/' + postID);
            } else if(type === 'edit'){
                modal.find('.modal-title').text('Edit Comment');

                var box = button.parent().parent();

                //Load original content
                var author = box.find('.comment-author').text().trim();
                var content = box.find('.comment-content').text().trim();

                //Load information to determine action path
                var commentID = button.data('commentid'); 

                //Modify modal
                modal.find('#authorField').val(author);
                modal.find('#contentField').text(content);
                modal.find('form').attr('action', url + 'comments/edit/' + postID + '/' + commentID);
            }
        });
    }
});
