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
      confirmButton:
        "bg-blue-600 hover:bg-blue-700 text-white text-sm w-full rounded-sm mt-1 mb-7 w-full ",
    },
    confirmButtonText: "Confirm Booking",
    didOpen: () => {
      flatpickr("#selectDate", { minDate: "today", dateFormat: "Y-m-d" });
      flatpickr("#selectTime", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
      });
    },
    preConfirm: () => {
      const fullName = document.getElementById("fullName").value;
      const email = document.getElementById("email").value;
      const schoolName = document.getElementById("schoolName").value;
      const selectTime = document.getElementById("selectTime").value;
      const selectDate = document.getElementById("selectDate").value;

      if (
        !fullName ||
        !email ||
        !schoolName ||
        !selectTime ||
        !selectDate
      ) {
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
