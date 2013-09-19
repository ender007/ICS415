function highlight(element){
    element.style.border="red dotted 1px";
}

function insertAtTop(message) {
    alert("got here");
    document.insertBefore(document.firstChild, "<p>"+message+"</p>");
}

function validateForm(){
var message = "Please fill out ";
var x=document.forms["myForm"]["name"].value;
if (x==null || x==""){
  insertAtTop("Please fill out the User Name field.");
  alert("First name must be filled out");
  highlight(document.forms["myForm"]["name"]);
  return false;
}

}
