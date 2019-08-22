//global constants
var pcnIndex = 2; //which column is the pcn column
var serialIndex = 3;
var currentForm = "checkout";
var checkoutIndex = 0;
var returnIndex = 1;
var updateIndex = 0;
var deleteIndex = 1;
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
    matches = event.target.matches ? event.target.matches('.dropbtn') : event.target.msMatchesSelector('.dropbtn');
    if (!matches) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

function clearForms(){
  var pcnList = document.getElementsByClassName("pcnInput");
  var serialList = document.getElementsByClassName("serialInput");
  var i;
  for (i = 0; i < pcnList.length;i++){
    let el1 = pcnList[i];
    el1.value = '';
    let el2 = serialList[i];
    el2.value = '';
  }
  document.getElementById('filterInputStr').value = '';
}
function showInsert(){
	document.getElementById("newItemForm").style.display="block";
	document.getElementById("deleteForm").style.display="none";
	document.getElementById("updateForm").style.display="none";
	document.getElementById("backupForm").style.display="none";
	document.getElementById("restoreForm").style.display="none";
  currentForm = "insert";
  clearForms(); // delete form content on form switch
  showAll(); //show entire table contents on form switch (remove table filters)
}
function showDelete(){
	document.getElementById("newItemForm").style.display="none";
	document.getElementById("deleteForm").style.display="block";
	document.getElementById("updateForm").style.display="none";
	document.getElementById("backupForm").style.display="none";
	document.getElementById("restoreForm").style.display="none";
  currentForm = "delete";
  clearForms(); // delete form content on form switch
  showAll(); //show entire table contents on form switch (remove table filters)
}
function showUpdate(){
	document.getElementById("newItemForm").style.display="none";
	document.getElementById("deleteForm").style.display="none";
	document.getElementById("updateForm").style.display="block";
	document.getElementById("backupForm").style.display="none";
	document.getElementById("restoreForm").style.display="none";
  currentForm = "update";
  clearForms(); // delete form content on form switch
  showAll(); //show entire table contents on form switch (remove table filters)
}
function showBackup(){
	document.getElementById("newItemForm").style.display="none";
	document.getElementById("deleteForm").style.display="none";
	document.getElementById("updateForm").style.display="none";
	document.getElementById("backupForm").style.display="block";
	document.getElementById("restoreForm").style.display="none";
  currentForm = "backup";
  clearForms(); // delete form content on form switch
  showAll(); //show entire table contents on form switch (remove table filters)
}
function showRestore(){
	document.getElementById("newItemForm").style.display="none";
	document.getElementById("deleteForm").style.display="none";
	document.getElementById("updateForm").style.display="none";
	document.getElementById("backupForm").style.display="none";
	document.getElementById("restoreForm").style.display="block";
  currentForm = "restore";
  clearForms(); // delete form content on form switch
  showAll(); //show entire table contents on form switch (remove table filters)

}
function showCheckout(){
	document.getElementById("checkoutForm").style.display="block";
	document.getElementById("returnForm").style.display="none";
  currentForm = "checkout";
  clearForms(); // delete form content on form switch
  showAll(); //show entire table contents on form switch (remove table filters)
}
function showReturn(){
	document.getElementById("checkoutForm").style.display="none";
	document.getElementById("returnForm").style.display="block";
  currentForm = "return";
  clearForms(); // delete form content on form switch
  showAll(); //show entire table contents on form switch (remove table filters)
}

function mergeSort(n){
	
}
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc"; 
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++; 
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
function tempAlert(msg,duration)
{
 var el = document.createElement("div");
 el.setAttribute("style","position:fixed;top:40%;left:35%;background-color:white; color: red; height 4%");
 el.innerHTML = msg;
 setTimeout(function(){
  el.parentNode.removeChild(el);
 },duration);
 document.body.appendChild(el);
}

function pasteOnClick(pcnOrSerial,formNum){
	var result = '';
	if(pcnOrSerial == 0){
    let sandbox;
		let listPcnInput = document.getElementsByClassName('pcnInput');
		sandbox = listPcnInput[formNum];
    console.log(sandbox);
    console.log(formNum);
		sandbox.value = '';
		sandbox.select();
		document.execCommand('paste');
		//sandbox = document.getElementById('pcnCheck');
	}
	else{
		let listSerialInput = document.getElementsByClassName('serialInput');
    let sandbox1;
		sandbox1 = listSerialInput[formNum];
		sandbox1.value = '';
		sandbox1.select();
		document.execCommand('paste');
		//sandbox = document.getElementById('serialCheck');
	}
	//sandbox.value = '';
	//sandbox.select();
	//document.execCommand('paste');
}

