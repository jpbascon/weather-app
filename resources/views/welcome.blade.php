<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weather App</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden z-10 backdrop-blur-2xl"></div>
  <nav class="h-[80px] flex justify-between items-center max-w-6xl mx-auto">
    <div>
      <p class="font-semibold text-xl">Weather App</p>
    </div>
    <div class="gap-8 flex items-center">
      <div class="relative size-fit z-30">
        <input type="text" placeholder="Search..." id="search"
          class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
        <button id="searchBtn" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-search">
            <path d="m21 21-4.34-4.34" />
            <circle cx="11" cy="11" r="8" />
          </svg>
        </button>
      </div>
      <div class="cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-moon-icon lucide-moon">
          <path
            d="M20.985 12.486a9 9 0 1 1-9.473-9.472c.405-.022.617.46.402.803a6 6 0 0 0 8.268 8.268c.344-.215.825-.004.803.401" />
        </svg>
      </div>
    </div>
  </nav>
  <main class="relative">
    <section>
      <div class="max-w-3xl mx-auto py-40">
        <div class="gap-8 flex items-center justify-between">
          <div class="flex flex-col gap-2" id="today">
          </div>
          <div id="condition">
          </div>
        </div>
      </div>
    </section>
    <section class="bg-[#fafafa]">
      <div class="flex flex-col items-center gap-16 py-20">
        <h1 class="text-3xl font-semibold text-gray-900">6-Day Forecast</h1>
        <div class="flex gap-2 items-center" id="forecast">
        </div>
    </section>
    <section>
      <div class="py-40 gap-8 flex flex-col items-center">
        <h1 class="text-3xl font-semibold">Today's Details</h1>
        <div class="gap-4 flex items-center">
          <div class="gap-2 border-[#fafafa] border-4">
            <div class="py-6 px-20 flex flex-col items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                stroke="#7585d9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-thermometer-sun-icon lucide-thermometer-sun">
                <path d="M12 9a4 4 0 0 0-2 7.5" />
                <path d="M12 3v2" />
                <path d="m6.6 18.4-1.4 1.4" />
                <path d="M20 4v10.54a4 4 0 1 1-4 0V4a2 2 0 0 1 4 0Z" />
                <path d="M4 13H2" />
                <path d="M6.34 7.34 4.93 5.93" />
              </svg>
              <p>Humidity</p>
              <p class="font-bold text-2xl" id="humidity"></p>
            </div>
          </div>
          <div class="gap-2 border-[#fafafa] border-4">
            <div class="py-6 px-20 flex flex-col items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                stroke="#7585d9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-wind-icon lucide-wind">
                <path d="M12.8 19.6A2 2 0 1 0 14 16H2" />
                <path d="M17.5 8a2.5 2.5 0 1 1 2 4H2" />
                <path d="M9.8 4.4A2 2 0 1 1 11 8H2" />
              </svg>
              <p>Wind Speed</p>
              <p class="font-bold text-2xl" id="wind"></p>
            </div>
          </div>
          <div class="gap-2 border-[#fafafa] border-4">
            <div class="py-6 px-20 flex flex-col items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                stroke="#7585d9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-sun-icon lucide-sun">
                <circle cx="12" cy="12" r="4" />
                <path d="M12 2v2" />
                <path d="M12 20v2" />
                <path d="m4.93 4.93 1.41 1.41" />
                <path d="m17.66 17.66 1.41 1.41" />
                <path d="M2 12h2" />
                <path d="M20 12h2" />
                <path d="m6.34 17.66-1.41 1.41" />
                <path d="m19.07 4.93-1.41 1.41" />
              </svg>
              <p>UV Index</p>
              <p class="font-bold text-2xl" id="uv"></p>
            </div>
          </div>
          <div class="gap-2 border-[#fafafa] border-4">
            <div class="py-6 px-20 flex flex-col items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                stroke="#7585d9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-sunrise-icon lucide-sunrise">
                <path d="M12 2v8" />
                <path d="m4.93 10.93 1.41 1.41" />
                <path d="M2 18h2" />
                <path d="M20 18h2" />
                <path d="m19.07 10.93-1.41 1.41" />
                <path d="M22 22H2" />
                <path d="m8 6 4-4 4 4" />
                <path d="M16 18a4 4 0 0 0-8 0" />
              </svg>
              <p>Sunrise</p>
              <p class="font-bold text-2xl" id="sunrise"></p>
            </div>
          </div>
          <div class="gap-2 border-[#fafafa] border-4">
            <div class="py-6 px-20 flex flex-col items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                stroke="#7585d9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-sunset-icon lucide-sunset">
                <path d="M12 10V2" />
                <path d="m4.93 10.93 1.41 1.41" />
                <path d="M2 18h2" />
                <path d="M20 18h2" />
                <path d="m19.07 10.93-1.41 1.41" />
                <path d="M22 22H2" />
                <path d="m16 6-4 4-4-4" />
                <path d="M16 18a4 4 0 0 0-8 0" />
              </svg>
              <p>Sunset</p>
              <p class="font-bold text-2xl" id="sunset"></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>

</html>