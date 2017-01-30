var app = {
    playerSearch: function (query) {
        var url = $("#search").data("url");
        $.ajax({
            url: url,
            data: {
                'query': query
            },
            method: 'POST',
            success: function (response) {
                if (response.error == null) {
                    app.displaySearch(response.data);
                }
                else {
                    console.warn(response.error.msg);
                }
            }
        });
    },
    displaySearch: function(data){
        var resultContainer = $("#searchResult");
        resultContainer.html("");

        for (i = 0; i < data.length; i++) {
            var $spanElement = "<span><a href='/player/" + data[i].id + "'>" +
                data[i].name + " " + data[i].surname +

                "</a></span>";
            resultContainer.append($spanElement);
        }

        resultContainer.slideDown(100);
    }

};

var utils = {
    delay: function(callback, ms){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    }(),
    confirm: function(e,msg){
        if(typeof msg == "undefined")
            msg = "delete";
        if(!confirm("Are you sure, you want to " + msg + " ?")) e.preventDefault();
    }
};

$(document).ready(function () {
    //deletion confirmation
    $(".remove").on("click",function(e){
        utils.confirm(e);
    });

    //search
    $("#search").on("keyup", function(){
        var value = $(this).val();
        utils.delay(function(){
            if(value.length > 2){
                app.playerSearch(value);
            }
        },600);

    });

    $('html').on("click",function() {
        if($("#searchResult").is(":visible"))
            $("#searchResult").slideUp(100);
    });

    $("#searchResult").on("click",function(e){
        e.stopPropagation();
    });

});