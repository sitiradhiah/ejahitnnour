import './bootstrap';

// Global function to fetch the total count and update UI
function updateTotalCount(apiUrl, elementId) {
    axios.get(apiUrl)
        .then(response => {
            const total = response.data.total;

            // Update the UI element
            document.getElementById(elementId).innerText = total;
        })
        .catch(error => {
            console.error("Error fetching total count:", error);
        });
}

// Example: Call this function globally
// updateTotalCount('/api/count/my_table', 'totalItems');
