import './bootstrap';
import '../css/app.css';

let city;
const searchBar = document.getElementById('search');

const fetchWeather = async (city) => {
  const todayDiv = document.getElementById("today");
  const conditionDiv = document.getElementById('condition');
  const humidity = document.getElementById('humidity');
  const wind = document.getElementById('wind');
  const uv = document.getElementById('uv');
  const forecast = document.getElementById('forecast');
  const sunset = document.getElementById('sunset');
  const sunrise = document.getElementById('sunrise');
  try {
    if (!city) city = 'Makati';
    const getWeather = await fetch(`/api/weather?city=${encodeURIComponent(city)}`);
    const weatherData = await getWeather.json();
    const getForecast = await fetch(`/api/forecast?city=${encodeURIComponent(city)}`);
    const forecastData = await getForecast.json();

    // WEATHER TODAY
    if (weatherData.error) return todayDiv.innerHTML = `<p class="text-red-600 text-lg">Error: ${weatherData.error}</p>`;
    const condition = weatherData.current.condition.code;
    console.log(weatherData);
    todayDiv.innerHTML = `
    <h2 class="text-3xl font-semibold text-gray-600">${weatherData.location.name}, ${weatherData.location.country}</h2>
      <p class="text-md text-gray-600">${new Date(weatherData.location.localtime).toDateString()}</p>
      <div class="flex gap-2 items-center">
        <img src=${weatherData.current.condition.icon} alt=${weatherData.current.condition.text}/>
        <h2 class="text-6xl font-bold">${weatherData.current.temp_c}°C</h2>
      </div>
    <p class="text-2xl text-gray-700 font-medium">${weatherData.current.condition.text}</p>`
    conditionDiv.innerHTML = `
    <img class="w-[300px] h-[240px] object-cover"
      src="./weather/${condition}.jpg"
      onerror="this.onerror=null
      this.src='/weather/${condition}.jpg'"
      alt=${weatherData.current.condition.text}/>`
    humidity.textContent = `${weatherData.current.humidity}%`;
    wind.textContent = `${weatherData.current.wind_kph}/kph`;
    uv.textContent = `${weatherData.current.uv}`;

    // FORECAST DATA
    if (forecastData.error) return forecast.innerHTML = `<p class="text-red-600 text-lg">Error: ${weatherData.error}</p>`;
    sunrise.textContent = `${forecastData.forecast.forecastday[0].astro.sunrise}`;
    sunset.textContent = `${forecastData.forecast.forecastday[0].astro.sunset}`;
    const days = forecastData.forecast.forecastday.splice(1);
    console.log(days);
    forecast.innerHTML = days.map((data, idx) => (
      `<div class="py-6 px-16 gap-2 flex flex-col items-center bg-white" key=${idx}>
        <p class="font-medium">${new Date(data.date).toDateString().split(' ')[0]}</p>
        <img src=${data.day.condition.icon} alt=${data.day.condition.text} />
        <p class="text-sm text-gray-700">${data.day.condition.text}</p>
        <div class="flex gap-2 items-center">
          <p class="font-bold text-lg">${data.day.maxtemp_c}°</p>
          <p class="text-sm">${data.day.mintemp_c}°</p>
        </div>
      </div>`
    ))
  } catch (err) {
    console.error(err);
    todayDiv.innerHTML = `<p class="text-red-600">Failed to fetch weather data.</p>`
  }
}
fetchWeather();

let timeout;
searchBar.addEventListener('input', (e) => {
  clearTimeout(timeout);
  timeout = setTimeout(() => {
    city = e.target.value.trim();
    fetchWeather(city);
  }, 800)
})

const searchInput = document.getElementById('search');
const overlay = document.getElementById('overlay');

searchInput.addEventListener('focus', () => {
  overlay.classList.remove('hidden');
});

searchInput.addEventListener('blur', () => {
  // slight delay so click inside input or button isn’t lost
  setTimeout(() => overlay.classList.add('hidden'), 100);
});

// Optional: clicking the overlay also closes it
overlay.addEventListener('click', () => {
  overlay.classList.add('hidden');
  searchInput.blur();
});