function clearSelection(){
  if (document.body.createTextRange) { // All IE but Edge
    var range = document.body.createTextRange();
    range.collapse();
    range.select();
  }
  else {
    document.getSelection().removeAllRanges();
  }
}

function getCurrentForm(){
  var formIndex = -1;
  if(currentForm =="checkout"){
    formIndex = checkoutIndex;//index to designate which array element corrensponds to the checkout form in the (getElemetnsbyclassname call in paste function)
  }
  else if(currentForm =="return"){
    formIndex = returnIndex;//index to designate which array element corrensponds to the return form
  } 
  else if(currentForm =="update"){
    formIndex = updateIndex;//index to designate which array element corrensponds to the update form
  }
  else if(currentForm =="delete"){
    formIndex = deleteIndex;//index to designate which array element corrensponds to the delete form
  }
  return formIndex;
}
function copyOnClick(n){
  clearForms();//delete contents of forms before pasting in the new stuff
  //figure out which form checkout, return, update... is visible
  var i;
  var formIndex = getCurrentForm();//returns -1 on error and an index corresponding to which form is currently showing on the webpage.
  var range = document.createRange();
  var copyBoxID ="";

  copyBoxID = "pcnID"+n;
  var copyContents = document.getElementById(copyBoxID).textContent;
  if(copyContents!=''){
    range.selectNode(document.getElementById(copyBoxID));
  //window.getSelection().removeAllRanges(); // clear current selection
    clearSelection();
    window.getSelection().addRange(range); // to select text
    let pcnStatus = document.execCommand("copy");
    if(!pcnStatus){
    console.log("copy  pcn Failed");
    }
    else
      console.log("copy pcn success")
    window.getSelection().removeAllRanges();// to deselect	
    tempAlert("copied "+document.getElementById(copyBoxID).textContent, 800);
    pasteOnClick(0,formIndex); //designate pcn and designate which form 
  }

	copyBoxID = "serialNum"+n;
  copyContents = document.getElementById(copyBoxID).textContent;
  if(copyContents !=''){
	 range.selectNode(document.getElementById(copyBoxID));
    //window.getSelection().removeAllRanges(); // clear current selection
    clearSelection();
    window.getSelection().addRange(range); // to select text
    let serialStatus=document.execCommand("copy");
    if(!serialStatus){
      console.log("copy  serial Failed");
    }
    else
      console.log("copy serial success")
    window.getSelection().removeAllRanges();
    pasteOnClick(1,formIndex);
  }
}


function showAll(){
	var tab = document.getElementById("myTable");
	for(i = 0; i <tab.rows.length; i++){
		tab.rows[i].style.display="table-row";
	}
}

function alertResult(msg){
  window.alert(msg);
}

function filterOnInput(filterStr){
	showAll();
	var str = document.getElementById(filterStr).value;
	var tab = document.getElementById("myTable");
	var rowOK = false;
//if filtering from the pcn entry field, want to match only the pcn column in the table
  if(filterStr.indexOf("pcn")!= -1){
    for(i = 1; i <tab.rows.length; i++){
        if(tab.rows[i].cells[pcnIndex].textContent.replace(/\s+/g, "").toLowerCase().indexOf(str.replace(/\s+/g, "").toLowerCase())!=-1)
          rowOK = true;
        if(rowOK==false)
          tab.rows[i].style.display="none";
        rowOK=false;
    }
  }
  else if(filterStr.indexOf("serial")!=-1){
    for(i = 1; i <tab.rows.length; i++){
        if(tab.rows[i].cells[serialIndex].textContent.replace(/\s+/g, "").toLowerCase().indexOf(str.replace(/\s+/g, "").toLowerCase())!= -1)
          rowOK = true;
        if(rowOK==false)
          tab.rows[i].style.display="none";
        rowOK=false;
    }
  }
  else{
	 for(i = 1; i <tab.rows.length; i++){
	 	for(j = 0; j<tab.rows[i].cells.length;j++){	
	 		if(tab.rows[i].cells[j].textContent.replace(/\s+/g, "").toLowerCase().indexOf(str.replace(/\s+/g, "").toLowerCase())!=-1)
				rowOK = true;
		}
		if(rowOK==false)
			tab.rows[i].style.display="none";
		rowOK=false;
	 }
  }
}

var menuState = 0;
function toggleNav(){
	if(menuState ==0){
		menuState = 1;
		openNav();
	}
	else{
		menuState = 0;
		closeNav();
	}
}
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("floating-button").style.marginRight = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("floating-button").style.marginRight = "0";
}