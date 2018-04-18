console.log("okgo");
var rate = 0;
$(document).on('input change', '#range', function() {
    rate = $(this).val();

    // hide all
    for(var i = 1; i < 11; i++) {
        $( "#range" + i ).css({visibility: "hidden"});
    }
    $( "#range" + rate ).css({visibility: "visible",animation: 'bounce 0.5s'});

});