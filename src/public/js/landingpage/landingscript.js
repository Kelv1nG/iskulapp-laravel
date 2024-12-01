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

document.addEventListener("DOMContentLoaded", () => {
const navLinks = document.querySelectorAll(".nav-link");
const sections = Array.from(navLinks).map(link =>
document.querySelector(`#${link.dataset.section}`)
);

const highlightActiveLink = () => {
let scrollPosition = window.scrollY + window.innerHeight / 2; 

sections.forEach((section, index) => {
const sectionTop = section.offsetTop;
const sectionBottom = sectionTop + section.offsetHeight;

if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
navLinks.forEach(link => link.classList.remove("border-b-2", "border-blue-500", "text-blue-800", "font-bold"));
navLinks[index].classList.add("border-b-2", "border-blue-500", "text-blue-800", "font-bold");
}
});
};

window.addEventListener("scroll", highlightActiveLink);
highlightActiveLink(); // Highlight on page load
});