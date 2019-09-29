/*
* Validate SignUp form
*/

/*
* Declare UI elements
*/

// EasyHTTP Class Object
const http = new EasyHTTP;

//signup form
const form = document.getElementById('parent-register');

const studentNo = document.getElementById("student-no");

const usernameMsg = document.getElementById("username-msg");

const password = document.getElementById("password");

const confirmPassword = document.getElementById("password-confirm");

let emailValid, currentDiv, passwordValid;

//Validate Email
const validateEmail  = () => {
    let data = email.value;
    if (data !== ''){
        http.get(`/api/validate-email?email=${data}`)
            .then(data => EmailExists(data))
            .catch(err => console.log(err));
    }
};

//if email exist
const EmailExists = (data) => {
    currentDiv = emailMsg;
    if (data === true) {
       emailValid = false;
        displayUIMessage();
    }
    else {
        emailValid = true;
        clearUIMessage();
    }
};

studentNo.addEventListener('click', () => console.log('yes'));

const validateForm = (e) => {
    if (emailValid === false || (password !== confirmPassword)){
        e.preventDefault();
    }
    else{
        form.submit();
    }
};

form.addEventListener('submit', validateForm);


//Prints Input Validity Status
const displayUIMessage = (status, msg) => {
    currentDiv.innerHTML = `<br><p class="text-center " style="color:red" id="msg">
<i class="fa fa-close" style="font-size:20px;color:red"></i></p>
            `;
};

const clearUIMessage = () => {
    currentDiv.innerHTML = '';
};

studentNo.addEventListener('blur', () => {
        console.log("aaaaaaaaaaaaa");
    }
);

confirmPassword.addEventListener('click', () => {
    currentDiv = passwordMsg;

   if (password !== confirmPassword) {
       displayUIMessage()
   }
});
