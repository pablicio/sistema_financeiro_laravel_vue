/**
 * Created by pabliciotjg on 16/08/2017.
 */
var changeContribuintes = document.querySelector('.contribuintes');

changeContribuintes.onchange = function () {

    var sim = changeContribuintes.checked;

    if (sim) {
        $('#contribuinte_icms').val(1);
    }
    else {
        $('#contribuinte_icms').val(0);
    }
};

//# sourceMappingURL=contribuintesSwitchery.js.map
