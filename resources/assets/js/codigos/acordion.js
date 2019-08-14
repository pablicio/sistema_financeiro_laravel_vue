/**
 * Created by pabliciotjg on 06/10/2017.
 */
$(document).ready(function(){
    var allPanels = $('.accordion > .inner').hide();

    $('.accordion > h2 > a').click(function() {
        $(this).slideDown(500);
        $(this).toggleClass('selected');
        $(this).parent().next().slideToggle(function() {

        });
        return false;
    });
//
});
