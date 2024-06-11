<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <main class="d-flex flex-column justify-content-between">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Subscription Plan</h1>
            <p class="lead mt-5">Choose your subscription plan, the subscription is montly.</p>
        </div>
        <section class="pricing py-5">
            <div class="container">
                <div class="row">
                    <!-- Free Tier -->
                    <div class="col-lg-4">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">Free</h5>
                                <h6 class="card-price text-center">0€<span class="period">/month</span></h6>
                                <hr>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>See the list of movies
                                    </li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Mark movies as favorites
                                    </li>
                                    <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Watch
                                        normal movies</li>
                                    <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Watch
                                        movies in high definition</li>
                                </ul>
                                <div class="d-grid">
                                    <a href="#" class="btn btn-danger text-uppercase">Default</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Plus Tier -->
                    <div class="col-lg-4">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">Plus</h5>
                                <h6 class="card-price text-center">9€<span class="period">/month</span></h6>
                                <hr>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>See the list of
                                        movies/series</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Mark movies/series as
                                        favorites</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Watch normal
                                        movies/series</li>
                                    <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Watch
                                        movies in high definition</li>
                                </ul>
                                <div class="d-grid">
                                    <a href="#" class="btn btn-danger text-uppercase btn-choose-plan"
                                        data-bs-toggle="modal" data-bs-target="#subscriptionModal"
                                        data-plan-name="PLUS">Choose Plan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pro Tier -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">Pro</h5>
                                <h6 class="card-price text-center">19€<span class="period">/month</span></h6>
                                <hr>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>See the list of
                                        movies/series</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Mark movies/series as
                                        favorites</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Watch normal
                                        movies/series</li>
                                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Watch movies in high
                                        definition</li>
                                </ul>
                                <div class="d-grid">
                                    <a href="#" class="btn btn-danger text-uppercase btn-choose-plan"
                                        data-bs-toggle="modal" data-bs-target="#subscriptionModal"
                                        data-plan-name="PRO">Choose Plan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="subscriptionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="subscriptionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subscriptionModalLabel"><strong>Payment Details</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="subscriptionForm" role="form" action="{{ route('subscription.subscribe') }}"
                        method="post">
                        @csrf

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="planName" class="form-label">Plan Name:</label>
                                <input type="text" class="form-control" id="planName" name="planName">
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="subscriptionMonths" class="form-label">Subscription Months:</label>
                                    <select class="form-select" id="subscriptionMonths" name="subscriptionMonths">
                                        <option value="1">1 Month</option>
                                        <option value="3">3 Months</option>
                                        <option value="6">6 Months</option>
                                        <option value="12">12 Months</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="pricePerMonth" class="form-label">Price Per Month:</label>
                                    <input type="text" class="form-control" id="pricePerMonth"
                                        name="pricePerMonth" value="10" disabled>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="totalPrice" class="form-label">Total Price:</label>
                                    <input type="text" class="form-control" id="totalPrice" name="totalPrice"
                                        disabled>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="entity" class="form-label">Entity:</label>
                                <input type="text" class="form-control" id="entity" name="entity"
                                    placeholder="Enter your entity">
                            </div>
                            <div class="mb-3">
                                <label for="accountNumber" class="form-label">Card Number:</label>
                                <input type="text" class="form-control" id="accountNumber" name="accountNumber"
                                    placeholder="Enter your card number">
                            </div>
                            <div class="mb-3">
                                <label for="accountName" class="form-label">Name on Card</label>
                                <input type="text" class="form-control" id="accountName" name="accountName"
                                    placeholder="Enter your account name">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
    <script type="module">
        document.querySelectorAll('.btn-choose-plan').forEach(button => {
            button.addEventListener('click', () => {

                var planName = button.getAttribute('data-plan-name');
                document.getElementById('planName').setAttribute('value', planName);

                document.getElementById('planName').value = planName;

                // Set the initial number of months
                const initialMonths = 1;

                // Define prices for different plans
                const prices = {
                    PLUS: 9,
                    PRO: 19
                };

                // Set initial price per month based on the initial plan
                let initialPricePerMonth = prices[planName];

                // If the initial plan is "PRO", set the price per month to 19
                if (planName === 'PRO') {
                    initialPricePerMonth = 19;
                } else if (planName === 'PLUS') {
                    initialPricePerMonth = 9;
                }

                // Calculate the initial total price
                const initialTotalPrice = initialMonths * initialPricePerMonth;

                // Set initial values to the corresponding input fields
                document.getElementById('planName').setAttribute('value', planName);
                document.getElementById('pricePerMonth').setAttribute('value', initialPricePerMonth);
                document.getElementById('subscriptionMonths').value = initialMonths;
                document.getElementById('totalPrice').setAttribute('value', initialTotalPrice.toFixed(2));

                // Get references to elements
                const subscriptionMonthsSelect = document.getElementById('subscriptionMonths');
                const pricePerMonthInput = document.getElementById('pricePerMonth');
                const totalPriceInput = document.getElementById('totalPrice');

                // Add event listener to the select element
                subscriptionMonthsSelect.addEventListener('change', updateTotalPrice);

                // Function to update the total price based on the selected number of months
                function updateTotalPrice() {
                    const selectedMonths = parseInt(subscriptionMonthsSelect.value);
                    const pricePerMonth = parseFloat(pricePerMonthInput.value);
                    const totalPrice = selectedMonths * pricePerMonth;
                    totalPriceInput.value = totalPrice.toFixed(
                        2); // Display total price with two decimal places
                }

                // Initial call to update total price when the page loads
                updateTotalPrice();
            });
        });
        document.getElementById('submitButton').addEventListener('click', function() {
            // Evitar que el formulario se envíe automáticamente
            event.preventDefault();
            // submit form
            document.getElementById('subscriptionForm').submit();
        });
    </script>
</body>

</html>
