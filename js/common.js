// for side bar controll
let barDisplay = localStorage.getItem('barDisplay') || 'none';

window.addEventListener('message', function(event) {
    if (event.data === 'toggleSidebar') {
        const sidebar = document.getElementById('sidebar');
        barDisplay = sidebar.style.display === 'none' ? 'block' : 'none';
        sidebar.style.display = barDisplay;

        // Save the updated state in localStorage
        localStorage.setItem('barDisplay', barDisplay);
    }
});

window.addEventListener('load', function() {
    const sidebar = document.getElementById('sidebar');
    barDisplay = sidebar.style.display === 'none' ? 'none' : 'block';
    sidebar.style.display = barDisplay;
});

/**
 * Returns the response data or if a redirect url is given in response then it redirects to that url
 * @param url String that specifies the url endpoint.
 * @param form The form to get the values from.
 * @param action [Optional] to set the actiontype of the api call.
*/
async function sendPostRequest(url, form, action=null) {
    try {
        formData = new FormData(form);
        if(action) {
            formData.append(action, action);
        }
        
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded', // Set header for URL encoded data
            },
            body: new URLSearchParams(formData) // Send serialized form data
        }).then(data => {
            console.log(data); // Output the response to the browser console
        });

        const data = await response.json(); // Parse the JSON response

        // Return the message or an error message
        if (data) {
            if(data.redirectUrl) {
                window.location.href=data.redirectUrl;
            }
            else {
                return data;
            }
        } else {
            return "An error occurred. Please try again."; // Display error message
        }

    } catch (error) {
        // console.error("Fetch Error:", error); // Log fetch error details
        return "There was an error processing the form.";
    }
}
