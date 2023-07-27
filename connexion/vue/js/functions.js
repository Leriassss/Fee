function dynamicDisabledPseudo(input_text, input_button)
{		
	 keyUp(input_text,input_button);
	 if(/[^\w\d.@]/.test(input_text.value)|| input_text.value ==""){ getChange(false, input_text, input_button);}
	 else{getChange(true, input_text, input_button);}	 
}

function dynamicDisabledTel(input_text, input_button)
{		
	 if(!/^(9[0-9]|6[1245679]|5[1-4])[0-9]{6}$/.test(input_text.value) || input_text.value.length != 8 || input_text.value =="")
		 {getChange(false, input_text, input_button);}		 
	 else{getChange(true, input_text, input_button);}
	 keyUp(input_text,input_button); 
}

function dynamicDisabledMail(input_text, input_button)
{		
	 keyUp(input_text,input_button);
	 if(/^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(input_text.value)){getChange(true, input_text, input_button);}
     else{getChange(false, input_text, input_button);			 }	 
}
function dynamicDisabledPassword(input_text,input_button,input_confirm)
{			 
	 keyUp(input_text,input_button);
	 textVal = input_text.value;
	 if(textVal.length <= 15 && textVal.length >= 8){
		 if(/[A-Z]/.test(textVal) && /[a-z]/.test(textVal) && /\d/.test(textVal) && /[-!*@%._\w]/.test(textVal))
		 {   
			 getChange(true, input_text, input_button);	
			 input_confirm.removeAttribute("disabled");
		 }
		  else
		 {
			 getChange(false, input_text, input_button);	
			 input_confirm.disabled = "true";			 
	     }			 
	 }
	 else
	 {
		 getChange(false, input_text, input_button);
		 input_confirm.disabled = "true";	
	 }	 
}
function dynamicDisabledConfirm(input_text, input_confirm, input_button)
{		
	 forBlur(input_text);		  
	 keyUp(input_text,input_button);
	 textVal = input_text.value;
	 if(textVal == input_confirm.value && textVal != "") {getChange(true, input_text, input_button);}
     else{ getChange(false, input_text, input_button);}
 
}
function keyUp(input_text, input_button)
{
	 if(input_text.value.length != 0){checkPass(input_button);		 }
     else{ input_button.disabled = "true";}
}	 

 function forBlur(input_text)
{
	 input_text.onblur = function(e)
	 {
		 if(e.target.value == "") {e.target.style.borderColor = "red";}
		 else if(e.target.dataset.state =="noty"){e.target.style.borderColor = "red";}
		 else{e.target.style.borderColor = "#ced4da";}
	 }; 
}	

function checkPass(input_button)
{
	 queryFields = 5;
	 queryState = document.querySelectorAll("input[data-state=complete]");
     if(queryFields == queryState.length)
	 {
		 input_button.removeAttribute("disabled");
	 }
	 else
	 {
		input_button.disabled="true";
	 }
}


function getResults(par, func, input_text, input_button)
{ 
	 forBlur(input_text);
     parValue = encodeURIComponent(document.getElementById(par).value);
     var xhr = new XMLHttpRequest();
     xhr.open('POST', './AJAXRequest.php');
	 xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	 xhr.send(par+"="+parValue);
     xhr.onreadystatechange = function()
     {
         if(xhr.readyState == 4 && xhr.status == 200) 
	     {
			 func;
			 if(xhr.responseText == "true"){getChange(false, input_text, input_button);}	
         }
     };
	 return xhr;
}

function getChange(valid, field, input_button){
	if(valid){
		field.style.borderColor = "#6158cb";		 
		field.dataset.state = "complete";
		checkPass(input_button);	
	}
	else{
		field.style.borderColor = "red";
		input_button.disabled = "true";	
		field.dataset.state = "noty";		
	}

}