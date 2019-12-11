// JS for the admin dashboard page

// dyanamic table
// waiting HTML to load
window.addEventListener('load', function () {
   // calling the function to assemble table
  mountTableById("artTable", insertActionButtonsOnTable(artData, "art"));

   // calling the function to assemble table together
  mountTableById("artistTable", insertActionButtonsOnTable(artistData, "artist"));

  // calling the function to assemble table together
  mountTableById("adminTable", insertActionButtonsOnTable(adminData, "admin"));
  })