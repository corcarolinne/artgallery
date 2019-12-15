// JS for creating dynamic tables 

// table and data is being passed as parameters and the function creates a table head for it
function generateTableHead(table, data) {
  // using HTML DOM methods to create elements
  let thead = table.createTHead();
  let row = thead.insertRow();
  // for each element of our data array do this
  for (let key of data) {
    // create th html element th or headers
    let th = document.createElement("th");
    // add a text node for each collum header using key as text
    let text = document.createTextNode(key);
    // add to the headers the text that we created
    th.appendChild(text);
    // add the headers to the row
    row.appendChild(th);
  }
}

// function to generate table rows and cells
function generateTable(table, data) {
  // for each element of our data array do this
  for (let element of data) {
    // insert a row in our table
    let row = table.insertRow();
    // for each item of our element do this
    for (key in element) {
      // using HTML DOM method, insert cell
      let cell = row.insertCell();
      // create a variable to hold cell contents
      let cellContent;

      // if element to be put in a cell is a HTML DOM element, just use it, otherwise, create a text DOM element
      if (element[key].nodeName) {
        cellContent = element[key]
      } else {
        cellContent = document.createTextNode(element[key]) 
      }
      // add text to the cellContent
      cell.appendChild(cellContent);
    }
  }
}
// function to find table element that we need to mount the appropriate tables
// the function receives the id of the <table> and an array that will contain the table data
function mountTableById(id, dataSource) {
  // save table ID
  var table = document.getElementById(id); 
  // if data inside the table doesn't exist "show the No results" message
  if (dataSource === undefined || dataSource === null || dataSource.length === 0) {
    table.appendChild(document.createTextNode("No results."));
    return
  }  
  // set data variable to save the attributes of the data object
  let data = Object.keys(dataSource[0]);

  // calling the functions to generate table passing its ID
  // passing the object attributes to the function that will mount the table head
  generateTableHead(table, data);
  // passing the data to the function that will mount the table
  generateTable(table, dataSource);
}

// function to create buttons, receives the type of button we should create, id from the row
// and an identifyer for the button that will depend on the type of table we have
// it returns a div with buttons
function createActionsButtons(buttonsToCreate, id, actionPrefix) {

  // creates a div
  let actionsDiv = document.createElement("DIV");
  actionsDiv.className = "action-buttons"
  
  // depending on the type described in Actions, include the right type of button
  if (buttonsToCreate.includes('delete')) {
    let deleteIcon = document.createElement("I");
    deleteIcon.className = "fa fa-trash"

    // using a form to wrap our button to be able to use method POST
    let deleteForm = document.createElement("FORM");
    deleteForm.method = "POST"

    // creating button
    let deleteButton = document.createElement("BUTTON");
    deleteButton.className = "btn"
    deleteButton.type = "submit"
    // the button name it's gonna depend on the type of the identifyer we received by the function
    deleteButton.name = "delete-" + actionPrefix
    // setting onClick function
    deleteButton.onclick = () => {
      // using cookies to save the id of the data to be deleted and naming it using the id of the data clicked
      document.cookie = actionPrefix + "ToBeDeleted=" + id;
    }

    // append icon to the button, button to the form and form to the div
    deleteButton.appendChild(deleteIcon);
    deleteForm.appendChild(deleteButton);
    actionsDiv.appendChild(deleteForm);
  }

  // doing the same as delete button but for edit
  if (buttonsToCreate.includes('edit')) {
    let editIcon =  document.createElement("I");
    editIcon.className = "fa fa-pencil"
    let editButton = document.createElement("BUTTON");
    editButton.className = "btn"

    // setting on click function
    editButton.onclick = () => {
      // redirects to form page indicated in <a> tag inside admin dashboard
      // putting id of the data to be edited in the URL so PHP can pick it and edit the right data
      window.location.replace(
        document.getElementById("go-to-edit-" + actionPrefix).href
         + "?" + actionPrefix + "ToBeEdited=" + id); 
    }
    editButton.appendChild(editIcon);
    actionsDiv.appendChild(editButton);
  }

  // depending on the type described in Actions, include the right type of button
  if (buttonsToCreate.includes('favourite')) {
    let favouriteIcon =  document.createElement("I");

    // find() searches into the favData array, it receives a function as parameter
    // this function checks if the element inside favData is equal to the id of artData
    // find() returns favID when this ArtID is inside the ArtTable
    // the double negation transforms the number into boolean to make sure we pick a boolean corresponding to that number
    // isArtFavorited stores true or false depending if it satisfies the condition in return
    let isArtFavorited = !!favData.find(function (favId) {
      return favId === id
    })

    let isfavouriteActive = ''
    // if isArtFavorited is true (which means we have an art favorited in the artData table) do this
    if (isArtFavorited) {
      // set the isfavouriteActive to the CSS "favorited" class 
      isfavouriteActive = 'favorited'
    } 
    // use the icon class "fa fa-heart " and the isfavouriteActive variable to set the CSS for the icon
    favouriteIcon.className = "fa fa-heart " + isfavouriteActive;
    // using a form to wrap our button to be able to use method POST
    let favouriteForm = document.createElement("FORM");
    favouriteForm.method = "POST"
    
    let favouriteButton = document.createElement("BUTTON");
    favouriteButton.className = "btn"
    favouriteButton.type = "submit"
    favouriteButton.name = "favourite-art"
    
    // in onClick we use cookies to know the ID of the artpiece clicked
    favouriteButton.onclick = () => {
      // this is a way to save cookies in JS
      document.cookie = "artToBeFavorited=" + id;
    }
    
    favouriteButton.appendChild(favouriteIcon);
    favouriteForm.appendChild(favouriteButton);
    actionsDiv.appendChild(favouriteForm);
  }
  // return the div with the buttons
  return actionsDiv;
} 

// function receives table row and call function to create buttons inside the actions column, returns table row with buttons
function insertActionsButtonsOnRow(tableRow, actionPrefix) {
  tableRow.Actions = createActionsButtons(tableRow.Actions, tableRow.ID, actionPrefix);
  return tableRow;
}

// function receives array of objects with data and an identifyer for the type of data
// returns the tableData with everything together
function insertActionButtonsOnTable(tableData, actionPrefix) {
  // calling a function to insert buttons for each row and identifyer
  for (let row of tableData) {
    row = insertActionsButtonsOnRow(row, actionPrefix);
  }
  return tableData;
}

// function to filter table data and do the search
// receives an identifyer for the data on the table, the user input and the filer selected 
function filterTableData (tableData, filterValue, propToFilter) {
  // returns an array function (filter)
  return tableData.filter(function (item) {
      // comparing user input with the array item and letting both in upper case to be case insensitive
      return item[propToFilter].toUpperCase().includes(filterValue.toUpperCase())
  })
}