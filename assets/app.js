import './vendor/bootstrap/dist/css/bootstrap.min.css'
import './vendor/bootstrap-icons/font/bootstrap-icons.min.css'
import './styles/app.css';
import 'htmx.org';

function toggleForm() {
    var formContainer = document.getElementById('contact-form-container');
    if (formContainer.style.display === 'none' || formContainer.style.display === '') {
        formContainer.style.display = 'block';
    } else {
        formContainer.style.display = 'none';
    }
}

const addContactButton = document.getElementById('add-contact-button');
addContactButton.addEventListener('click', toggleForm)
