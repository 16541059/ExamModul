var modal=$("#questionModal");
var btn=$("#addQuestionBtn");
var close=$(".close");
btn.click(function () {
    //modal.css("display","block");
    modal.show( "fast" );
});
close.click(function (){

    //    modal.css("display","none");
    modal.hide( "fast" );

});
$(window).click(function (e){

    if (e.target == modal[0]) {
        //   modal.css("display","none");
        modal.hide( "fast" );
    }
});

var modalExam=$("#examModal");
var btnExam=$("#examAddModal");
var closeExam=$(".close");
btnExam.click(function () {

    modalExam.show( "fast" );
});
closeExam.click(function (){


    modalExam.hide( "fast" );

});
$(window).click(function (e){

    if (e.target == modalExam[0]) {
        //   modal.css("display","none");
        modalExam.hide( "fast" );
    }
});



$("#addQuestion").click(function () {
    var questionSelectVal=   $("#questionSelect").val();
    const  examid = $(this).attr('value');
    switch(questionSelectVal) {
        case "multipleChoice":

            $(location).attr('href', '/php/teacher/multipleChoice.php?id='+examid);
            break;
        case "trueFalse":
            $(location).attr('href', '/php/teacher/trueFalse.php?id='+examid);
            break;
        case "gapFilling":
            $(location).attr('href', '/php/teacher/gapFilling.php');
            break;
        case"openCloze":
            $(location).attr('href', '/php/teacher/openCloze.php');
            break;
        default:
        // code block
    }
});

var start = new Date(),
    prevDay,
    startHours = 8;

// 09:00 AM
start.setHours(8);
start.setMinutes(0);

// If today is Saturday or Sunday set 10:00 AM
if ([6, 0].indexOf(start.getDay()) != -1) {
    start.setHours(10);
    startHours = 10
}

$('#timepicker-actions-exmpl,#timepicker-actions-exmpl2').datepicker({
    timepicker: true,
    language: 'tr',
    startDate: start,
    minHours: startHours,
    maxHours: 23,
    onSelect: function (fd, d, picker) {
        // Do nothing if selection was cleared
        if (!d) return;

        var day = d.getDay();

        // Trigger only if date is changed
        if (prevDay != undefined && prevDay == day) return;
        prevDay = day;

        // If chosen day is Saturday or Sunday when set
        // hour value for weekends, else restore defaults
        if (day == 6 || day == 0) {
            picker.update({
                minHours: 10,
                maxHours: 16
            })
        } else {
            picker.update({
                minHours: 0,
                maxHours: 23
            })
        }
    }
})


$(".deleteExam").click(function (){

    const  destroy_id = $(this).attr('id');
    $.ajax({
        type:"POST",
        url:"process.php",
        data:'id='+destroy_id,
        success:function (msg){
            $("#exam-"+destroy_id).remove();
            console.log(msg);

        },
        error:function (){
            console.log("erorr");
        }
    })

});




$("input[id='radio']").change(function(e){
    e.preventDefault();
    var radioValue=$('input[id="radio"]:checked').val();
    var pass_data = {
        'radioValue' : radioValue,
    };
    $.ajax({
        type: "GET",
        data: pass_data,
        encode:true,
        success: function () {
            console.log("success");
            $(window).attr('location', 'index.php?radioValue='+radioValue)
           // window.location.reload();

        },
        error: function () {
            console.log("erorr");
        }
    });

    if(radioValue){
        console.log( radioValue);
    }
});
$("tr").click(function (e) {
    if (e.target.type !== 'radio') {
        $(':radio', this).trigger('click');
    }

});



$(".card-header").click(function (){
var id=    $(this).attr("id");
$("#exam-"+id).toggle("slow");
});
