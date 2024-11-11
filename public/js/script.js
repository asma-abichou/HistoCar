    $(document).ready(function() {

        const urlMake = 'https://car-data.p.rapidapi.com/cars/makes';
        const urlModel = 'https://car-data.p.rapidapi.com/cars';
        const urlYear = 'https://car-data.p.rapidapi.com/cars';
        const options = {
            method: 'GET',
            headers: {
                'x-rapidapi-key': '5166fd7a53msh145ef723e419885p1f8162jsnc058c4d59627',
                'x-rapidapi-host': 'car-data.p.rapidapi.com'
            }
        };
        //submit the form values and register the car
        $('#carRegistrationForm').on('submit', function(event) {
                event.preventDefault(); // Prevents page reload

                // Collect form data
                const carData = {
                    make: $('#btnSelectMake').val(),
                    model: $('#btnSelectModel').val(),
                    year: $('#btnSelectYear').val(),
                    mileage: $('#mileage').val(),
                    _csrf_token: $('input[name="_csrf_token"]').val()
                };

                console.log("Car Registration Data:", carData);

                // Send data to the server
                $.ajax({
                    url: '/register/car',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(carData),
                    success: function(response) {
                        alert("Car registered successfully!");
                        // Optional: Reset form after successful submission
                        $('#carRegistrationForm')[0].reset();
                    },
                    error: function(error) {
                        console.error("Error registering car:", error);
                        alert("An error occurred while registering the car.");
                    }
                });
        });
        //get Car Model
        async function getCarModels(make) {
            try {

                const response = await fetch(`${urlModel}?make=${make}`, options);
                //console.log(response)
                const carModels = await response.json();
                SelectCarModels(carModels);
            } catch (error) {
                console.error("Error fetching car models:", error);
            }
        }
        //Get Car Makes
        async function getCarMakes() {
            try {
                const response = await fetch(urlMake, options);
                //console.log(response)
                const carMakes = await response.json();
                console.log(carMakes);
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


        function SelectCarModels(carModels) {
            const $selectModelChoice = $('#btnSelectModel');
            $selectModelChoice.empty();
            $selectModelChoice.append('<option value="">Select a Car Model</option>');

            carModels.forEach(model => {
                $selectModelChoice.append(`<option value="${model.model}">${model.model}</option>`);
            });

            $selectModelChoice.change(function() {
                const selectedMake = $('#btnSelectMake').val();
                const selectedModel = $(this).val();

                getCarYear(selectedMake, selectedModel);
            });


        }
        async function getCarYear(make, model) {
            try {
                const response = await fetch(`${urlYear}?make=${make}&model=${model}`, options);
                if (!response.ok) throw new Error(`HTTP status ${response.status}`);

                const carYears = await response.json();
                SelectCarYear(carYears);
            } catch (error) {
                console.error("Error fetching car years:", error);
            }
        }

        function SelectCarYear(carYear){
            const $selectYearChoice = $('#btnSelectYear');
            $selectYearChoice.empty();
            $selectYearChoice.append('<option value="">Select a Car Year</option>');

            carYear.forEach(year => {
                $selectYearChoice.append(`<option value="${year.year}">${year.year}</option>`);
            });

        }
        getCarMakes();
    });
