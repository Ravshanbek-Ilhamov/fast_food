<?php

use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\CartController;
use App\Livewire\AllOrderComponent;
use App\Livewire\AttendanceComponent;
use App\Livewire\CartComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\FoodComponent;
use App\Livewire\KPISalaryComponent;
use App\Livewire\LoginComponent;
use App\Livewire\OrdersComponent;
use App\Livewire\SalaryComponent;
use App\Livewire\SectionComponent;
use App\Livewire\UserPageComponent;
use App\Livewire\UsersComponent;
use App\Livewire\WaiterBoardComponent;
use App\Livewire\WorkersComponent;
use App\Models\Role;
use Illuminate\Support\Facades\Route;


Route::get('/login',LoginComponent::class);
Route::get('/logout',[AuthContoller::class,'logout']);
Route::get('/categories',CategoryComponent::class);
Route::get('/foods',FoodComponent::class);

Route::get('/',UserPageComponent::class);

Route::get('/foods-in-cart',CartComponent::class);
Route::get('/orders',OrdersComponent::class);
Route::get('/users',UsersComponent::class);
Route::get('/sections',SectionComponent::class);
Route::get('/workers',WorkersComponent::class);

Route::get('/attendance',AttendanceComponent::class);
Route::get('/waiterboard',WaiterBoardComponent::class);
Route::get('/all-orders',AllOrderComponent::class);

Route::get('/salary',SalaryComponent::class);
Route::get('/kpi-salary',KPISalaryComponent::class);