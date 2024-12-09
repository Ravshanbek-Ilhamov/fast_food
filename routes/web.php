<?php

use App\Http\Controllers\CartController;
use App\Livewire\CartComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\FoodComponent;
use App\Livewire\OrdersComponent;
use App\Livewire\UserPageComponent;
use App\Models\Food;
use Illuminate\Support\Facades\Route;

Route::get('/',CategoryComponent::class);
Route::get('/foods',FoodComponent::class);

Route::get('/user-page',UserPageComponent::class);

Route::get('/foods-in-cart',CartComponent::class);
Route::get('/orders',OrdersComponent::class);