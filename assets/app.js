import './vendor/bootstrap/dist/css/bootstrap.min.css'
import './vendor/bootstrap-icons/font/bootstrap-icons.min.css'
import './styles/app.css'
import 'htmx.org'
import toastr from 'toastr'
import './vendor/toastr/build/toastr.min.css'

function toggleForm() {
    var formContainer = document.getElementById('contact-form-container')
    if (formContainer.style.display === 'none' || formContainer.style.display === '') {
        formContainer.style.display = 'block'
    } else {
        formContainer.style.display = 'none'
    }
}

const addContactButton = document.getElementById('add-contact-button');
addContactButton.addEventListener('click', toggleForm)

document.body.addEventListener('htmx:beforeSwap', function(evt) {
  // Allow 422 and 400 responses to swap
  // We treat these as form validation errors
  if (evt.detail.xhr.status === 422 || evt.detail.xhr.status === 400) {
    evt.detail.shouldSwap = true
    evt.detail.isError = false
  }
})

window.addEventListener('resize', function() {
    var formContainer = document.getElementById('contact-form-container');
    formContainer.style.display = window.innerWidth >= 768 ? 'block' : 'none';
});

document.addEventListener('htmx:afterRequest', function(event) {
    if (event.detail.xhr.status === 200) {
        toastr.success('Sikeresen elmentve.')
        if (window.innerWidth < 768) {
            var formContainer = document.getElementById('contact-form-container')
            formContainer.style.display = 'none'
        }
    }
})
