document.addEventListener('DOMContentLoaded', () => {
    const selectModelBtn = document.querySelector('#btnSelectMake');

    if (selectModelBtn) {
        getCarMakes().then(() => {
            console.log("Car makes loaded successfully.");
        }).catch(error => {
            console.error("Error loading car makes:", error);
        });
    } else {
        console.error("Element with ID 'btnSelectMake' not found.");
    }
});

async function getCarMakes() {

    const url = 'https://car-data.p.rapidapi.com/cars/makes';
    const options = {
	method: 'GET',
	headers: {
		'x-rapidapi-key': '5166fd7a53msh145ef723e419885p1f8162jsnc058c4d59627',
		'x-rapidapi-host': 'car-data.p.rapidapi.com'
	}
    };
    try {
        const response = await fetch(url, options);

        const result = await response.text();
        const carMakes = Array.isArray(result) ? result : result.makes || [];
      // Assuming 'makes' is the correct property holding the list
        populateCarMakesDropdown(carMakes)
        console.log(result);
    } catch (error) {
        console.error(error);
    }
}
function populateCarMakesDropdown(carMakes) {
    const selectMakeChoice = document.getElementById('btnSelectMake');
    selectMakeChoice.innerHTML = ''; // Clear any existing options

    if (Array.isArray(carMakes)) {
        carMakes.forEach(make => {
            const option = document.createElement('option');
            option.value = make;
            option.textContent = make;
            selectMakeChoice.appendChild(option);
        });
        console.log("Car makes added to dropdown.");
    } else {
        console.error("Expected an array of car makes but received:", carMakes);
    }
}
