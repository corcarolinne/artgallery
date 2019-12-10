// dynamic favourites table
// waiting html to load
window.addEventListener('load', function () {
    // calling function to assemble table
    mountTableById("favTable", insertActionButtonsOnTable(artData))
})