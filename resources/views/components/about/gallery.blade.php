<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galerie Défilante</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    /* Custom CSS for the sliding effect */
    .carousel-item {
      min-width: 100%;
      transition: transform 0.5s ease-in-out;
    }
  </style>
</head>
<body class="bg-gray-100">

<!-- Masonry Cards -->
<div class="max-w-6xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Grid for larger screens -->
  <div class="hidden sm:grid sm:grid-cols-12 gap-6">
    <!-- Card 1 -->
    <div class="sm:self-end col-span-12 sm:col-span-7 md:col-span-8 lg:col-span-5 lg:col-start-3">
      <a class="group relative block rounded-xl overflow-hidden" href="#">
        <div class="aspect-w-12 aspect-h-7 sm:aspect-none rounded-xl overflow-hidden">
          <img class="group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl w-full object-cover" src="{{ asset('storage/picture/FredhouseDurbuy-11.jpg') }}" alt="Image Description">
        </div>
      </a>
    </div>
    <!-- Card 2 -->
    <div class="sm:self-end col-span-12 sm:col-span-5 md:col-span-4 lg:col-span-3">
      <a class="group relative block rounded-xl overflow-hidden" href="#">
        <div class="aspect-w-12 aspect-h-7 sm:aspect-none rounded-xl overflow-hidden">
          <img class="group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl w-full object-cover" src="{{ asset('storage/picture/FredhouseDurbuy-5.jpg') }}" alt="Image Description">
        </div>
      </a>
    </div>
    <!-- Card 3 -->
    <div class="col-span-12 md:col-span-4">
      <a class="group relative block rounded-xl overflow-hidden" href="#">
        <div class="aspect-w-12 aspect-h-7 sm:aspect-none rounded-xl overflow-hidden">
          <img class="group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl w-full object-cover" src="{{ asset('storage/picture/FredhouseDurbuy-13.jpg') }}" alt="Image Description">
        </div>
      </a>
    </div>
    <!-- Card 4 -->
    <div class="col-span-12 sm:col-span-6 md:col-span-4">
      <a class="group relative block rounded-xl overflow-hidden" href="#">
        <div class="aspect-w-12 aspect-h-7 sm:aspect-none rounded-xl overflow-hidden">
          <img class="group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl w-full object-cover" src="{{ asset('storage/picture/FredhouseDurbuy-8.jpg') }}" alt="Image Description">
        </div>
      </a>
    </div>
    <!-- Card 5 -->
    <div class="col-span-12 sm:col-span-6 md:col-span-4">
      <a class="group relative block rounded-xl overflow-hidden" href="#">
        <div class="aspect-w-12 aspect-h-7 sm:aspect-none rounded-xl overflow-hidden">
          <img class="group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl w-full object-cover" src="{{ asset('storage/picture/FredhouseDurbuy-7.jpg') }}" alt="Image Description">
        </div>
      </a>
    </div>
  </div>
  <!-- End Grid -->

  <!-- Carousel for mobile screens -->
  <div class="sm:hidden relative w-full max-w-md mx-auto overflow-hidden">
    <div class="flex transition-transform duration-500 ease-in-out" id="carousel">
      <!-- Slide 1 -->
      <div class="carousel-item flex justify-center items-center">
        <img class="w-full h-full object-contain" src="{{ asset('storage/picture/FredhouseDurbuy-11.jpg') }}" alt="Image Description">
      </div>
      <!-- Slide 2 -->
      <div class="carousel-item flex justify-center items-center">
        <img class="w-full h-full object-contain" src="{{ asset('storage/picture/FredhouseDurbuy-5.jpg') }}" alt="Image Description">
      </div>
      <!-- Slide 3 -->
      <div class="carousel-item flex justify-center items-center">
        <img class="w-full h-full object-contain" src="{{ asset('storage/picture/FredhouseDurbuy-13.jpg') }}" alt="Image Description">
      </div>
      <!-- Slide 4 -->
      <div class="carousel-item flex justify-center items-center">
        <img class="w-full h-full object-contain" src="{{ asset('storage/picture/FredhouseDurbuy-8.jpg') }}" alt="Image Description">
      </div>
      <!-- Slide 5 -->
      <div class="carousel-item flex justify-center items-center">
        <img class="w-full h-full object-contain" src="{{ asset('storage/picture/FredhouseDurbuy-7.jpg') }}" alt="Image Description">
      </div>
    </div>
    <!-- Navigation Arrows -->
    <button class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-2 py-1 rounded" id="prev">‹</button>
    <button class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-2 py-1 rounded" id="next">›</button>
  </div>
  <!-- End Carousel -->
</div>
<!-- End Masonry Cards -->

<script>
  // JavaScript for the sliding effect
  let currentIndex = 0;
  const slides = document.querySelectorAll('.carousel-item');
  const totalSlides = slides.length;

  function showSlide(index) {
    const carousel = document.getElementById('carousel');
    carousel.style.transform = `translateX(-${index * 100}%)`;
  }

  function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    showSlide(currentIndex);
  }

  function prevSlide() {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    showSlide(currentIndex);
  }

  document.getElementById('next').addEventListener('click', nextSlide);
  document.getElementById('prev').addEventListener('click', prevSlide);

  setInterval(nextSlide, 3000); // Change slide every 3 seconds
</script>

</body>
</html>
