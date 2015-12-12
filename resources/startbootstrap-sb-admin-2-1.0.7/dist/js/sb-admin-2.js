$(function() {

    $('#side-menu').metisMenu();

    //datepicket
    $("#date,#start_date,#end_date,#leaved_country_date,#arrived_country_date,#tr_date,.date,input[name*='date']").attr("data-date-format", "DD-MM-YYYY");
    $("#date,#start_date,#end_date,#leaved_country_date,#arrived_country_date,#tr_date,.date, input[name*='date']").datetimepicker({
        pickTime: false
    });
    $("#date,#start_date,#end_date,#leaved_country_date,#arrived_country_date,#tr_date,.date").on("dp.change",function (e) {
       $('#date,#start_date,#end_date, #leaved_country_date,#arrived_country_date,#tr_date,.date').data("DateTimePicker").hide();
    });

    //range date
    $('#dpd1').attr("data-date-format", "DD-MM-YYYY");
    $('#dpd2').attr("data-date-format", "DD-MM-YYYY");
    $('#dpd1').datetimepicker({ pickTime: false });
    $('#dpd2').datetimepicker({ pickTime: false });
    $("#dpd1").on("dp.change",function (e) {
       $('#dpd2').data("DateTimePicker").setMinDate(e.date);
       $('#dpd1').data("DateTimePicker").hide();
       $('#dpd2').data("DateTimePicker").show().focus();
    });
    $("#dpd2").on("dp.change",function (e) {
       $('#dpd1').data("DateTimePicker").setMaxDate(e.date);
       $('#dpd2').data("DateTimePicker").hide();
    });
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});
