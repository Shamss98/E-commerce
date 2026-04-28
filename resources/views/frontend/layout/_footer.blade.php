<footer class="bg-dark text-light mt-5">

  <div class="container py-5">

    <div class="row">

      <!-- About -->
      <div class="col-lg-5 col-md-6 mb-4" data-aos="fade-right" data-duration="2500">
        <h5 class="fw-bold mb-3">Shams-Store</h5>
        <p class="text-secondary">
          Your one-stop shop for the best products online. Quality, speed, and trust in one place.
        </p>
      </div>

      <!-- Quick Links -->
      <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-duration="2500">
        <h6 class="fw-bold mb-3">Quick Links</h6>
        <ul class="list-unstyled">
          <li><a href="{{ url('/') }}" class="text-secondary text-decoration-none">Home</a></li>
          <li><a href="#" class="text-secondary text-decoration-none">Products</a></li>
          <li><a href="#" class="text-secondary text-decoration-none">Cart</a></li>
          <li><a href="#" class="text-secondary text-decoration-none">Contact</a></li>
        </ul>
      </div>

      <!-- Account -->
      <div class="col-lg-2 col-md-6 mb-4" data-aos="fade-up" data-duration="2500">
        <h6 class="fw-bold mb-3">Account</h6>
        <ul class="list-unstyled">
          @guest
            <li><a href="{{ route('login') }}" class="text-secondary text-decoration-none">Login</a></li>
            <li><a href="{{ route('register') }}" class="text-secondary text-decoration-none">Register</a></li>
          @endguest

          @auth
            <li class="text-secondary">{{ auth()->user()->name }}</li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-link link-secondary p-0 text-decoration-none border-0">
                  Logout
                </button>
              </form>
            </li>
          @endauth
        </ul>
      </div>

      <!-- Contact -->
      <div class="col-lg-2 col-md-6 mb-4" data-aos="fade-left" data-duration="2500">
        <h6 class="fw-bold mb-3">Contact</h6>
        <p class="text-secondary mb-1">Egypt, Cairo</p>
        <p class="text-secondary mb-1">support@shams-store.com</p>
        <p class="text-secondary">+20 000 000 000</p>
      </div>

    </div>

  </div>

  <!-- Bottom bar -->
  <div class="bg-black text-center py-3">
    <small class="text-secondary">
      © {{ date('Y') }} Shams-Store. All rights reserved.
    </small>
  </div>

</footer>
