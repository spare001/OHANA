<?php
// booking.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ohana";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OHANA Private Resort</title>
    <link rel="icon" href="img/logo-png.png" type="image/x-icon">
    <link rel="stylesheet" href="style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="mode.js"></script>  
        
    <script>
        (function() {
            const savedMode = localStorage.getItem('mode');
            if (savedMode) {
                document.documentElement.classList.add(savedMode);
            } else {
                document.documentElement.classList.add('light-mode'); // Default to light mode
            }
        })();
    </script>

<style>
    /* Remove underline from day numbers */
    .fc-daygrid-day-number {
            text-decoration: none !important;
        }

        /* Remove underline from day names (Monday to Sunday) */
        .fc-col-header-cell, .fc-col-header-cell a {
            text-decoration: none !important; /* Remove underlines */
            border: none !important; /* Remove any borders around the day names */
            padding: 20px 0 !important;
            background: linear-gradient(-90deg, rgba(253,211,27,1) 0%, rgba(237,70,7,1) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }

        /* .fc-col-header {
            background-color: #fff5cc !important;
        } */

        /* Add border around each day */
        .fc-daygrid-day {
            border: 1px solid #ddd; /* Light gray border */
        }

        /* Add a hover effect if desired (optional) */
        .fc-daygrid-day:hover {
            background-color: wheat; /* Highlight border on hover */
            color: black !important;
        }

        /* Customize the toolbar buttons and title color to orange */
        .fc-toolbar button {
            background-color: #fff5cc !important;
            border-color: #fff5cc !important;
            color: black !important;
            text-transform: uppercase; /* Capitalize button text */
        }

        /* Customize the title color and capitalize the title */
        .fc-toolbar h2 {
            color: orange !important;
            text-transform: uppercase; /* Capitalize title */
        }

        /* Add border only around the calendar content (days) */
        .fc .fc-daygrid {
            border: transparent !important;
            border-radius: 5px; /* Optional rounded corners */
        }

        body.dark-mode .fc-daygrid-day:hover {
            background-color: wheat; /* Highlight border on hover */
            color: black !important;
        }

        body.dark-mode  .fc-daygrid-day-number {
            text-decoration: none !important;
            color: white !important;
        }

        body.dark-mode label{
            color: black; /* Text color in dark mode */
        }

        body.dark-mode .fc-daygrid-day-number {
                    color: white; /* Day number color */
                }

                body.dark-mode p {
                    color: black; /* Day number color */
                }

        /* Default styling for text fields */
        body.dark-mode .form-control, .form-select {
            border: 1px solid orange !important; /* Default border color */
            border-radius: 15px; /* Rounded corners */
            padding: 10px; /* Padding inside the text field */
        }

        .custom-form-control {
        padding: 10px;
        border: 1px solid orange;
        border-radius: 15px; /* Optional, for rounded corners */
        background-color: white;
    }


        /* Styling for focused text fields */
        /* Default styling for text fields */
        body.dark-mode .form-control:focus {
            border-color: orange !important; /* Border color on focus */
            box-shadow: 0 0 0 1px orangered !important; /* Light shadow effect */
            outline: none; /* Remove default outline */
        }

        #calendar, #booking-form, #booking{
            width: 70%;
            max-width: 100%; /* Adjust as needed */
            margin: 0 auto;
        }

        #calendar {
            margin: 60px 0 80px 0;
            width: 100%;
            height: 100vh;
        }

        h4 {
            background: linear-gradient(-90deg, rgba(253,211,27,1) 0%, rgba(237,70,7,1) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }


        /* Default styling for text fields */
        .form-control, .form-select {
            border: 1px solid orange !important; /* Default border color */
            border-radius: 15px; /* Rounded corners */
            padding: 10px; /* Padding inside the text field */
        }

        /* Styling for focused text fields */
        .form-control:focus {
            border-color: orange !important; /* Border color on focus */
            box-shadow: 0 0 0 1px orangered !important; /* Light shadow effect */
            outline: none; /* Remove default outline */
        }

        @media (max-width: 768px) {
            #calendar, #booking-form, #booking {
            width: 100%;
            max-width: 100%; /* Adjust as needed */
            margin: 0;
            }

            #calendar {
            margin: 60px 0 80px 0;
            width: 100%;
            height: 100vh;
        }
}

