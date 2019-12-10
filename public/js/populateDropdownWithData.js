// function to find element that we need to mount our table
function populateDropdownWithData(id, dataSource) {
    var dropdown = document.getElementById(id);

    dataSource.forEach((item) => {
        let option = document.createElement("OPTION");
        option.value = item.ID
        
        option.appendChild(document.createTextNode(item.Name));
        
        dropdown.appendChild(option);
    });

    // <option value = "1">Ben Jamin</option>
    // <option value = "2">Frida Kahlo</option>
    // <option value = "3">Claude Monet</option>
    // <option value = "4">Tarsila do Amaral</option>
}