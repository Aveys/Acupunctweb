
function initJS_search() {
//TODO: Secure inputs.
    var buttonSearchForm = document.createElement("buttonSearchForm");
    buttonSearchForm.textContent = "Ajouter";
    buttonSearchForm.setAttribute('class', 'btn btn-default');
    buttonSearchForm.setAttribute('type', 'button');
    buttonSearchForm.setAttribute('id', 'buttonSearchForm');
    buttonSearchForm.setAttribute('onclick', 'addFilter()');

    var spanButtonsSearch = document.getElementById("span_buttons_search");
    spanButtonsSearch.insertBefore(buttonSearchForm, spanButtonsSearch.children[0]);

}

function addFilter()
{
    var text = document.getElementById("filterSearchInput").value;
    var newHiddenField = document.createElement("input");
    newHiddenField.setAttribute('name', 'filters[]');
    newHiddenField.setAttribute('id', "fltrField:" + text);
    newHiddenField.setAttribute('type', 'hidden');
    newHiddenField.value = text;

    var newButton = document.createElement("button");
    newButton.setAttribute('type', 'button');
    newButton.setAttribute('class', 'btn btn-default btn-sm');
    newButton.setAttribute('id', "fltr:" + text);
    newButton.setAttribute('onClick', 'deleteFilter(\"'+ text + '\")');
    newButton.setAttribute('value', text);

    var glyphIcn = document.createElement("span");
    glyphIcn.setAttribute('class', 'glyphicon glyphicon-remove');

    newButton.appendChild(glyphIcn);

    var textnode = document.createTextNode(" " + text);
    newButton.appendChild(textnode);


    var searchForm = document.getElementById("filtersSearchForm");
    searchForm.appendChild(newHiddenField);
    searchForm.appendChild(newButton);

    document.getElementById("filterSearchInput").value = "";

}

function deleteFilter(filter)
{
    var searchForm = document.getElementById("filtersSearchForm");
    var filterBtn = document.getElementById("fltr:" + filter);
    var filterFld = document.getElementById("fltrField:" + filter);
    filterFld.parentNode.removeChild(filterFld);
    filterBtn.parentNode.removeChild(filterBtn);
}
var easter_egg = new Konami(function(){alert("Blague cachée : \nAllo, qui est au bout du fil ?\n - L'aiguille.\n")});