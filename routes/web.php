<?php

use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\CartController;
use App\Livewire\AttendanceComponent;
use App\Livewire\CartComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\FoodComponent;
use App\Livewire\LoginComponent;
use App\Livewire\OrdersComponent;
use App\Livewire\SectionComponent;
use App\Livewire\UserPageComponent;
use App\Livewire\UsersComponent;
use App\Livewire\WaiterBoardComponent;
use App\Livewire\WorkersComponent;
use Illuminate\Support\Facades\Route;


Route::get('/',LoginComponent::class);
Route::get('/logout',[AuthContoller::class,'logout']);
Route::get('/categories',CategoryComponent::class);
Route::get('/foods',FoodComponent::class);

Route::get('/user-page',UserPageComponent::class);

Route::get('/foods-in-cart',CartComponent::class);
Route::get('/orders',OrdersComponent::class);
Route::get('/users',UsersComponent::class);
Route::get('/sections',SectionComponent::class);
Route::get('/workers',WorkersComponent::class);

Route::get('/attendance',AttendanceComponent::class);
Route::get('/waiterboard',WaiterBoardComponent::class);
