// JS for the customer dashboard page

// dyanamic table
// waiting HTML to load
window.addEventListener('load', function () {
     // calling the function to assemble table together
    mountTableById("customerTable", insertActionButtonsOnTable(artData, "art"));
})