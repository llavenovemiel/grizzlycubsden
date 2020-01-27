(function () {
    
    const sendBtn = document.getElementById('submitContactForm');

    if (sendBtn) {
        sendBtn.addEventListener('click', submitForm);
    }

    const config = {
        // contactUsEndpoint: 'http://local.grizzlycubsden.com/send',
        contactUsEndpoint: 'https://grizzlycubsden.com/send',
        nameRegex: /^[a-zA-Z\s]*$/,
        emailRegex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    }
    
    
    function submitForm() {
        
        sendBtn.innerHTML = "SENDING...";
    
        const notification = document.getElementsByClassName('contact-us-notification')[0];
        const contactUsMail = document.getElementsByClassName('contact-us-mail')[0];
        
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const subjectInput = document.getElementById('subject');
        const messageInput = document.getElementById('message');
    
        const form = [
            nameInput,
            emailInput,
            subjectInput,
            messageInput
        ];
    
        const contactUsFormValue = {
            name: nameInput.value,
            email: emailInput.value,
            subject: subjectInput.value,
            message: messageInput.value,
        };
    
        // validate data
        if (!validateForm(form)) {
            notification.innerHTML = "Please supply valid information.";
            sendBtn.innerHTML = "SEND MESSAGE";
            return;
        };
    
    
        // send if valid
        const endpoint = config.contactUsEndpoint;
        sendForm(JSON.stringify(contactUsFormValue), endpoint)
            .then(response => {
                sendBtn.innerHTML = "SEND MESSAGE";
                form.forEach(input => input.value = '');
                notification.innerText = "Thank you! We have received your message. Expect an answer from us soon."
                contactUsMail.innerHTML = ""
            })
            .catch(error => {
                sendBtn.innerHTML = "SEND MESSAGE";
                notification.innerHTML = "We are unable to send your message for now. Try again after a while or reach us through "
                contactUsMail.innerHTML = "grizzlycubsden@gmail.com."
            });
    }
    
    function sendForm(form, endpoint) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
    
            xhr.onreadystatechange = function() {
                if (xhr.readyState !== 4) return;
    
                // Process the response
                if (xhr.status >= 200 && xhr.status < 300) {
                    // If successful
                    resolve(xhr);
                } else {
                    // If failed
                    reject({
                        status: xhr.status,
                        statusText: xhr.statusText
                    });
                }
            }        
    
            xhr.open("POST", endpoint);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(form));
        })
    }

    function validateForm(form) {
        let validForm = true;
        form.forEach(input => {
            // add script validator
            if (!input.value ||
                (input.name == 'email' && !config.emailRegex.test(input.value)) ||
                (input.name == 'name' && !config.nameRegex.test(input.value)) 
                ) {
                validForm = false;
                input.classList.add('invalid');
            } else {
                if (input.classList.contains('invalid')) {
                    input.classList.remove('invalid');
                }
            }
        });
        return validForm;
    }
    
})();