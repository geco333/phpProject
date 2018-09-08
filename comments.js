class comment {
    constructor(v) {
            this.$text_col = $('<div></div>', {
                'class': 'col'
            });
            this.$user_col = $('<div></div>', {
                'class': 'col-1'
            });
            this.$row = $('<div></div>', {
                'class': 'row'
            });

            this.$text_col.append(v['comment']);
            this.$user_col.append(v['username']);

            if (window.user == 'admin') {
                this.$radio = $('<input>');
                this.$radio.attr('name', 'select');
                this.$radio.attr('type', 'radio');
                this.$radio.attr('value', v['cid']);

                this.$radio_col = $('<div></div>', {
                    'class': 'col-1',
                    append: this.$radio
                });

                this.$row.append(this.$radio_col);
            } // if

            this.$row.append([this.$user_col, this.$text_col]);

            $("#comments").append(this.$row);
        } // constructor
} // comment


function showComments(title) {
    $comments = $.post('getComments.php', {
        title: title
    }, function (data) {
        $.each(JSON.parse(data), function (i, v) {
            c = new comment(v);
        });
    });

    $("#comments").empty();

} // showComments


function addComment(e) {
    var title = $("#title").text(),
        user = window.user,
        comment_to_add = $(e.target).parent().siblings("#comment_textarea").val();

    $.post('addComment.php', {
        title: title,
        username: user,
        comment: comment_to_add
    });

    showComments(title);
} // addComment


function deleteComment(e) {
    var title = $("#title").html(),
        cid = $("#comments div div input:checked")[0].value;

    $.post('deleteComment.php', {
        cid: cid
    }, function () {
        showComments(title);
    })
} // addComment
