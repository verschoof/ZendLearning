$(document).ready(function() {
    $(".question-box").on('click', function() {
        if ($(this).is(':checked')) {
            $(this).closest('li').addClass('done');
        } else {
            $(this).closest('li').removeClass('done');
        }

        updateList(".question-list");
    });
});

function updateList(target)
{
    target = $(target);

    var questions   = target.find('.question-box:checked');
    var checkedList = [];
    $(questions).each(function(key, checkbox) {
        checkbox = $(checkbox);

        checkedList.push(checkbox.attr('id'));
    });

    $.post('/update.php', {'list': checkedList});
}
