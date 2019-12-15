// JS for the admin dashboard page

// to create table, wait HTML to load
window.addEventListener('load', function () {
   // calling the function to assemble art table receiving as parameters its id and the function to insert buttons
   // the function to insert buttons receive the data from the table
   // and an id to identify the buttons to do the correct post method for each button
   mountTableById("artTable", insertActionButtonsOnTable(artData, "art"));
   // calling the function to assemble artist table
   mountTableById("artistTable", insertActionButtonsOnTable(artistData, "artist"));
  // calling the function to assemble administrator accounts table
   mountTableById("adminTable", insertActionButtonsOnTable(adminData, "admin"));
})