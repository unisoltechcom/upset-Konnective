var $ = jQuery;
$(document).ready(function () {
    $('#chkForm').submit(function () {
        $('#loader-modal').show();
    });
});

(function (e, a) {

    var t, r = e.getElementsByTagName("head")[0], c = e.location.protocol;

    t = e.createElement("script");
    t.type = "text/javascript";

    t.charset = "utf-8";
    t.async = !0;
    t.defer = !0;

    t.src = c + "//front.optimonk.com/public/" + a + "/js/preload.js";
    r.appendChild(t);

})(document, "14547");
$('document').ready(function () {


    var sec;
    var min;
    var hr;
    var running = true;
    var clock = document.getElementById("clockrow");

    function ResetClock() {
        var form = $("#form-payment").attr('data-payment');

        if (form == '4') {
            sec = 59;
            min = 1;
            hr = 0;
        } else {
            sec = 59;
            min = 29;
            hr = 0;
        }
    }

    function StartCountDown() {
        sec--;
        if (sec < 0) {
            sec = 59;
            min--;
            if (min < 0) {
                clearInterval(timeinterval);
                running = false;
            }
        }
        if (running) {
            clock.innerHTML = '<td> 0' + hr + '</td>' +
                '<td> : </td>' +
                '<td>' + ((min < 10) ? "0" + min : min) + '</td>' +
                '<td> : </td>' +
                '<td>' + ((sec < 10) ? "0" + sec : sec) + '</td>';
        }
    }

    ResetClock();
    // timeinterval = setInterval(StartCountDown, 1000);


    $("#digital-check").click(function () {
        if ($(this).is(":checked")) {
            $("#digital").val(88);
            $("#bumpamount2").show();

        } else {
            $("#digital").val('');
            $("#bumpamount2").hide();
        }
    });

    $("#2books").click(function () {
        if ($(this).is(':checked')) {
            $('#product').val(230);
            $('#buy').val(2);
            $('#book1').hide();
            $('#book3').hide();
            $('#book4').hide();
            $('#book2').show();
        }
    });
    $("#1book").click(function () {
        if ($(this).is(':checked')) {
            $('#product').val(87);
            $('#buy').val(1);
            $('#book2').hide();
            $('#book3').hide();
            $('#book4').hide();
            $('#book1').show();

        }
    });

    $("#3books").click(function () {
        if ($(this).is(':checked')) {
            $('#product').val(231);
            $('#buy').val(3);
            $('#book2').hide();
            $('#book1').hide();
            $('#book4').hide();
            $('#book3').show();
        }
    });

    $("#4books").click(function () {
        if ($(this).is(':checked')) {
            $('#product').val(252);
            $('#buy').val(4);
            $('#book2').hide();
            $('#book1').hide();
            $('#book3').hide();
            $('#book4').show();
        }
    });



});