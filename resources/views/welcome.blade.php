
@extends('layouts.guest')
@section('content')        
            1<img src="{{ asset('assets/user/images/hero.jpg') }}" alt="card"/>
            <section class="shop-section">
              <div class="shop-images">
                <div class="shop-link">
                  <h3>Laptops</h3>
                  <img src="{{ asset('assets/user/images/img-1.png') }}" alt="card">
                  <a href="#">Shop now</a>
                </div>
                <div class="shop-link">
                  <h3>Smart Watches</h3>
                  <img src="{{ asset('assets/user/images/img-2.png') }}" alt="card">
                  <a href="#">Shop now</a>
                </div>
                <div class="shop-link">
                  <h3>Strip Lights</h3>
                  <img src="{{ asset('assets/user/images/img-3.png') }}" alt="card">
                  <a href="#">Shop now</a>
                </div>
                <div class="shop-link">
                  <h3>Home Refresh Ideas</h3>
                  <img src="{{ asset('assets/user/images/img-4.png') }}" alt="card">
                  <a href="#">Shop now</a>
                </div>
              </div>
            </section>
         @livewireScripts
    </body>
    
</html>
@endsection