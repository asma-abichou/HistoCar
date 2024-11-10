$(document).ready(function() {
    const urlMake = 'https://car-data.p.rapidapi.com/cars/makes';
    const urlTypes = 'https://car-data.p.rapidapi.com/cars';
    const options = {
        method: 'GET',
        headers: {
            'x-rapidapi-key': '5166fd7a53msh145ef723e419885p1f8162jsnc058c4d59627',
            'x-rapidapi-host': 'car-data.p.rapidapi.com'
        }
    };
    async function getCarModels(make) {
        try {
            const response = await fetch(`${urlTypes}?make=${make}`, options);
            if (!response.ok) throw new Error(`HTTP status ${response.status}`);

            const carModels = await response.json();
            SelectCarTypes(carModels);
        } catch (error) {
            console.error("Error fetching car models:", error);
        }
    }

    async function getCarMakes() {
        try {
            const response = await fetch(urlMake, options);
            if (!response.ok) {
                throw new Error(`HTTP status ${response.status}`);
            }

            const carMakes = await response.json();
            console.log(carMakes); // View data in the console
            SelectCarMakes(carMakes);
        } catch (error) {
            console.error("Error fetching car makes:", error);
        }
    }

    function SelectCarMakes(carMakes) {
        const $selectMakeChoice = $('#btnSelectMake');

        $selectMakeChoice.empty(); // Clear existing options
        $selectMakeChoice.append('<option value="">Select a Car Make</option>'); // Add placeholder option

        carMakes.forEach(make => {
            $selectMakeChoice.append(`<option value="${make}">${make}</option>`);
        });
         $selectMakeChoice.change(function() {
            const selectedMake = $(this).val();
            if (selectedMake) {
                getCarModels(selectedMake);
            }
        });
    }


    function SelectCarTypes(carModels) {
        const $selectModelChoice = $('#btnSelectModel');
        $selectModelChoice.empty();
        $selectModelChoice.append('<option value="">Select a Car Model</option>');

        carModels.forEach(model => {
            $selectModelChoice.append(`<option value="${model.model}">${model.model}</option>`);
        });
    }
    getCarMakes();
});
