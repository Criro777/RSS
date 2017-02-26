$(document).ready(function () {

    $("#msgSubmit").hide();
    $("#view").hide();

});

$("#content").click(function () {


    $.post("/article/load/", {}, function (data) {

        if (data == "success")
            $("#content").fadeOut(200);
            $("#msgSubmit").fadeIn(400);
            $("#view").fadeIn(400);

    });


});


