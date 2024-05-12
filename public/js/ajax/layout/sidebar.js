$(document).ready(function () {

    // $(document).ready(function(){
    //     // Add click event listener to the "Add Personal Details" link
    //     $(".nav-link[href='{{ route('show.personalinfo') }}']").click(function(){
    //         // Open EMPLOYEE menu
    //         $(".nav-item:first-child").addClass("menu-open");
    //         // Open HR & PAYROLL menu
    //         $(".nav-item:first-child").parent().parent().addClass("menu-open");
    //     });
    // });

    $(document).on('click', ".nav-link[href='{{ route('show.personalinfo') }}']", function(){
        console.log("Clicked on 'Add Personal Details' link");
        // Open EMPLOYEE menu
        $(".nav-item:first-child").addClass("menu-open");
        // Open HR & PAYROLL menu
        $(".nav-item:first-child").parent().parent().addClass("menu-open");
    });
    
});