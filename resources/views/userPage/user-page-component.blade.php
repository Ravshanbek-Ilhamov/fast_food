<div>

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu section-bg">
    <div class="container">

        <div class="section-title">
        <h2>Menu</h2>
        <p>Check Our Tasty Menu</p>
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
            @foreach ($foods as $food)
                <div class="col-lg-6 menu-item">
                    <img src="{{asset('storage/'.$food->image_path)}}" class="menu-img" alt="food-image">
                    <div class="menu-content">
                    <a href="#">{{ $food->name }}</a><span>${{ $food->price }}</span>
                    </div>
                    <div class="menu-ingredients">
                    {{-- <i class="bi bi-basket3-fill"></i> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-basket3-fill" viewBox="0 0 16 16">
                        <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                    </svg>
                    </div>
                </div>         
            @endforeach
</div>
