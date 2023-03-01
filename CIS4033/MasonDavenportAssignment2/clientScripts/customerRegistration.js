function validatePasswordData() {
    if(document.customer_registration.password.value != document.customer_registration.verify_password.value) {
        alert("The passwords that you have entered do not appear to match. Please try again. ");
        
        document.customer_registration.password.value = "";
        document.customer_registration.verify_password.value = "";
        document.customer_registration.password.focus();
        return false;
    }

    alert("Passwords Match. You may now continue.");
    return true;
}//validatePasswordData