</style>

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Logo on the Left -->
        <a class="navbar-brand" href="index.html">
            <img src="img/logo-png.png" width="55px" height="45px" alt="Logo"/>
        </a>

        <!-- Burger Menu Button for Small Devices -->
        <button class="nav-btn d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions" style="background: transparent; border: none;">
            <img src="img/burger-menu.png" width="50px" alt="Menu">
        </button>

        <!-- Offcanvas for Small Devices -->
        <div class="offcanvas offcanvas-end d-lg-none custom-offcanvas" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanvas-header">
                <button class="btn mt-2" data-bs-dismiss="offcanvas" aria-label="Close" style="background: transparent; border: none; font-size: 24px; padding-right: 30px;">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
            <!-- Navlinks for Small Devices -->
            <div class="offcanvas-body">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.html">HOME</a>
                    <a class="nav-link" href="about.html">ABOUT</a>
                    <a class="nav-link" href="gallery.html">GALLERY</a>
                    <a class="nav-link" href="#">OFFERS</a>
                    <a class="nav-link" href="#">ACCOMMODATIONS</a>
                    <a class="nav-link" href="#">FACILITIES</a>
                    <a class="nav-link act" href="booking.php">BOOK NOW</a>
                </div>
                <!-- Toggle Button for Dark/Light Mode in Offcanvas -->
                <div class="offcanvas-footer">
                    <button id="toggle-mode-sm" class="btn" style="background: transparent; border: none; font-size: 24px; padding: 15px;">
                        <i id="toggle-icon-sm" class="fas fa-moon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Navlinks for Large Devices on the Right -->
        <div class="collapse navbar-collapse d-none d-lg-flex justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="index.html">HOME</a>
                <a class="nav-link" href="about.html">ABOUT</a>
                <a class="nav-link" href="gallery.html">GALLERY</a>
                <a class="nav-link" href="#">OFFERS</a>
                <a class="nav-link" href="#">ACCOMMODATIONS</a>
                <a class="nav-link" href="#">FACILITIES</a>
                <a class="book-btn d-lg-block" href="booking.php" style="color: white; text-decoration: none; border: 1px solid white; padding: 10px 20px; margin-left: 30px;">BOOK NOW</a>

                <!-- Dark/Light Mode Toggle -->
                <button id="toggle-mode" class="btn" style="margin-left: 15px; background: transparent; border: none; font-size: 24px;">
                    <i id="toggle-icon" class="fas fa-moon"></i>
                </button>

            </div>
        </div>
    </div>
</nav>








<!-- Booking Section -->
<section id="booking" class="booking" style="width: 100%; padding: 50px 20px;">
    <form id="booking-form" method="POST" action="submit_booking.php" enctype="multipart/form-data">
        <div class="row" id="booking-form">

            <!-- Row 3: Booking Dates -->
<div style="padding: 50px 25px; background-color: #fff5cc; border-radius: 30px; margin-bottom: 50px;">
    <h4>Booking Dates</h4>
    <div class="row">
        <!-- Single Day Booking -->
        <div class="row">
            <div class="col-md-3">
                <label for="checkin_date" class="form-label">Check-In Date</label>
                <input type="text" class="form-control" id="checkin_date" name="checkin_date" readonly required>
            </div>
            <div class="col-md-3">
                <label for="checkout_date" class="form-label">Check-Out Date</label>
                <input type="text" class="form-control" id="checkout_date" name="checkout_date" readonly required>
            </div>

            <!-- Time Selection, shown by default -->
            <div class="col-md-6" id="timeSelectionDiv">
                <label for="time_selection" class="form-label">Time</label>
                <select class="form-select" id="time_selection" name="time_selection">
                    <option value="" disabled selected>Select Option</option>
                    <option value="Day Swim" data-price="8000">(Day Swim) 8 AM to 5 PM - ₱8,000</option>
                    <option value="Night Swim" data-price="11000">(Night Swim) 7 PM to 7 AM - ₱11,000</option>
                    <option value="22 hours" data-price="15000">22 Hours - ₱15,000</option>
                </select>
            </div>

            <!-- Multiple Days Price, hidden by default -->
            <div class="col-md-6" id="total-price-container" style="display: none;">
                <label for="multiple-days-price" class="form-label">Selected Days Total Price</label>
                <div class="custom-form-control"><span id="multiple-days-total-price"></span></div>
                <input type="hidden" id="multipleDaysTotalPriceInput" name="multiple_days_total_price">
            </div>
        </div>
    </div>
