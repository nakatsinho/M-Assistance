const form = document.querySelector("#weather-form");
const input = document.querySelector("#weather-form input[name='city']");
const errorContainer = document.querySelector("#error-container");
const list = document.querySelector(".cities");

form.addEventListener("submit", e => {
    e.preventDefault();
    let inputVal = input.value;

    fetch("/weather", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ city: inputVal })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('City not found... Introduce a valid city name');
            }
            return response.json();
        })
        .then(data => {

            const { name, country, temp, description, icon, population, percapita, rate, rateName } = data;

            console.log(data);

            const formattedPopulation = Number(population).toLocaleString();
            const formattedPercapita = Number(percapita).toLocaleString(undefined, {
                style: 'currency',
                currency: 'USD',
            });
            const formattedRateValue = Number(rate).toLocaleString(undefined, {
                style: 'currency',
                currency: rateName,
            });

            const li = document.createElement("li");
            li.classList.add("city");
            const markup = `
                    <h2 class="city-name" data-name="${name},${country}">
                        <span>${name}</span>
                        <sup>${country}</sup>
                    </h2>
                    <div class="city-temp">${Math.round(temp)}<sup>°C</sup></div>
                    <figure>
                        <img class="city-icon" src="${icon}" alt="description">
                        <figcaption>${description}</figcaption>
                    </figure>
                    <div><span>POPULATION: </span><span> ${formattedPopulation}</span></div>
                    <div><span>PERCAPITA: </span><span> ${formattedPercapita}</span></div>
                    <hr />
                    <br>
                    <div class="row"> 
                        <div class="col-md-6"> <span>USD </span><span> 1$  </span></div>
                        <div class="col-md-6"> <span> ${formattedRateValue}</span></div>
                    </div>
                `;

            li.innerHTML = markup;
            list.appendChild(li);

            const errorContainer = document.getElementById('error-container');
            errorContainer.style.display = 'none';
        })
        .catch(error => {
            errorContainer.textContent = error.message || 'Introduce a valid city name';
            errorContainer.style.display = 'block';
        });

    form.reset();
    input.focus();
});
