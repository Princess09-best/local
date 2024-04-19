const signUpButtonfake = document.getElementById('signUp');
const signInButtonfake = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButtonfake.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButtonfake.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

document.addEventListener('DOMContentLoaded', function() {
    const signUpForm = document.getElementById('signUp');
    const signUp_button = document.getElementById('signUp_button');

    signUp_button.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(signUpForm);

        fetch(signUpForm.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                return response.text();
            }
            throw new Error('Network response was not ok.');
        })
        .then(data => {
            // Handle successful response
            console.log(data);
        })
        .catch(error => {
            // Handle errors
            console.error('Error:', error);
        });
    });

    const loginForm = document.getElementById('sign_in_form');
    const SignIn_button = document.getElementById('_button');

    SignIn_button.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(loginForm);

        fetch(loginForm.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                return response.text();
            }
            throw new Error('Network response was not ok.');
        })
        .then(data => {
            // Handle successful response
            console.log(data);
        })
        .catch(error => {
            // Handle errors
            console.error('Error:', error);
        });
    });
});

