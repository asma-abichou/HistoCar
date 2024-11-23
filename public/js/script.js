$(document).ready(function () {
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

    // Hide dependent fields initially
    $('#btnSelectModel').parent().hide();
    $('#btnSelectYear').parent().hide();
    $('#mileage').parent().hide();
  //  console.log('i m here')

    // Form submission logic
    $('#carRegistrationForm').on('submit', function (event) {
        event.preventDefault(); // Prevents page reload

        // Collect form data
        const carData = {
            make: $('#btnSelectMake').val(),
            model: $('#btnSelectModel').val(),
            year: $('#btnSelectYear').val(),
            mileage: $('#mileage').val(),
        };

        // Send data to the server
        $.ajax({
            url: '/register/car',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(carData),
            success: function (response) {
                alert("Car registered successfully!");
                $('#carRegistrationForm')[0].reset(); // Reset form
                hideDependentFields(); // Reset field visibility
            },
            error: function (error) {
                console.error("Error registering car:", error);
                alert("An error occurred while registering the car.");
            }
        });
    });

    // Fetch car makes
    async function getCarMakes() {
        try {
            const response = await fetch(urlMake, options);
            const carMakes = await response.json();
            populateSelect('#btnSelectMake', carMakes, 'Select a Car Make');
        } catch (error) {
            console.error("Error fetching car makes:", error);
        }
    }

    // Fetch car models
    async function getCarModels(make) {
        try {
            const response = await fetch(`${urlModel}?make=${make}`, options);
            const carModels = await response.json();
            populateSelect('#btnSelectModel', carModels.map(m => m.model), 'Select a Car Model');
        } catch (error) {
            console.error("Error fetching car models:", error);
        }
    }

    // Fetch car years
    async function getCarYear(make, model) {
        try {
            const response = await fetch(`${urlYear}?make=${make}&model=${model}`, options);
            const carYears = await response.json();
            populateSelect('#btnSelectYear', carYears.map(y => y.year), 'Select a Car Year');
        } catch (error) {
            console.error("Error fetching car years:", error);
        }
    }

    // select field to hide
    function populateSelect(selector, options, placeholder) {
        const $select = $(selector);
        $select.empty();
        $select.append(`<option value="">${placeholder}</option>`);
        options.forEach(option => {
            $select.append(`<option value="${option}">${option}</option>`);
        });
        $select.parent().show();
    }

    // Hide all dependent fields
    function hideDependentFields() {
        $('#btnSelectModel').parent().hide();
        $('#btnSelectYear').parent().hide();
        $('#mileage').parent().hide();
    }

    // Event listeners
    $('#btnSelectMake').change(function () {
        const make = $(this).val();
        if (make) {
            getCarModels(make);
        } else {
            hideDependentFields();
        }
    });

    $('#btnSelectModel').change(function () {
        const make = $('#btnSelectMake').val();
        const model = $(this).val();
        if (model) {
            getCarYear(make, model);
        } else {
            $('#btnSelectYear').parent().hide();
            $('#mileage').parent().hide();
        }
    });


    $('#btnSelectYear').change(function () {
        const year = $(this).val();
        if (year) {
            $('#mileage').parent().show();
        } else {
            $('#mileage').parent().hide();
        }
    });

    // Initialize the form
    getCarMakes();
});
