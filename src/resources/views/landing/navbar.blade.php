<nav class="bg-white p-4 sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
      <!-- Logo -->
      <a href="/" class="flex items-center">
        <img
          src="./images/iskulapp Final Logo Horizontal.png"
          alt="Iskulapp Logo"
          class="h-10 w-auto ml-5"
        />
      </a>

      <!-- Menu Button (Mobile) -->
      <button
        id="menu-btn"
        class="text-blue-700 md:hidden focus:outline-none"
      >
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
      <ul class="hidden md:flex space-x-6 mr-10">
        <li >
          <a
        href="#features"
        class=" font-semibold nav-link"
        data-section="features"
        >Features</a
      >
        </li>
       <li>
        <a
        href="#about"
        class=" font-semibold nav-link"
        data-section="about"
        >About Us</a
      >
       </li>
       <li>
        <a
        href="#faqs"
        class=" font-semibold nav-link"
        data-section="faqs"
        >Faqs</a
      >
       </li>
      </ul>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden">
      <a
      href="#features"
      class="block mt-5 py-5 rounded-sm px-2 text-blue-700 hover:bg-blue-100 font-semibold"
      >Features</a
    >
      <a
      href="#about"
      class="block mt-5 py-5 rounded-sm px-2 text-blue-700 hover:bg-blue-100 font-semibold"
      >About Us</a
    >
      <a
        href="#faqs"
        class="block py-5 px-2 rounded-sm text-blue-700 hover:bg-blue-100 font-semibold"
        >Faqs</a
      >
    </div>
  
  </nav>