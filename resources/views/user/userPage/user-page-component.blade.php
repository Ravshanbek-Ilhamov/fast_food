<div>

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu section-bg">
    <div class="container">

        <div class="section-title">
        <h2>Menu</h2>
        <p>Check Our Tasty Menu</p>
        <a href="/" wire:navigate class="nav-link"> Go To Admin Page</a>
        <a href="/foods-in-cart" class="nav-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
            </svg>
            <span class="cart-count">{{$foodCount}}</span>
        </a>
        </div>
        
        <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
            <ul id="menu-flters">
                <li wire:click="$set('filtercategory_id', '')" class="filter-active">All</li>
                @foreach ($categories as $category)
                    <li wire:click="filterCategory({{$category->id}})">{{ $category->name }}</li>
                @endforeach
            </ul>
        </div>
        </div>

        <div class="row menu-container">
            @if ($foods->isEmpty())
            <div class="col-lg-12">
                <div class="content text-center mt-5 mb-5 pb-5 ">

                <h4 class="text-center">No food found</h4>

                </div>
            </div>
            @else
            @foreach ($foods as $food)
                <div class="col-lg-6 menu-item">
                    <img src="{{ asset('storage/' . $food->image_path) }}" class="menu-img" alt="food-image">
                    <div class="menu-content">
                        <a href="#">{{ $food->name }}</a>
                        <span>
                            @if (session('foods') && collect(session('foods'))->contains('id', $food->id))
                                <!-- Checked Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8a8 8 0 1 1-16 0 8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.08.02l3.992-4.99a.75.75 0 1 0-1.15-.96L7.475 9.58 5.65 7.796a.75.75 0 1 0-1.1 1.02l2.42 2.215z"/>
                                </svg>
                            @else
                                <!-- Cart Icon -->
                                <a href="#" wire:click="addToCart('{{ $food->id }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-basket3-fill" viewBox="0 0 16 16">
                                        <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                                    </svg>
                                </a>
                            @endif
                        </span>
                    </div>
                    <div class="menu-ingredients">
                        ${{ $food->price }}
                    </div>
                </div>
            @endforeach
            @endif
        </div>
</div>
