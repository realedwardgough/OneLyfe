<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OneLyfe - The Work / Life Balance Calculator</title>

    @vite('resources/css/app.css')
</head>
<body>

    <nav class="row padding-2 bg-midnight-blue white space-between align-center">
        <header class="column">
            <h1 class="f-size-3-5">OneLyfe</h1>
            <h2 class="f-size-1">The Work / Life Balanace Calculator</h2>
        </header>

        <div class="column align-center">
            <input type="checkbox" id="nav-toggle" class="nav-toggle">
            <label for="nav-toggle" class="nav-toggle-label"><span></span></label>
            <ul class="nav-links row list-none gap-1">
                <li><a href="" class="link-none black link-hover-underline">Home</a></li>
            </ul>
        </div>

    </nav>

    <main class="column gap-1 align-center padding-1">
        <section class="column max-width-400 card padding-1">
            <form id="CalculationForm" class="newsletter-form">
                
                <div class="column gap-0">
                    <label for="hours_work" class="readable-content"><p>How many hours each month do you work?</p></label>
                    <input type="number" name="hours_work_per_month" id="hours_work_per_month" placeholder="" class="form-input" required>
                </div>

                <div class="column gap-0">
                    <label for="hours_sleep_per_month" class="readable-content"><p>Roughly, how many hours do you sleep each month?</p></label>
                    <input type="number" name="hours_sleep_per_month" id="hours_sleep_per_month" placeholder="" class="form-input" required>
                </div>

                <div class="column gap-0">
                    <label for="hours_sleep_per_week" class="readable-content"><p>On average, how many hours per month are spent doing lesiurely activities?</p></label>
                    <input type="number" name="hours_lesiure_per_month" id="hours_lesiure_per_month" placeholder="" class="form-input" required>
                </div>
                
                <div class="column gap-0">
                    <button type="submit" class="cta-button">Calculate</button>
                </div>

            </form>
        </section>


        <section class="column align-center card full-width" id="CalulationArea">
            <div class="row bg-white" style="width: 100%; height: fit-content;">
                <div class="bg-seafoam-green align-center" style="padding: 10px;" id="work_percentage_container">
                    <p class="white">Work</p>
                    <p class="white" id="work_percentage">10%</p>
                </div>
                <div class="bg-coral align-center" style="padding: 10px;" id="sleep_percentage_container">
                    <p class="white">Sleep</p>
                    <p class="white" id="sleep_percentage">60%</p>
                </div>
                <div class="bg-royal-blue align-center" style="padding: 10px;" id="lesiure_percentage_container">
                    <p class="white">Lesiure</p>
                    <p class="white" id="lesiure_percentage">10%</p>
                </div>
                <div class="bg-cool-gray align-center" style="padding: 10px;" id="other_percentage_container">
                    <p class="white">Other</p>
                    <p class="white" id="other_percentage">10%</p>
                </div>
            </div>
        </section>

    </main>

    <footer></footer>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
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
                    percentageWorkContainer.style.width = `${response.data.percentages.work}%`;
                    percentageSleepContainer.style.width = `${response.data.percentages.sleep}%`;
                    percentageLeisureContainer.style.width = `${response.data.percentages.lesiure}%`;
                    percentageOtherContainer.style.width = `${response.data.percentages.remaining}%`;
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