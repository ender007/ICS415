function addClass(el, newClass){
    var regex = "(?:^|\s)" + newClass + "(?!\S)";
    if ( el.className.match(regex)){
        /*do nothing*/
    } else {
        el.className+= " " + newClass;  
    }
}
