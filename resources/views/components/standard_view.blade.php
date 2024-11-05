<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OneLyfe - The Work / Life Balance Calculator</title>
    @vite('resources/css/app.css')
</head>
<body>



    <!-- Navigation -->
    <nav>
        <div class="navbar bg-blue-4 white">
            <a href="/" class="f-size-2 white monstera-three-regular">ONE-LYFE</a>
            <span class="menu-toggle">☰</span>
        </div>

        <!-- Navigation Links -->
        <div class="nav-links column bg-white">
            <a href="/" class="menu-item">Home</a>
            <a href="/balance" class="menu-item">Check your balance</a>
            <a href="/" class="menu-item">Get more insights</a>
            <a href="/" class="menu-item">Previous results</a>

            <!-- Dropdown Example -->
            <div class="dropdown">
                <a href="#" class="menu-item">Account</a>
                <div class="dropdown-content">
                    <a href="#" class="menu-item">Your profile</a>
                    <a href="#" class="menu-item">Settings</a>
                    <a href="#" class="menu-item">Help</a>
                </div>
            </div>
        </div>
    </nav>
    



    {{ $slot }}



    <!-- Footer -->
    <footer></footer>



    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>

        // JavaScript to toggle the mobile menu
        document.querySelector('.menu-toggle').addEventListener('click', () => {
            const navLinks = document.querySelector('.nav-links');
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        });

        document.getElementById('CalculationForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent page reload

            // Gather input values
            const hours_work_per_month = document.getElementById('hours_work_per_month').value;
            const hours_sleep_per_month = document.getElementById('hours_sleep_per_month').value;
            const hours_lesiure_per_month = document.getElementById('hours_lesiure_per_month').value;
            
            // Manipulate the DOM based on the response
            //const resultDiv = document.getElementById('CalulationArea');
            //resultDiv.innerHTML = `<p>Gathering Results...</p>`;

            // Use Axios to send a POST request to the Laravel route
            axios.post('{{ route('calculate.full') }}', {
                hours_work_per_month: hours_work_per_month,
                hours_sleep_per_month: hours_sleep_per_month,
                hours_lesiure_per_month: hours_lesiure_per_month
            })
            .then(response => {
                
                // Manipulate the DOM based on the response
                const percentageWorkDisplay = document.getElementById('work_percentage');
                const percentageWorkContainer = document.getElementById('work_percentage_container');
                const percentageSleepDisplay = document.getElementById('sleep_percentage');
                const percentageSleepContainer = document.getElementById('sleep_percentage_container');
                const percentageLeisureDisplay = document.getElementById('lesiure_percentage');
                const percentageLeisureContainer = document.getElementById('lesiure_percentage_container');
                const percentageOtherDisplay = document.getElementById('other_percentage');
                const percentageOtherContainer = document.getElementById('other_percentage_container');
                

                //
                if (response.data)
                {

                    // Handle Display
                    percentageWorkDisplay.innerHTML = `${response.data.percentages.work}%`;
                    percentageSleepDisplay.innerHTML = `${response.data.percentages.sleep}%`;
                    percentageLeisureDisplay.innerHTML = `${response.data.percentages.lesiure}%`;
                    percentageOtherDisplay.innerHTML = `${response.data.percentages.remaining}%`;

                    // Handle Widths
                    percentageWorkContainer.style.height = `${response.data.percentages.work}%`;
                    percentageSleepContainer.style.height = `${response.data.percentages.sleep}%`;
                    percentageLeisureContainer.style.height = `${response.data.percentages.lesiure}%`;
                    percentageOtherContainer.style.height = `${response.data.percentages.remaining}%`;
                }

            })
            .catch(error => {
                // Handle any errors
                // document.getElementById('CalulationArea').innerHTML = `<p>Error: ${error.response.data.message || 'Server error'}</p>`;
                console.log(error);
            });
        });
    </script>


</body>
</html>