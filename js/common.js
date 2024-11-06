window.addEventListener('message', function(event) {
    if (event.data === 'toggleSidebar') {
        const sidebar = document.getElementById('sidebar');
        sidebar.style.display = sidebar.style.display === 'none' ? 'block' : 'none';
    }
});


async function sendPostRequest(url, form) {
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded', // Set header for URL encoded data
            },
            body: new URLSearchParams(new FormData(form)) // Send serialized form data
        });

        const data = await response.json(); // Parse the JSON response

        // Return the message or an error message
        if (data.message) {
            return data.message;
        } else {
            return "An error occurred. Please try again."; // Display error message
        }

    } catch (error) {
        // console.error("Fetch Error:", error); // Log fetch error details
        return "There was an error processing the form.";
    }
}