</div>

            <!-- Calendar Column -->
            <div class="col-md-12">
                    <div id="calendar"></div>
                </div>

                <!-- Form Column -->
                <div class="col-md-12">

                    <!-- Row 1: Contact Information -->
                    <div style="padding: 50px 25px; background-color: #fff5cc; border-radius: 30px; margin-bottom: 50px;">
                        <h4>Contact Information</h4>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="prefix" class="form-label">Prefix</label>
                                <select class="form-select" id="prefix" name="prefix" required>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Prof.">Prof.</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" required>
                            </div>
                            <div class="col-md-3">
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middleName" name="middle_name">
                            </div>
                            <div class="col-md-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="mobilePhone" class="form-label">Mobile Phone</label>
                                <input type="tel" class="form-control" id="mobilePhone" name="mobile_phone" required>
                            </div>
                            <div class="col-md-6">
                                <label for="emailAddress" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="emailAddress" name="email_address" required>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Address Details -->
                    <div style="padding: 50px 25px; background-color: #fff5cc; border-radius: 30px; margin-bottom: 50px;">
                        <h4>Address Details</h4>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="address1" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address1" name="address1" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                            </div>
                            <div class="col-md-6">
                                <label for="postalCode" class="form-label">Postal Code / ZIP</label>
                                <input type="text" class="form-control" id="postalCode" name="postal_code" required>
                            </div>
                        </div>
                    </div>

                    <!-- Room Selection -->
                    <div style="padding: 50px 25px; background-color: #fff5cc; border-radius: 30px; margin-bottom: 50px;">
                        <h4 class="mb-5">Room Selection</h4>
                        <div class="row">
                            <!-- Condo Type Room -->
                            <div class="col-md-6 mb-5">
                                <img src="img/ohana_imgs/photo (19).jpg" alt="Condo Type Room" style="max-width: 100%;" />
                            </div>
                            <div class="col-md-6 mb-5">
                                <h5>Condo Type Room</h5>
                                <p>This spacious condo-type room offers a comfortable stay with modern amenities including a king-sized bed, private bathroom, air conditioning, and a beautiful view. Perfect for families or couples looking for a relaxing getaway.</p>
                                <label for="smallRoomSelection" class="form-label room">Number of Condo Type Rooms</label>
                                <select class="form-select" style="width: 250px;" id="smallRoomSelection" name="num_small_rooms" required>
                                    <option value="0" data-price="0">No Room</option>
                                    <option value="1" data-price="1000">1 Room - ₱1,000</option>
                                    <option value="2" data-price="2000">2 Rooms - ₱2,000</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Dorm Type Room -->
                            <div class="col-md-6 mb-5">
                                <img src="img/ohana_imgs/photo (15).jpg" alt="Dorm Type Room" style="max-width: 100%;" />
                            </div>
                            <div class="col-md-6 mb-5">
                                <h5>Dorm Type Room</h5>
                                <p>The dorm-type room is designed for budget-conscious travelers, featuring comfortable bunk beds, shared facilities, and a lively atmosphere. Ideal for friends or solo travelers looking to meet new people while enjoying their stay.</p>
                                <label for="bigRoomSelection" class="form-label room">Number of Dorm Type Rooms</label>
                                <select class="form-select" style="width: 250px;" id="bigRoomSelection" name="num_big_rooms" required>
                                    <option value="0" data-price="0">No Room</option>
                                    <option value="1" data-price="2000">1 Room - ₱2,000</option>
                                    <option value="2" data-price="4000">2 Rooms - ₱4,000</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Row 5: Payment -->
