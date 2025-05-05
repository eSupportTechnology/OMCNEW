

function closeMenuMobi() {
    //alert(2);
    document.body.classList.remove("mmenu-active");
    document.querySelector(".mobile-menu-wrapper").style.visibility = "hidden";
}

function openMenuMobi() {
    //alert(1);
    document.body.classList.add("mmenu-active");
    document.querySelector(".mobile-menu-wrapper").style.visibility = "visible";
}


function openSubmenus(clickedSpan) {
    let $dropdown = $(clickedSpan).next(".dropdown");
    // Toggle the visibility of the clicked dropdown instantly (no animation)
    $dropdown.toggle();
    $(clickedSpan).toggleClass("rotate"); // Rotate the toggle button for effect
}



// function openSubmenus(clickedSpan) {
//     let $dropdown = $(clickedSpan).next(".dropdown");
//     let isVisible = $dropdown.is(":visible");

//     // Hide all dropdowns and remove rotate class from all spans
//     $(".dropdown").slideUp(300);
//     $(this).css("display", "none");
//     $(".toggle-btn").removeClass("rotate");

//     // Toggle the clicked dropdown
//     if (!isVisible) {
//         $dropdown.slideDown(300); // Smooth slide down
//         $(this).css("display", "none");
//         $(clickedSpan).addClass("rotate"); // Add rotation class
//     }
// }

// function openSubmenus(clickedSpan) {
//     let dropdown = clickedSpan.nextElementSibling;

//     // Check if the clicked dropdown is already visible
//     let isVisible = dropdown.style.display === 'block';

//     // Hide all dropdowns
//     document.querySelectorAll('.dropdown').forEach(ul => ul.style.display = 'none');

//     // Toggle the clicked dropdown
//     dropdown.style.display = isVisible ? 'none' : 'block';
// }


$(document).ready(function () {

    $(".toggle-btn-dest").on("click", function () {
        let $widget = $(this).closest(".widget"); // Get the parent widget
        let $title = $widget.find(".widget-title"); // Get the widget title
        let $body = $widget.find(".widget-body"); // Get the widget body

        // Toggle collapsed class on widget title
        $title.toggleClass("collapsed");

        // Use CSS instead of slideToggle() for instant effect
        $body.toggleClass("hidden");
    });

    $(".toggle-btn-mobi").on("click", function () {
        let $widget = $(this).closest(".widget"); // Get the parent widget
        let $title = $widget.find(".widget-title"); // Get the widget title
        let $body = $widget.find(".widget-body"); // Get the widget body

        // Toggle collapsed class on widget title
        $title.toggleClass("collapsed");

        // Use CSS instead of slideToggle() for instant effect
        $body.toggleClass("hidden");
    });

});