<div>

  <!-- ======= Menu Section ======= -->
  <section id="menu" class="menu section-bg">
  <div class="container">

      <div class="section-title">
      <h2>Menu</h2>
      <p>Check Our Tasty Menu</p>
      <a href="/login" wire:navigate class="nav-link"> Go To Admin Page</a>
      <a href="/" wire:navigate class="nav-link">Back To All Orders</a>
      <a href="/foods-in-cart" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
          </svg>
          {{-- <span class="cart-count">{{$foodCount}}</span> --}}
      </a>
      </div>
            <div class="row">
                <!-- In Progress -->
                <div class="col-4">
                    <div class="status-section">
                        <h5 class="text-center">In Progress
                          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-activity ms-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2"/>
                          </svg>
                        </h5>
                        <ul class="menu-flters d-flex flex-column justify-content-center mb-0 pb-0 pt-4" id="menu-flters">
                            @foreach($orders->where('status', 'in_progress') as $order)
                            <div class="col-lg-12 menu-item">
                              <img src="{{ asset('storage/foods/6QBMq33ByHhOb3m8ccyOHWqefz0iUtJi0ZuKVXYC.pnj' ) }}" class="menu-img" alt="food-image">
                              <div class="menu-content">
                                  <a href="#"> Order{{ $order->queue }}</a>
                                  <span>
                                          <!-- Cart Icon -->
                                          <a href="#" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-activity" viewBox="0 0 16 16">
                                              <path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2"/>
                                            </svg>
                                          </a>
                                      {{-- @endif --}}
                                  </span>
                              </div>
                              <div class="menu-ingredients">In Progress
                                  {{-- ${{ $order-> }} --}}
                              </div>
                          </div>
                                {{-- <li>{{ $order->name }}</li> <!-- Replace 'name' with the actual column you want to display --> --}}
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                <!-- Done -->
                <div class="col-4">
                    <div class="status-section">
                        <h5 class="text-center">Done
                          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-check2-circle ms-2" viewBox="0 0 16 16">
                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                          </svg>
                        </h5>
                        <ul class="menu-flters d-flex flex-column justify-content-center mb-0 pb-0 pt-4" id="menu-flters">
                            @foreach($orders->where('status', 'done') as $order)
                            <div class="col-lg-12 menu-item">
                              <img src="{{ asset('storage/foods/6QBMq33ByHhOb3m8ccyOHWqefz0iUtJi0ZuKVXYC.pnj' ) }}" class="menu-img" alt="food-image">
                              <div class="menu-content">
                                  <a href="#">Order {{ $order->queue }}</a>
                                  <span>
                                          <!-- Cart Icon -->
                                          <a href="#" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                              <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                              <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                            </svg>
                                          </a>
                                      {{-- @endif --}}
                                  </span>
                              </div>
                              <div class="menu-ingredients">Almost Done
                                  {{-- ${{ $order-> }} --}}
                              </div>
                          </div>
                                {{-- <li>{{ $order->name }}</li> --}}
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                <!-- In Hand -->
                <div class="col-4">
                    <div class="status-section justify-content-center ">
                        <h5 class="text-center">In Hand 
                          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-list-check ms-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                          </svg>
                        </h5>
                        <ul class="menu-flters d-flex flex-column justify-content-center mb-0 pb-0 pt-4" id="menu-flters">
                            @foreach($orders->where('status', 'in_hand') as $order)
                            <div class="col-lg-12 menu-item">
                              <img src="{{ asset('storage/foods/6QBMq33ByHhOb3m8ccyOHWqefz0iUtJi0ZuKVXYC.pnj' ) }}" class="menu-img" alt="food-image">
                              <div class="menu-content">
                                  <a href="#">Order {{ $order->queue }}</a>
                                  <span>
                                          <!-- Cart Icon -->
                                          <a href="#" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
                                              <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                                            </svg>
                                          </a>
                                  </span>
                              </div>
                              <div class="menu-ingredients">In Hands
                                  {{-- ${{ $order-> }} --}}
                              </div>
                          </div>
                            
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
      </div>
</div>
