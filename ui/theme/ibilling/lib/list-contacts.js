$(document).ready(function () {


    $(".cdelete").click(function (e) {
        e.preventDefault();
        var id = this.id;
        bootbox.confirm(_L['are_you_sure'], function(result) {
           if(result){
               var _url = $("#_url").val();
               window.location.href = _url + "delete/crm-user/" + id;
           }
        });
    });











});