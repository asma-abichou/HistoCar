let selectModelBtn = document.querySelector('.btnSelectMake');
console.log(selectModelBtn);

    selectModelBtn.addEventListener('click',() => {
        fetchCarModel()
    })


export function fetchCarModel() {

   // const fetchPromise = fetch("https://api.api-ninjas.com/v1/carmakes");
    return fetch("https://api.api-ninjas.com/v1/carmakes", { //omitted headers to keep it clean
    })
        .then(response => {
            if (!repsonse.ok) {
                throw new Error("HTTP status " + response.status);
            }
            return response.text(); // or `.json()` or several others, see #4 above
        });
}


    //const API_KEY = 'BmkjbxbJdUDebq7e40gr2Q==jL3XvpCBOQOxcejn';
    //let url = 'https://api.api-ninjas.com/v1/carmakes';

    /* try{
         let url = 'https://api.api-ninjas.com/v1/carmakes';
         let response = await fetch(url);

          if (!response.ok) {
              throw new Error(`Failed to fetch car models: ${response.status}`);
            }

         const models = await response.json();
           models.forEach(model => {
                    const option = document.createElement('option');
                    option.value = model.model;
                    option.textContent = model.model;
                    makeSelect.appendChild(option);
                });
         console.log(response);
     }catch (error){

     }*/