<div style="padding: 50px 25px; background-color: #fff5cc; border-radius: 30px; margin-bottom: 50px;">
<h4>Payment</h4>
<div id="total-price-container" style="padding: 10px 0px; background-color: #fff5cc; border-radius: 30px; margin-bottom: 50px;">
    <p>Total Payment: <span id="total-price">0</span> Pesos</p>
    <input type="hidden" id="totalPriceInput" name="total_price"> <!-- Updated name -->
    <p>Downpayment (30%): <span id="downpayment-price">0</span> Pesos</p>
    <input type="hidden" id="downpaymentPriceInput" name="downpayment_price"> <!-- Hidden input for downpayment -->
</div>

    <div class="row">
        <div class="col-md-12">
            <label for="paymentScreenshot" class="form-label">Payment Screenshot</label>
            <input type="file" class="form-control" id="paymentScreenshot" name="payment_screenshot" required>
        </div>
    </div>

    <!-- Preview Section -->
    <div id="preview-container" class="row mt-5 mb-3" style="display: none;">
        <div class="col-md-12">
            <h4>Payment Screenshot Preview</h4>
            <img id="paymentScreenshotPreview" src="" alt="Payment Screenshot Preview" style="max-width: 50%; height: auto;" />
        </div>
    </div>
</div>


                    <!-- Submit Button -->
                    <button type="submit" class="btn" style="color: black !important; background: linear-gradient(90deg, rgba(253,211,27,1) 0%, rgba(237,70,7,1) 100%); border: none !important; width: 100%;">Submit Booking</button>
                </div>
            </div>
        </div>
    </form>
</section>







<!-- Footer -->
<footer class="footer" style="width: 100%; padding: 50px 25px;">
    <div class="container text-center">
        <!-- <div class="social-icons">
            <a href="" target="_blank" class="social-icon">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="" target="_blank" class="social-icon">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="" target="_blank" class="social-icon">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="" target="_blank" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div> -->
        <p class="mt-3">© 2024 OHANA Private Resort. All rights reserved.</p>
    </div>
</footer>
























            <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
                <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.min.js"></script>


                <script>
// Assuming you have a way to determine the number of days (e.g., from your calendar selection)
let daysCount = 1; // Initialize with default value, update this based on your date selection logic

function calculateTotalPrice() {
    // Get the selected time option and its price
    const timeSelect = document.getElementById('time_selection');
    const timePrice = parseInt(timeSelect.options[timeSelect.selectedIndex].getAttribute('data-price')) || 0;

    // Get the selected options and their data-price attributes
    const smallRoomSelect = document.getElementById('smallRoomSelection');
    const smallRoomPrice = parseInt(smallRoomSelect.options[smallRoomSelect.selectedIndex].getAttribute('data-price')) || 0;

    const bigRoomSelect = document.getElementById('bigRoomSelection');
    const bigRoomPrice = parseInt(bigRoomSelect.options[bigRoomSelect.selectedIndex].getAttribute('data-price')) || 0;

    // Get the multiple days total price
    const multipleDaysTotalPrice = parseInt(document.getElementById('multipleDaysTotalPriceInput').value) || 0;

    // Calculate total room price for multiple days
    const totalRoomPrice = (smallRoomPrice + bigRoomPrice) * daysCount;

    // Determine whether to use the multiple days total price or the individual prices
    const totalPrice = multipleDaysTotalPrice > 0 ? (multipleDaysTotalPrice + totalRoomPrice) : (timePrice + smallRoomPrice + bigRoomPrice);

    // Calculate downpayment as 30% of the total price
    const downpayment = totalPrice * 0.30;

    // Debugging: Check calculated values
    console.log('timePrice:', timePrice);
    console.log('smallRoomPrice:', smallRoomPrice);
    console.log('bigRoomPrice:', bigRoomPrice);
    console.log('totalRoomPrice:', totalRoomPrice);
    console.log('multipleDaysTotalPrice:', multipleDaysTotalPrice);
    console.log('totalPrice:', totalPrice);
    console.log('downpayment:', downpayment);

    // Update the total price display and hidden input field
    document.getElementById('total-price').innerText = totalPrice.toLocaleString();
    document.getElementById('totalPriceInput').value = totalPrice;

    // Update the downpayment display and hidden input field
    document.getElementById('downpayment-price').innerText = downpayment.toLocaleString();
    document.getElementById('downpaymentPriceInput').value = downpayment;

    // Set the multiple days total price input value for the database
    document.getElementById('multipleDaysTotalPriceInput').value = totalRoomPrice; // Updated to totalRoomPrice if multiple days
}

