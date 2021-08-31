
// var div = document.getElementById('employee_no');
// alert(div.value);
//
// var divContains_Div = document.getElementById('show_employee_no').contains(div);

// alert(divContains_Div);


$(document).ready(function () {
    $('body').on('blur','#employee_no', function() {

        var employee_no = $('#employee_no').val();

        console.log($("#searchText:contains(employee_no)").css( "text-decoration", "underline" ));



        // function highlight(text) {
        //     var inputText = document.getElementById("inputText");
        //     var innerHTML = inputText.innerHTML;
        //     var index = innerHTML.indexOf(text);
        //     if (index >= 0) {
        //         innerHTML = innerHTML.substring(0,index) + "<span class='highlight'>" + innerHTML.substring(index,index+text.length) + "</span>" + innerHTML.substring(index + text.length);
        //         inputText.innerHTML = innerHTML;
        //     }
        // }


    });


        // var  employee_no = $("#employee_no").val();
        //
        // $( "#employeeSearchList:contains(employee_no)").css( "text-decoration", "underline" );

        // alert($("#employee_no").val());
       // alert($('tr').attr("id"));

        // var  employee_no = $("#employee_no").val();
        // // var abc = $("#show_employee_no").contains(employee_no);
        //
        // console.log($('tr').attr("id"));



            // $("#employeeSearchList").innerText('........');
            //$("#card_no").keyup();
            // alert( $("#card_no").val() );


            //===========================================================================

            // Use a regular expression to do a case-insensitive search for "w3schools" in a string:
            // var str = "Visit W3Schools begin sit";
            // var res = str.match(/si/g);
            // var text = '<span ="style:background:green">'+res+'<span>';
            // console.log(text);

            // $( "div:contains('John')" ).css( "text-decoration", "underline" );


            //===========================================================================
            //Use a string to do a search for "W3schools" in a string:
            // var str = "Visit W3Schools!";
            // var n = str.search("W3Schools");
            //===========================================================================


            // var str = "Visit W3Schools!";
            // // var n = str.search("W3Schools");
            // var res = str.match(/ain/g);
            // console.log(res);

            // var str = "The rain in SPAIN stays mainly in the plain";
            // var str = document.getElementById("#card_no").value();

            // var str = $("#card_no").val();
            // console.log(str.search( /a/i ));
            // var res = str.match(/ain/g);

            //var str = "A drop of ink may make a million think";
            // alert( str.search( /a/i ) ); // 0 (the first position)



            // console.log(window.location);
            // var abc = window.location;
            // var queryString = url ? url.split('/')[1] : window.location.search.slice(1);

            // var c = url.searchParams.get("c");
            // console.log(url.pathname);
            // console.log(url.pathname[1]);
            // console.log('queryString :'+queryString);


});
