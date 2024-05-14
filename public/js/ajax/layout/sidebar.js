$(document).ready(function(){
    // Add click event listener to the "Add Personal Details" link
    $(".nav-link[href='{{ route('show.personalinfo') }}']").click(function(event){
        // Open HR & PAYROLL menu
        $(".nav-item:first-child").addClass("menu-open-expanded");
        // Open EMPLOYEE menu
        $(".nav-item:first-child").parent().parent().addClass("menu-open-expanded");
        // Prevent the event from propagating up
        event.stopPropagation();
    });
});
