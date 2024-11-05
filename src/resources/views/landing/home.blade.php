
    <!-- Homepage Section -->
    <section
      class="w-full bg-opacity-20 grid grid-cols-1 md:grid-cols-12 gap-8 p-8"
      style="background-color: var(--primary-color)"
    >
      <!-- Image Column (hidden on small screens) -->
      <div
        class="col-span-5 hidden md:flex lg:px-10 md:justify-end"
        data-aos="fade-up"
      >
        <img
          src="./images/Rectangle.png"
          alt="app mockup"
          class="h-auto max-w-full"
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