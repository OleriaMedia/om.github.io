fetch("/assets/php/ajax/is-logged-in.php").then( response => {
    response.json().then( json => {
        if (!json.isLoggedIn) {
            // Redirect
        } else {
            Load();
        }
    });
});

function Load() {
    
    fetch("/assets/php/ajax/accounts/history.php").then( response => {
        response.text().then( json => {
    
            console.log(json);

            StopLoadingSpinner();
    
        });
    });
}

function Redirect() {
    const currentAddress = encodeURIComponent(location.href);
    location.href = "/registration/log-in/?continue=" + currentAddress;
}