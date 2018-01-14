function converteData(input, hidden) {
    var date = $(input).val();
    date = date.split("/").reverse().join("-");
    $(hidden).val(date);
}

$(document).ready(function () {

    $("#irmaos").select2({
        language: {
            noResults: function () {
                return "Irmã(o) não encontrada(o)!";
            }
        }
    });

    $("#irmaos").select2({
        placeholder: "Selecione irmão(s)",
        maximumSelectionLength: 10,
        language: {
            noResults: function () {
                return "Irmã(o) não encontrada(o)!";
            },
            maximumSelected: function () {
                return "Só é possível incluir 10 irmãos no máximo!";
            }
        }
    });
});