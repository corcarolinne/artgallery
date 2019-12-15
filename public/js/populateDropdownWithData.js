// function to find and put data inside the dropdowns(<select> html tag)
// receives an id from the type of select and the array that contains the dropdown data
function populateDropdownWithData(id, dataSource) { 
    // save <select> id
    var dropdown = document.getElementById(id);  
    // using forEach array function in the the array that contains the dropdown data
    dataSource.forEach((item) => {
        // create an option  html element for each item
        let option = document.createElement("OPTION");
        // setting option value to same as item ID
        option.value = item.ID;
        // append text (name) for each option
        option.appendChild(document.createTextNode(item.Name));
        // apend option into the dropdown
        dropdown.appendChild(option);
    });
}