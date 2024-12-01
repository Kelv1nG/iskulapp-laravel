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

        .nav-link {
            color: black;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .nav-link:hover{
            color: #1A237E;
        }

        .nav-link.active {
            color: blue;
            font-weight: bold;
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
    <div id="about"></div>
    @include('landing.about')
    <section class="w-full">
        <img src="./images/wave.svg" alt="wave" class="" />
    </section>


    <div id="faqs"></div>
    @include('landing.faqs')

    @include('landing.footer')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src=" {{ asset('js/landingpage/landingscript.js') }}"></script>

    <script src=" {{ asset('js/landingpage/navbarscript.js') }}"></script>

</body>

</html>
