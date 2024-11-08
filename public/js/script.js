$(document).ready(function() {
    const url = 'https://car-data.p.rapidapi.com/cars/makes';
    const options = {
        method: 'GET',
        headers: {
            'x-rapidapi-key': '5166fd7a53msh145ef723e419885p1f8162jsnc058c4d59627',
            'x-rapidapi-host': 'car-data.p.rapidapi.com'
        }
    };

    async function getCarMakes() {
        try {
            const response = await fetch(url, options);
            if (!response.ok) {
                throw new Error(`HTTP status ${response.status}`);
            }

            const carMakes = await response.json(); // Assuming response is an array of car makes
            populateCarMakesDropdown(carMakes);
        } catch (error) {
            console.error("Error fetching car makes:", error);
        }
    }

    function populateCarMakesDropdown(carMakes) {
        const $selectMakeChoice = $('#btnSelectMake'); // Select the dropdown with jQuery

        $selectMakeChoice.empty(); // Clear any existing options

        // Append each car make as an option in the dropdown
        carMakes.forEach(make => {
            $selectMakeChoice.append(`<option value="${make}">${make}</option>`);
        });
    }

    // Call the function to load car makes
    getCarMakes();
});