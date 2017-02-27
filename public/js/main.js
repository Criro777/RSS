$(document).ready(function () {

    $("#msgSubmit").hide();
    $("#view").hide();

});

$("#content").click(function () {


    $.post("/article/load/", {}, function (data) {

        if (data == "success") {
            $("#content").fadeOut(80);
            $("#msgSubmit").fadeIn(200);
            $("#view").fadeIn(200);
        }

    });


});


