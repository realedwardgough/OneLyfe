<x-standard_view>
     <!-- Main Content -->
     <main class="column gap-1 align-center padding-1">
        <section class="column padding-1">
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
    </main>
</x-standard_view>