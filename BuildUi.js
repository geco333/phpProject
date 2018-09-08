var is_admin = '',
    user = '',
    $php_response = $("<div></div>", {
        id: 'php_response'
    }),
    $btn_add = $("<button>Add</button>"),
    $btn_remove = $("<button>Remove</button>"),
    $bottom = $('<div></div>', {
        id: 'bottom',
        css: {
            padding: '5px',

            border: '3px solid black',
            'border-radius': '10px'
        }
    }),
    arr_append_to_body = [];



function getAdminAndUser(a, u) {
    is_admin = a;
    user = u;
} // setAdminAndUser

$.when($.post('IsAdmin.php'), $.post('getUser.php')).done(function (a, u) {
    getAdminAndUser(a[0], u[0]);
});

if ($("#filter_key :selected").closest('optgroup').attr('value') == 'by_score') {
    $('#filter_condition').css('visibility', 'visible');

    var filter_cond = $("#filter_condition :selected").val();
    var filter_text = $("#filter_text").val();
} // if
else {
    $('#filter_condition').css('visibility', 'hidden');

    var filter_cond = '';
    var filter_text = '';
}


function showDb(data) {
    jsonDb = JSON.parse(data);

    $("#db").empty();

    jsonDb.forEach(function (m, i) {
            $("#db").append("<div class='card align-text-top bg-dark text-light' id='" + m['title'] + "'><div class='card-body'></div><img  class='card-img-top' onclick='movieModal(jsonDb[" + i + "])' src='" + m['poster_url'] + "'>");

            if (is_admin == 'true') {
                $("#db").append("<div class ='card-footer bg-secondary'><input class='movie_selector' type='checkbox' value = '" + m['title'] + "'>Select</style></div></div>");
            }
        }) // forEach
} // showDb


function LoadDb() {
    var search = $("#search_value").val(),
        search_key = $("#search_key option:selected").val(),
        t = $("#filter_key :selected").closest('optgroup').attr('value'),
        filter_group = t ? t : '',
        filter = $("#filter_key option:selected").val(), // Search filter.
        t = $("#sort_key :selected").closest('optgroup').attr('value'),
        sort_group = t ? t : '',
        sort = $("#sort_key option:selected").val(); // Sort key.

    $.when($.post("show_db.php", {
        'search': search,
        'search_key': search_key,
        'sort': sort,
        'sort_group': sort_group,
        'filter': filter,
        'filter_group': filter_group,
        'filter_cond': filter_cond,
        'filter_text': filter_text
    })).done(function (data) {
        showDb(data);
    });
} // LoadDb


$(function () {
    // Setup html elements.
    if (is_admin == 'true') {
        $btn_add.attr({
            type: 'button',
            'class': 'btn btn-primary',
            click: 'AddToDatabase()'
        });
        $btn_remove.attr({
            type: 'button',
            'class': 'btn btn-primary',
            click: 'RemoveFromDataBase()'
        }).css({
            position: 'absolute',
            right: '25px'
        });

        arr_append_to_body.push($bottom.append($btn_add, $btn_remove));
    } // if

    $("body").append(arr_append_to_body);


    LoadDb();
});
