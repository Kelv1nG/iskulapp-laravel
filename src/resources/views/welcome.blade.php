<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iskulapp</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-color: #f2f6fb;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@10/swiper-bundle.min.css" />
    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>

    <!-- SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- swiper css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Flatpickr CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
@section('content')

    <body class="bg-white min-h-screen flex flex-col justify-between">
        @include('landing.navbar')
        @include('landing.home')
        <section class="w-full">
            <img src="/iskulapp Logo/wave.svg" alt="wave" class="" />
        </section>

        <div id="features"></div>

        <!-- Image Carousel Container -->
        @include('landing.features')

        <!-- contact section -->
        <section class="w-full">
            <img src="/iskulapp Logo/wave2.svg" alt="wave" />
        </section>

        <div id="contact"></div>
        @include('landing.contact')

        @include('landing.footer')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <script>
            // Initialize AOS
            AOS.init();

            // Mobile menu toggle
            const menuBtn = document.getElementById("menu-btn");
            const mobileMenu = document.getElementById("mobile-menu");

            menuBtn.addEventListener("click", () => {
                mobileMenu.classList.toggle("hidden");
            });

            const swiper = new Swiper(".swiper", {
                direction: "horizontal",
                speed: 400,
                spacebetween: 10,
                rewind: true,
                allowSlidePrev: true,
                allowSlideNext: true,
                autoHeight: true,
                grabCursor: true,
                // parallax:true,
                autoplay: {
                    delay: 5000,
                },

                // If we need pagination
                pagination: {
                    el: ".swiper-pagination",
                },

                // Navigation arrows
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },

                // And if we need scrollbar
                scrollbar: {
                    el: ".swiper-scrollbar",
                },
            });

            function openBookingModal() {
                Swal.fire({
                    title: `<h2 class="text-2xl font-extrabold text-blue-800 mt-2">Book a Demo</h2>`,
                    html: `
      <div class="flex items-start space-x-4">
  <div>
    <p class="text-center mb-1 text-gray-700 mb-2">Fill out the form and our team will be in touch.</p>
    <form id="bookingForm" class="space-y-2 text-left">
      <div class="mb-4">
        <label for="FullName" class="block text-gray-700 text-sm">Full Name</label>
        <input type="text" id="FullName" name="FullName" required class="mt-1 block w-full border border-2 border-blue-900 rounded-md p-2 focus:ring focus:ring-blue-500"/>
      </div>
      <div class="mb-4">
        <label for="email" class="block text-gray-700 text-sm">Email</label>
        <input type="email" id="email" name="email" required class="mt-1 block w-full border-2 border-blue-900 rounded-md p-2 focus:ring focus:ring-blue-500"/>
      </div>
      <div class="flex mb-4 space-x-4"> <!-- Flex container for time and date inputs -->
        <div class="flex-1">
          <label for="selectTime" class="block text-gray-700 text-sm">Select Time</label>
          <input type="time" id="selectTime" name="Time" required class="mt-1 block w-full border border-2 border-blue-900 rounded-md p-2 focus:ring focus:ring-blue-500"/>
        </div>
        <div class="flex-1">
          <label for="selectDate" class="block text-gray-700 text-sm">Select Date</label>
          <input type="date" id="selectDate" name="Time" required class="mt-1 block w-full border border-2 border-blue-900 rounded-md p-2 focus:ring focus:ring-blue-500"/>
        </div>
      </div>
      <div class="mb-4">
        <label for="SchoolName" class="block text-gray-700 text-sm">School Name</label>
        <input type="text" id="SchoolName" name="SchoolName" required class="mt-1 block w-full border border-2 border-blue-900 rounded-md p-2 focus:ring focus:ring-blue-500"/>
      </div>
    </form>
    <p class="mt-5 text-sm text-start"> By submitting this form you agree that iskulapp will process your personal data. For more information on your rights and data processing, please read our <u> Privacy Policy.</u> </p>
  </div>
</div>

    `,
                    focusConfirm: false,
                    showCloseButton: true,
                    customClass: {
                        popup: "p-2 bg-blue-white flex flex-col shadow-lg rounded-md",
                        title: "text-lg font-semibold text-gray-800",
                        confirmButton: "bg-blue-600 hover:bg-blue-700 text-white text-sm w-full rounded-sm mt-1 mb-7 w-full ",
                    },
                    confirmButtonText: "Confirm Booking",
                    didOpen: () => {
                        flatpickr("#selectDate", {
                            minDate: "today",
                            dateFormat: "Y-m-d"
                        });
                        flatpickr("#selectTime", {
                            enableTime: true,
                            noCalendar: true,
                            dateFormat: "H:i",
                        });
                    },
                    preConfirm: () => {
  const fullNameElement = document.getElementById("FullName");
  const emailElement = document.getElementById("email");
  const schoolNameElement = document.getElementById("SchoolName");
  const selectTimeElement = document.getElementById("selectTime");
  const selectDateElement = document.getElementById("selectDate");

  if (!fullNameElement || !emailElement || !schoolNameElement || !selectTimeElement || !selectDateElement) {
    Swal.showValidationMessage("Please fill out all fields!");
    return false; 
  }

  const fullName = fullNameElement.value;
  const email = emailElement.value;
  const schoolName = schoolNameElement.value;
  const selectTime = selectTimeElement.value;
  const selectDate = selectDateElement.value;

  if (!fullName || !email || !schoolName || !selectTime || !selectDate) {
    Swal.showValidationMessage("Please fill out all fields!");
  }

  return { fullName, email, schoolName, selectTime, selectDate };
}
,
                }).then((result) => {
                    if (result.isConfirmed) {
                        const bookingData = result.value;
                        fetch('/booking', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content'),
                                },
                                body: JSON.stringify(bookingData),
                            })
                            .then((response) => response.json())
                            .then((data) => {
                                if (data.message) {
                                    Swal.fire('Success', data.message, 'success');
                                }
                            })
                            .catch((error) => {
                                Swal.fire('Error', 'Failed to submit booking. Please try again.', 'error');
                                console.error('Error:', error);
                            });
                    }
                });

            }
        </script>
    </body>
@endsection

</html>
