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
