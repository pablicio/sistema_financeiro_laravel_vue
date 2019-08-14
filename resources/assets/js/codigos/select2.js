$(document).ready(function() {
    $(".select2").select2();

    $(".select-limit").select2({
        ajax: {
            url: "/admin/getServico",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    // results: [{id: 2, text: 'Teste2'},{id: 3, text: 'Teste3'}],
                    results: data,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        }
    });

});/**
 * Created by pabliciotjg on 20/06/2017.
 */


