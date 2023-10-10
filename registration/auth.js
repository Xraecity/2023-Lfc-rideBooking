 document.addEventListener("DOMContentLoaded", function() {
            let form = document.querySelector("form");
            form.addEventListener("submit", function(event) {
                    event.preventDefault();
                    let lastName = document.getElementById("lastName");
                    let firstName = document.getElementById("firstName");
                    let email = document.getElementById("email").value;
                    let phone = document.getElementById("phone");
                    let password = document.getElementById("password");
                    let confirmPass = document.getElementById("confirmPass");
                    let firstTime = document.getElementById("fTime");
                    let address = document.getElementById("location-input");
                    let city = document.getElementById("locality-input");
                    let maleRadio = document.getElementById("male");
                    let femaleRadio = document.getElementById("female");

                    let invalidLastName = document.getElementById("invalidLastName");
                    let invalidFirstName = document.getElementById("invalidFirstName");
                    let invalidPhone = document.getElementById("invalidPhone");
                    let invalidAddress = document.getElementById("invalidAddress");
                    let invalidCity = document.getElementById("invalidCity");
                    let invalidEmail = document.getElementById("invalidEmail");
                    let invalidPassword = document.getElementById("invalidPassword");
                    let genderError = document.getElementById("invalidGender");

                
                // Check if neither "Male" nor "Female" is selected
                    if (!maleRadio.checked && !femaleRadio.checked) {
                        genderError.style.display = "block";
                    } else {
                        genderError.style.display = "none";
                    }
                // Check if any of the required fields are empty
                if(lastName.value ==""){
                    invalidLastName.setAttribute("style", "display: block;");
                    lastName.focus();
                }
                else{
                    invalidLastName.setAttribute("style", "display: none;");
                }
                if(firstName.value ==""){
                    firstName.focus();
                    invalidFirstName.setAttribute("style", "display: block;");
                }
                else{
                    invalidFirstName.setAttribute("style", "display: none;");
                }
                if(phone.value ==""){
                    phone.focus();
                    invalidPhone.setAttribute("style", "display: block;");
                }
                else{
                    invalidPhone.setAttribute("style", "display: none;");
                }
                if(address.value ==""){
                    address.focus();
                    invalidAddress.setAttribute("style", "display: block;");
                }
                else{
                    invalidAddress.setAttribute("style", "display: none;");
                }
                if(city.value ==""){
                    city.focus();
                    invalidCity.setAttribute("style", "display: block;");
                }
                else{
                    invalidCity.setAttribute("style", "display: none;");
                }
                
                if(password.value ==""){
                    password.focus();
                    invalidPassword.setAttribute("style", "display: block;");
                }
                else{
                    invalidPassword.setAttribute("style", "display: none;");
                }
            

                //email validation
                if(email.value == ""){
                    invalidEmail.setAttribute('style', 'display: block;');
                    }else{
                        invalidEmail.style.display = "none";
                    }

                    function isValidEmail(email) {
                        // Regular expression for a valid email address
                        let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                        
                        // Test the email against the pattern
                        return emailPattern.test(email);
                        }

                    email.value;
                        if (isValidEmail(email)) {
                            invalidEmail.setAttribute('style', 'display: none;');
                        } 
                        else {
                            invalidEmail.setAttribute('style', 'display: block;');
                        }


                        if(firstName != "" &&
                        lastName != "" &&
                        isValidEmail(email) &&
                        phone != "" &&
                        password != "" &&
                        address != "" &&
                        city != "" &&
                        maleRadio.checked || femaleRadio.checked){
                            alert("submited")
                        form.submit();
                        }

                        // fetch('register.php', {
                        //     method: 'POST',
                        //     body: new FormData(document.getElementById('form-validate'))
                        // })
                        // .then(response => {
                        //     if (response.ok) {
                        //         // Handle success (e.g., display a success message)
                        //         console.log('Registration successful!');
                        //     } else {
                        //         // Handle error (e.g., display an error message)
                        //         console.error('Registration failed.');
                        //     }
                        // })
                        // .catch(error => {
                        //     console.error('Error:', error);
                        // });
         
             });

        });

        // VALIDATE FIRSTTIME 
        function toggleReferralInput() {
            var firstTimeSelect = document.getElementById("firstTimer");
            var referralInput = document.getElementById("referralInput");

            if (firstTimeSelect.value === "Yes, am new to church") {
                referralInput.style.display = "block";
            } else {
                referralInput.style.display = "none";
            }
        }


    document.addEventListener("DOMContentLoaded", function () {
    let phone = document.getElementById("phone");

    phone.addEventListener("input", function () {
        let inputValue = phone.value.replace(/\D/g, ''); // Remove non-numeric characters
        if (inputValue.length > 10) {
            inputValue = inputValue.slice(0, 10); // Limit to 10 digits
        }

        if (inputValue.length >= 1) {
            inputValue = "(" + inputValue;
        }

        if (inputValue.length >= 4) {
            inputValue = inputValue.slice(0, 4) + ") " + inputValue.slice(4);
        }

        if (inputValue.length >= 9) {
            inputValue = inputValue.slice(0, 9) + "-" + inputValue.slice(9);
        }

        phone.value = inputValue;
    });
    
});

    function getValues(){
    
        let psw = document.getElementById('password').value;
        let ComfirmPsw = document.getElementById('confirmPass').value;

        let invalidPassword = document.getElementById("invalidPassword");
        let invalidConfirmPass = document.getElementById("invalidConfirmPass");

        if(psw == "") 
        invalidPassword.setAttribute('style', 'display: block');
        else
        invalidPassword.setAttribute('style', 'display: none');

        if(psw != ComfirmPsw){
            invalidConfirmPass.setAttribute('style', 'display: block');
        }
        else{
            invalidConfirmPass.setAttribute('style', 'display: none');
        }
    }