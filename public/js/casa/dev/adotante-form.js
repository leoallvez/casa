function limparNomeConjuge() {
    $('.conjuge').val('');
}

$(function () {
    $('#estado_civil_id').change(function () {
        if ($('#estado_civil_id').val() == 2 || $('#estado_civil_id').val() == 6) {
            $('#conjuge').show();
        } else {
            $('#conjuge').hide();
        }
    });
});

function converteData(input, hidden) {
    var date = $(input).val();
    date = date.split("/").reverse().join("-");
    $(hidden).val(date);
}