userName = document.getElementById("userName");
 userTel = document.getElementById("userTel");
 mail = document.getElementById("mail");
 password = document.getElementById("password");
 confirmPassword = document.getElementById("confirmPassword");
 inscription = document.getElementById("inscription");
 labelCheck = document.getElementById("labelCheck");
 userName.onkeyup = function(e){
     getResults("userName", dynamicDisabledPseudo(userName,inscription),  userName, inscription);
 };
 userTel.onkeyup = function(e){
    getResults("userTel", dynamicDisabledTel(userTel,inscription),  userTel, inscription);
};
mail.onkeyup = function(e){
    getResults("mail", dynamicDisabledMail(mail,inscription),  mail, inscription);
};
password.onkeyup = function(e){
    forBlur(e.target);
    dynamicDisabledPassword(password,inscription,confirmPassword);
}
confirmPassword.onkeyup = function(e){
    forBlur(e.target);
    dynamicDisabledConfirm(confirmPassword,password,inscription);
}
 inscription.onsubmit = function() {
     userName.value = encodeURIComponent(userName.value);
     userTel.value = encodeURIComponent(userTel.value);
     mail.value = encodeURIComponent(mail.value);
     password.value = encodeURIComponent(password.value);
 };
 
