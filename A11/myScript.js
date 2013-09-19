$(function(){
	$(".answer").hide();
	
	$(".question").click(function(){
		$(this).next(".answer").slideToggle("fast");
	});
});

function daysToDate(month, day){
	var today=new Date();
    var date=new Date(today.getFullYear(), month, day);//Month is 0-11 in JavaScript
    if (today.getMonth()>month && today.getDate()>day){ //if date has passed already
         date.setFullYear(date.getFullYear()+1); 
    }//calculate next year's date
    //Set 1 day in milliseconds
    var one_day=1000*60*60*24;
    
    //Calculate difference between the two dates, and convert to days
    return Math.ceil((date.getTime()-today.getTime())/(one_day));
}

