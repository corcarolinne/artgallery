// JS for the customer dashboard page

// dyanamic table
function mountArtTable () {

    if (window.location.search.includes("?search_input=")) {
        document.getElementById("art-filter-input").value = new URL(window.location).searchParams.get("search_input");
        document.getElementById("art-filter-select").value = new URL(window.location).searchParams.get("search_select");
    }
    
    let artFilterValue = document.getElementById("art-filter-input").value;
    let artPropToFilter = document.getElementById("art-filter-select").value;

    let filteredArtData = filterTableData(artData, artFilterValue, artPropToFilter);
    // calling the function to assemble table together
    mountTableById("customerTable", insertActionButtonsOnTable(filteredArtData, "art"));
}


// waiting HTML to load
window.addEventListener('load', mountArtTable)