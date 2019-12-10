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
// function to find element that we need to mount our table
function mountTableById(id, dataSource) {
  var table = document.getElementById(id);
  let data = Object.keys(dataSource[0]);

  //calling the functions
  generateTableHead(table, data);
  generateTable(table, dataSource);
}

// function to create buttons, receives the type of button we should create, returns a div with buttons
function createActionsButtons(buttonsToCreate, id) {

  let actionsDiv = document.createElement("DIV");
  actionsDiv.className = "action-buttons"
  
  // depending on the type described in Actions, include the right type of button
  if (buttonsToCreate.includes('delete')) {
    let deleteIcon = document.createElement("I");
    deleteIcon.className = "fa fa-trash"
    let deleteButton = document.createElement("BUTTON");
    deleteButton.className = "btn"
    deleteButton.appendChild(deleteIcon);
    // putting button inside the div
    actionsDiv.appendChild(deleteButton);
  }

  if (buttonsToCreate.includes('edit')) {
    let editIcon =  document.createElement("I");
    editIcon.className = "fa fa-pencil"
    
    let editButton = document.createElement("BUTTON");
    editButton.className = "btn"
    editButton.appendChild(editIcon);
    // putting button inside the div
    actionsDiv.appendChild(editButton);
  }

  if (buttonsToCreate.includes('favourite')) {
    let favouriteIcon =  document.createElement("I");
    let isArtFavourited = !!favData.find(fav => fav.ArtID === id)
    favouriteIcon.className = `fa fa-heart ${isArtFavourited ? 'favourited' : ''}`

    let favouriteForm = document.createElement("FORM");
    favouriteForm.method = "POST"
    
    let favouriteButton = document.createElement("BUTTON");
    favouriteButton.className = "btn"
    favouriteButton.type = "submit"
    favouriteButton.name = "favourite-art"
    
    favouriteButton.onclick = () => {
      document.cookie = `artToBeFavourited=${id}`;
    }
    
    favouriteButton.appendChild(favouriteIcon);
    favouriteForm.appendChild(favouriteButton);
    // putting button inside the div
    actionsDiv.appendChild(favouriteForm);
  }
  // return the div with the buttons
  return actionsDiv;
} 

// function receives table row and call function to create buttons inside the actions column, returns table row with buttons
function insertActionsButtonsOnRow(tableRow) {
  tableRow.Actions = createActionsButtons(tableRow.Actions, tableRow.ID);
  return tableRow;
}

// function receives array of objects with data, call a function to insert buttons for each row
// and returns the tableData with everything together
function insertActionButtonsOnTable(tableData) {
  for (let row of tableData) {
    row = insertActionsButtonsOnRow(row);
  }
  return tableData;
}