// Function to reset the total price when reselecting days
function resetTotalPrice() {
    // Reset the multiple days total price input
    document.getElementById('multipleDaysTotalPriceInput').value = 0;

    // Recalculate total price
    calculateTotalPrice();
}

// Update daysCount based on your date selection logic
function updateDaysCount(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    daysCount = Math.ceil((end - start) / (1000 * 60 * 60 * 24)); // Calculate number of days
    resetTotalPrice(); // Recalculate total price
}

// Add event listeners to recalculate the total price and downpayment when selections change
document.getElementById('time_selection').addEventListener('change', calculateTotalPrice);
document.getElementById('smallRoomSelection').addEventListener('change', calculateTotalPrice);
document.getElementById('bigRoomSelection').addEventListener('change', calculateTotalPrice);

</script>


<script>
    document.getElementById('paymentScreenshot').addEventListener('change', function(event) {
        var file = event.target.files[0];
        var previewContainer = document.getElementById('preview-container');
        var previewImage = document.getElementById('paymentScreenshotPreview');

        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });
</script>




            
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        let selectedEvent = null; // To keep track of the currently selected event

        // Fetch reserved days from the database
        async function fetchReservedDays() {
            const response = await fetch('fetch_reserved.php');
            const data = await response.json();

            // Convert database data into FullCalendar event format
            return data.map(reservation => ({
                title: reservation.time_selection,
                start: reservation.checkin_date,
                end: new Date(reservation.checkout_date).setDate(new Date(reservation.checkout_date).getDate()), // Add one day
                backgroundColor: 'lightblue',
                borderColor: 'lightblue',
                overlap: false
            }));
        }

        // Initialize FullCalendar
        const calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            headerToolbar: {
                right: 'prev,next today',
                left: 'title',
            },
            initialView: 'dayGridMonth',
            selectable: true,
            events: async function(fetchInfo, successCallback, failureCallback) {
                try {
                    const events = await fetchReservedDays();
                    successCallback(events);
                } catch (error) {
                    failureCallback(error);
                }
            },
            eventContent: function(arg) {
    let eventTitle = document.createElement('div');

    // Check if the event spans multiple days
    if (arg.event.end && arg.event.start) {
        const startDate = new Date(arg.event.start);
        const endDate = new Date(arg.event.end);
        const duration = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)); // Calculate duration in days

        // If more than one day is reserved, set the text to "Reserved"
        if (duration > 1) {
            eventTitle.textContent = "Reserved";
        } else {
            eventTitle.textContent = arg.event.title; // Otherwise, use the event's title
        }
    } else {
        eventTitle.textContent = arg.event.title; // Fallback if no dates are available
    }

    eventTitle.style.color = 'black';
    eventTitle.style.padding = '5px';
    eventTitle.style.backgroundColor = 'orange';
    eventTitle.style.borderRadius = '4px';

    return { domNodes: [eventTitle] };
},
            select: function(info) {
                // Remove the previously selected event if it exists
                if (selectedEvent) {
                    calendar.getEventById(selectedEvent.id).remove();
                }

                // Clear previous check-in and check-out values
                document.getElementById('checkin_date').value = '';
                document.getElementById('checkout_date').value = '';

                const checkInDate = info.startStr;
                const checkOutDate = info.endStr; // This represents the day after the last selected date

                // Reset total price when reselecting dates
                resetTotalPrice(); // Call to reset the total price

                // Determine if it's a single-day or multiple-day selection
                if (info.endStr === info.startStr) {
                    // Single-day selection
                    selectedEvent = calendar.addEvent({
                        title: 'Selected',
                        start: checkInDate,
                        end: checkOutDate,
                        backgroundColor: 'orange',
                        borderColor: 'orange',
                        display: 'background',
                        id: 'selectedEvent'
                    });

                    // Update fields for a single-day stay
                    document.getElementById('checkin_date').value = checkInDate;
                    document.getElementById('checkout_date').value = checkInDate; // Same day for check-out
                } else {
                    // Multiple-day selection
                    selectedEvent = calendar.addEvent({
                        title: 'Selected',
                        start: checkInDate,
                        end: info.endStr, // Keep the end date as selected
                        backgroundColor: 'orange',
                        borderColor: 'orange',
                        display: 'background',
                        id: 'selectedEvent'
                    });

                    // Update fields for a multi-day stay
                    document.getElementById('checkin_date').value = checkInDate;

                    // Adjust checkout date to reflect the last selected day correctly
                    const adjustedCheckOutDate = new Date(info.end);
                    adjustedCheckOutDate.setDate(adjustedCheckOutDate.getDate());
                    document.getElementById('checkout_date').value = adjustedCheckOutDate.toISOString().split('T')[0]; // Format to YYYY-MM-DD
                }

                // Check if multiple days are selected
                var start = new Date(info.startStr);
                var end = new Date(info.endStr);
                var isMultipleDays = (end - start) > 86400000; // More than 1 day in milliseconds

                if (isMultipleDays) {
                    document.getElementById('timeSelectionDiv').style.display = 'none'; // Hide time selection
                    document.getElementById('total-price-container').style.display = 'block'; // Show multiple days price

                    // Calculate total days and price (adjust the price per day as needed)
                    var daysCount = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
                    var pricePerDay = 15000; // Example price per day for one-day booking
                    var totalPrice = daysCount * pricePerDay;

                    // Apply a flat discount of ₱5000 if booking is for more than one day
                    if (daysCount > 1) {
                        var discount = 5000; // Flat discount for multiple days
                        totalPrice -= discount; // Subtract the discount from the total price
                    }

                    // Display the total price
                    console.log(totalPrice);
                    document.getElementById('multiple-days-total-price').textContent = "₱" + totalPrice;
                    document.getElementById('multipleDaysTotalPriceInput').value = totalPrice;
                } else {
                    document.getElementById('timeSelectionDiv').style.display = 'block'; // Show time selection
                    document.getElementById('total-price-container').style.display = 'none'; // Hide multiple days price
                }

                calendar.unselect(); // Unselect the current selection
            }
        });

        // Render the calendar
        calendar.render();
    });

    // Function to reset the total price when reselecting days
function resetTotalPrice() {
    // Reset the multiple days total price input
    document.getElementById('multipleDaysTotalPriceInput').value = 0;

    // Reset room selections
    document.getElementById('smallRoomSelection').value = ''; 
    document.getElementById('bigRoomSelection').value = ''; 

    // Reset total price and downpayment input fields
    document.getElementById('totalPriceInput').value = 0;
    document.getElementById('downpaymentPriceInput').value = 0;

    // Reset displayed values in the total price container
    document.getElementById('total-price').textContent = "0"; // Reset total payment display
    document.getElementById('downpayment-price').textContent = "0"; // Reset downpayment display

}

        // Recalculate total price
        calculateTotalPrice();
    
            </script>



</body>
</html>