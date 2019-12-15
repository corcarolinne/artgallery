// JS for favourites table

// waiting html to load
window.addEventListener('load', function () {
    // calling function to assemble table, passsing its id and calling function to insert buttons
    // the function to insert buttons receives data in the table
    // and an id to identify the buttons to do the correct post method for each button
    mountTableById("favTable", insertActionButtonsOnTable(artData, "art"))
})