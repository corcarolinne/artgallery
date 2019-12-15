// JS for the customer dashboard page

// function to mount art table
function mountArtTable () {
    // if the URL contains search_input
    if (window.location.search.includes("?search_input=")) {
        // pick the values from input and filter and put into html elements (art-filter-input and art filter-select)
        document.getElementById("art-filter-input").value = new URL(window.location).searchParams.get("search_input");
        document.getElementById("art-filter-select").value = new URL(window.location).searchParams.get("search_select");
    }
    // saving the html element values into these variables
    let artFilterValue = document.getElementById("art-filter-input").value;
    let artPropToFilter = document.getElementById("art-filter-select").value;

    // saving in the variable the result from the function to filter table data
    // the function it's receiving the art table data, the input from the user and the filter selected as parameters
    let filteredArtData = filterTableData(artData, artFilterValue, artPropToFilter);
    
    // calling the function to assemble table passing its ID and the function to insert buttons on table
    // the function to insert buttons receives the data in the table
    // and an id ("art") to identify the buttons to do the correct post method for each button
    mountTableById("customerTable", insertActionButtonsOnTable(filteredArtData, "art"));
}


// waiting HTML to load
window.addEventListener('load', mountArtTable)