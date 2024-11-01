<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Iskulapp</title>
        <style>
          :root{
            --primary-color:#F2f6fb;
          }
          html {
            scroll-behavior: smooth;
          }
          
        </style>
        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link
          rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css"
        />
        <link
          rel="stylesheet"
          href="https://unpkg.com/swiper@10/swiper-bundle.min.css"
        />
        <!-- AOS JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    
        <!-- SweetAlert2 CSS and JS -->
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"
        />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
        <!-- Flatpickr CSS and JS -->
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
        />
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
      </head>
      <body class="bg-white min-h-screen flex flex-col justify-between">
        <nav class="bg-white p-4 sticky top-0 z-50 ">
          <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="flex items-center ">
              <img
              src="{{ asset('images/iskulapp Final Logo Horizontal.png') }}" alt="Logo"
                alt="Iskulapp Logo"
                class="h-10 w-auto ml-5"
              />
            </a>
    
            <!-- Menu Button (Mobile) -->
            <button id="menu-btn" class="text-blue-700 md:hidden focus:outline-none">
              <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                ></path>
              </svg>
            </button>
    
            <!-- Links -->
            <div id="menu" class="hidden md:flex space-x-6 mr-10">
              <a href="#features" class="text-blue-700 hover:text-blue-800 font-semibold"
                >Features</a
              >
              <a href="#contact" class="text-blue-700 hover:text-blue-800 font-semibold"
                >Contact Us</a
              >
            </div>
          </div>
    
          <!-- Mobile Menu -->
          <div id="mobile-menu" class="md:hidden hidden">
            <a
              href="#features"
              class="block mt-5 py-5 rounded-sm px-2 text-blue-700 hover:bg-blue-100 font-semibold"
              >Features</a
            >
            <a
              href="#contact"
              class="block py-5 px-2 rounded-sm text-blue-700 hover:bg-blue-100 font-semibold"
              >Contact Us</a
            >
          </div>
        </nav>
    
        <!-- Homepage Section -->
        <section class="w-full bg-opacity-20  grid grid-cols-1 md:grid-cols-12 gap-8 p-8" style="background-color: var(--primary-color);">
          <!-- Image Column (hidden on small screens) -->
          <div
          class="col-span-5 hidden md:flex lg:px-10 md:justify-end"
          data-aos="fade-up"
        >
          <img
          src="{{ asset('images/Rectangle.png') }}" alt="Mockup"
            alt="app mockup"
            class="h-auto max-w-full "
          />
        </div>
        
    
          <!-- Text Column -->
          <div
            class="col-span-5 flex flex-col justify-center items-start space-y-6"
            data-aos="fade-up"
          >
            <h1
              class="text-3xl md:text-4xl font-bold text-blue-700 text-blue-900 drop-shadow-xl"
            >
              “Your School, One Tap Away”
            </h1>
            <p class="text-gray-600 text-lg leading-relaxed">
              From attendance to assignments, stay connected and organized with all
              school essentials in one simple app. Empowering students, teachers,
              and parents to engage effortlessly, anytime, anywhere.
            </p>
            <button
              onclick="openBookingModal()"
              class="bg-blue-700 text-white text-lg px-6 py-2 rounded-sm shadow-md hover:bg-blue-950 transition-colors rounded-sm shadow-lg"
            >
              Book a Demo
            </button>
          </div>
          <div class="col-span-2"></div>
        </section>
        <section class="w-full">
          <img 
          src="{{ asset('images/wave.svg') }}" alt="wave"

          alt="wave" class="">
        </section>
    
        <div id="features"></div>
    
        <!-- Image Carousel Container -->
        <section class="py-8 mt-5">
          <div class="w-full flex justify-center flex-col p-5" data-aos="fade-up">
            <h1 class="text-3xl text-center md:text-4xl font-bold text-blue-600">
              "Features Designed to Ease Work for Teachers, Students, and Parents"
            </h1>
            <p class="text-gray-600 text-lg text-center leading-relaxed mt-5">
              Our tools are designed to save time and simplify tasks, helping
              teachers teach, students learn, and parents stay informed with ease.
            </p>
          </div>
    
          <swiper-container
            class="mx-auto my-1 md:w-1/2 w-4/5"
            space-between="20"
            autoplay="{ delay: 3000, disableOnInteraction: false }"
          >
            <swiper-slide>
              <!-- Image Container with Overlay -->
              <div class="relative w-full h-50" data-aos="fade-up">
                <img
                src="{{ asset('images/SliderImage1.jpg') }}" 
                  class="w-full h-full object-cover rounded-lg"
                />
                <!-- Overlay Text -->
                <div
                  class="absolute inset-0 flex items-end justify-start bg-black bg-opacity-50 border-2 border-red"
                >
                  <h1
                    class="font-bold rounded-lg text-left text-white p-5 md:text-3xl text-xl"
                  >
                    "Get important update, real-time"
                  </h1>
                </div>
              </div>
            </swiper-slide>
    
            <swiper-slide>
              <div class="relative w-full h-50" data-aos="fade-up">
                <img
                src="{{ asset('images/SliderImage2.png') }}" 
                  alt="Slider image 2"
                  class="w-full h-full object-cover rounded-lg"
                />
                <div
                  class="absolute inset-0 flex items-end justify-start bg-black bg-opacity-50 text-white text-2xl font-bold rounded-lg"
                >
                  <h1
                    class="font-bold rounded-lg text-left text-white p-5 md:text-3xl text-xl"
                  >
                    "Check progress anywhere using only phone"
                  </h1>
                </div>
              </div>
            </swiper-slide>
    
            <swiper-slide>
              <div
                class="relative w-full h-50"
                data-aos="fade-up"
                data-aos="fade-up"
              >
                <img
                src="{{ asset('images/SliderImage3.jpg') }}" 
                  alt="Slider image 3"
                  class="w-full h-full object-cover rounded-lg"
                />
                <div
                  class="absolute inset-0 flex items-end justify-start bg-black bg-opacity-50 text-white text-2xl font-bold rounded-lg"
                >
                  <h1
                    class="font-bold rounded-lg text-left text-white p-5 md:text-3xl text-xl"
                  >
                    “Take quiz even without internet connection”
                  </h1>
                </div>
              </div>
            </swiper-slide>
    
            <swiper-slide>
              <div class="relative w-full h-50" data-aos="fade-up">
                <img
                src="{{ asset('images/SliderImage4.jpg') }}" 
                  alt="Slider image 4"
                  class="w-full h-full object-cover rounded-lg"
                />
                <div
                  class="absolute inset-0 flex items-end justify-start bg-black bg-opacity-50 text-white text-2xl font-bold rounded-lg"
                >
                  <h1
                    class="font-bold rounded-lg text-left text-white p-5 md:text-3xl text-xl"
                  >
                    “Formulate quiz using AI”
                  </h1>
                </div>
              </div>
            </swiper-slide>
          </swiper-container>
        </section>
    
    
        <!-- contact section -->
        <section class="w-full">
          <img 
          src="{{ asset('images/wave2.svg') }}" 
          alt="wave2" >
        </section>
    
        <div id="contact"></div>
        <section class="w-full bg-opacity-20 pb-10" style="background-color: var(--primary-color);">
          <div class="w-full flex justify-center flex-col p-5" data-aos="fade-up">
            <h1 class="text-3xl text-center md:text-4xl font-bold text-blue-600">
              “Single platform for all your school activities.”
            </h1>
            <p class="text-gray-600 text-lg text-center leading-relaxed mt-5">
              A safe space for your kids, no more switching platforms, all you need
              is here! Contact us for more information.
            </p>
            <div
              class="bg-white shadow-lg rounded-lg p-8 w-full max-w-lg mx-auto mt-10"
              data-aos="fade-up"
            >
              <h1 class="text-xl font-semibold text-center mb-4">Contact Us</h1>
              <p class="text-center mb-6">
                Fill out the form and our team will be in touch
              </p>
              <form>
                <div class="mb-4">
                  <label for="school-name" class="block text-gray-700"
                    >School Name</label
                  >
                  <input
                    type="text"
                    id="school-name"
                    name="school-name"
                    required
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-500"
                  />
                </div>
    
                <div class="mb-4">
                  <label for="contact-number" class="block text-gray-700"
                    >Contact Number</label
                  >
                  <input
                    type="tel"
                    id="contact-number"
                    name="contact-number"
                    required
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-500"
                  />
                </div>
    
                <div class="mb-4">
                  <label for="school-email" class="block text-gray-700"
                    >School Email</label
                  >
                  <input
                    type="email"
                    id="school-email"
                    name="school-email"
                    required
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-500"
                  />
                </div>
    
                <div class="mb-4">
                  <label for="referral" class="block text-gray-700"
                    >Where did you hear from us?</label
                  >
                  <select
                    id="referral"
                    name="referral"
                    required
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-500"
                  >
                    <option value="">Select an option</option>
                    <option value="friend">Friend</option>
                    <option value="social_media">Social Media</option>
                    <option value="advertisement">Advertisement</option>
                    <option value="search_engine">Search Engine</option>
                  </select>
                </div>
    
                <button
                  type="submit"
                  class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition-colors"
                >
                  Submit
                </button>
              </form>
            </div>
          </div>
        </section>
    
        <footer class="w-full">
          <div
            class="flex md:flex-row flex-col md:justify-between bg-blue-700 items-center"
          >
            <div class="p-10">
              <img
              src="{{ asset('images/iskulapp Final Logo Horizontal White.png') }}" 
                alt="Iskulapp Logo white"
                class="h-10 w-auto cursor-pointer"
              />
            </div>
            <div class="px-10">
              <p class="text-white cursor-pointer">
                © All rights reserved for iskulapp.ph - 2024
              </p>
            </div>
          </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
        <script>
          // Initialize AOS
          AOS.init();
    
          // Mobile menu toggle
          const menuBtn = document.getElementById("menu-btn");
          const mobileMenu = document.getElementById("mobile-menu");
    
          menuBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
          });
    
          // Swiper slider configuration
          const swiper = new Swiper(".swiper-container", {
            autoplay: {
              delay: 500,
              disableOnInteraction: false,
            },
          });
    
          // Smooth scrolling for anchor links
          document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener("click", function (e) {
              e.preventDefault();
              document.querySelector(this.getAttribute("href")).scrollIntoView({
                behavior: "smooth",
              });
            });
          });
    
          // Function to open the booking modal with Tailwind styling
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
        customClass: {
          popup: "p-2 bg-blue-white flex flex-col shadow-lg rounded-md",
          title: "text-lg font-semibold text-gray-800",
          confirmButton: "bg-blue-600 hover:bg-blue-700 text-white text-sm w-full rounded-sm mt-1 mb-7 w-full ",
        },
        confirmButtonText: "Confirm Booking",
        didOpen: () => {
          flatpickr("#selectDate", { minDate: "today", dateFormat: "Y-m-d" });
          flatpickr("#selectTime", { enableTime: true, noCalendar: true, dateFormat: "H:i" });
        },
        preConfirm: () => {
          const fullName = document.getElementById("fullName").value;
          const email = document.getElementById("email").value;
          const schoolName = document.getElementById("schoolName").value;
          const selectTime = document.getElementById("selectTime").value;
          const selectDate = document.getElementById("selectDate").value;
    
          if (!fullName || !email || !schoolName || !selectTime || !selectDate) {
            Swal.showValidationMessage("Please fill out all fields!");
          }
          return { fullName, email, schoolName, selectTime, selectDate };
        },
      }).then((result) => {
        if (result.isConfirmed) {
          console.log("Booking Details:", result.value);
          // Additional booking logic can be added here
        }
      });
    }
    
        </script>
      </body>
    </html>
    