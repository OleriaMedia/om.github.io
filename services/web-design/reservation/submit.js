const inputs = {
    websiteType: document.querySelector("select[name=website-type]"),
    budget: document.querySelector("input[name=budget]"),
    description: document.querySelector("input[name=description]"),
    whatsAppNumber: document.querySelector("input[name=whatsapp-number]"),
};

// If the user isn't logged in, redirect to the login page
fetch("../../../assets/php/ajax/is-logged-in.php").then( response => {
    response.json().then( json => {

        if (!json.isLoggedIn) {
            RedirectToLoginPage();
        }

    })
})

function Submit(event) {
    
    // Prevent The Page Refresh
    event.preventDefault();

    const data = {
        websiteType: inputs.websiteType.value,
        budget: inputs.budget.value,
        description: inputs.description.value,
        whatsAppNumber: inputs.whatsAppNumber.value,
    };

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            
            console.log(this.responseText);
            const json = JSON.parse(this.responseText);
            console.log(json);

            if (!json.success) {
                // We Got Erros!
                DisplayErrorMessages(json.errors);
            } else {
                // Success!
                DisplaySubmitSuccess();
            }

        }
    }

    xhr.open("POST", "../../../assets/php/ajax/services/web-design.php");
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.send(JSON.stringify(data));

}

function DisplayErrorMessages(errors) {
    
    console.log(errors);

}

function DisplaySubmitSuccess() {
    
    const options = {
        title: 'اطلاعات تکمیل شد!',
        text: 'منتظر پیام همکاران ما باش!',
        icon: 'success',
        confirmButtonText: 'بستن'
    };
    Swal.fire(options);

}

function RedirectToLoginPage() {
    const currentAddress = encodeURIComponent(location.href);
    location.href = "/registration/log-in/?continue=" + currentAddress;
}