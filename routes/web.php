<?php

use App\Livewire\CategoryComponent;
use App\Livewire\FoodComponent;
use App\Livewire\UserPageComponent;
use App\Models\Food;
use Illuminate\Support\Facades\Route;

Route::get('/',CategoryComponent::class);
Route::get('/foods',FoodComponent::class);

Route::get('/user-page',UserPageComponent::class);