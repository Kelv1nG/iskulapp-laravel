<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Iskulapp</title>
    <style>
        :root {
            --primary-color: #f2f6fb;
        }

        html {
            scroll-behavior: smooth;
        }

        .landingText {
            overflow: hidden;
            /* Ensures the content is not revealed until the animation */
            white-space: nowrap;
            /* Keeps the content on a single line */
            margin: 0 auto;
            /* Gives that scrolling effect as the typing happens */
            /* letter-spacing: .15em; Adjust as needed */
            animation:
                typing 3.5s steps(40, end),
                blink-caret 1s step-end infinite;
        }

        @keyframes blink-caret {

            from,
            to {
                border-color: transparent
            }

            50% {
                border-color: blue;
            }
        }

        @keyframes typing {
            from {
                width: 0
            }

            to {
                width: 100%
            }
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

<body class="bg-white min-h-screen flex flex-col justify-between">

    @include('landing.navbar')

    <!-- Homepage Section -->
    @include('landing.home')
    <section class="w-full">
        <img src="./images/wave.svg" alt="wave" class="" />
    </section>

    <div id="features"></div>

    <!-- Image Carousel Container -->
    @include('landing.features')

    <!-- contact section -->
    <section class="w-full">
        <img src="./images/wave2.svg" alt="wave" />
    </section>
    @include('landing.about')


    <section class="w-full">
        <img src="./images/wave.svg" alt="wave" class="" />
    </section>
    <div id="faqs"></div>
    @include('landing.faqs')

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
        title: `<h2 class="text-2xl font-extrabold text-blue-800 mt-2">Interested?</h2>`,
        html: `
            <div class="flex items-start space-x-4">
                <div>
                    <p class="text-center mb-1 text-gray-700 mb-2">Fill out the form and our team will be in touch.</p>
                    <form id="bookingForm" class="space-y-2 text-left">
                        <div class="mb-4">
                            <label for="Name" class="block text-gray-700 text-sm">Name</label>
                            <input type="text" id="Name" name="Name" required class="mt-1 block w-full border border-2 border-blue-900 rounded-md p-2 focus:ring focus:ring-blue-500"/>
                        </div>
                        <div class="mb-4">
                            <label for="SchoolName" class="block text-gray-700 text-sm">School Name</label>
                            <input type="text" id="SchoolName" name="SchoolName" required class="mt-1 block w-full border border-2 border-blue-900 rounded-md p-2 focus:ring focus:ring-blue-500"/>
                        </div>
                        <div class="mb-4">
                            <label for="ContactNo" class="block text-gray-700 text-sm">Contact No.</label>
                            <input type="text" id="ContactNo" name="ContactNo" required class="mt-1 block w-full border border-2 border-blue-900 rounded-md p-2 focus:ring focus:ring-blue-500"/>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm">Email Address</label>
                            <input type="email" id="email" name="email" required class="mt-1 block w-full border border-2 border-blue-900 rounded-md p-2 focus:ring focus:ring-blue-500"/>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 text-sm">Type your message below</label>
                            <textarea id="message" name="message" required class="mt-1 block w-full border border-2 border-blue-900 rounded-md p-2 focus:ring focus:ring-blue-500"></textarea>
                        </div>
                    </form>
                    <p class="mt-5 text-sm text-start">By submitting this form you agree that iskulapp will process your personal data. For more information on your rights and data processing, please read our <u>Privacy Policy.</u></p>
                </div>
            </div>
        `,
        focusConfirm: false,
        showCloseButton: true,
        customClass: {
            popup: "p-2 bg-blue-white flex flex-col shadow-lg rounded-md",
            title: "text-lg font-semibold text-gray-800",
            confirmButton: "bg-blue-600 hover:bg-blue-700 text-white text-sm w-full rounded-sm mt-1 mb-7",
        },
        confirmButtonText: "Send Message",
        preConfirm: () => {
            const name = document.getElementById("Name").value;
            const schoolName = document.getElementById("SchoolName").value;
            const contactNo = document.getElementById("ContactNo").value;
            const email = document.getElementById("email").value;
            const message = document.getElementById("message").value;

            if (!name || !schoolName || !contactNo || !email || !message) {
                Swal.showValidationMessage("Please fill out all fields!");
            }

            return { name, schoolName, contactNo, email, message };
        },
    }).then((result) => {
        if (result.isConfirmed) {
            const { name, schoolName, contactNo, email, message } = result.value;

            fetch('/save-inquiry', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    name,
                    school_name: schoolName,
                    contact_no: contactNo,
                    email,
                    message,
                })
            })
                .then(response => response.json())
                .then(data => {
                    Swal.fire('Success!', data.message, 'success');
                })
                .catch(error => {
                    Swal.fire('Error!', 'Something went wrong. Please try again.', 'error');
                });
        }
    });
}

    </script>
</body>

</html>
