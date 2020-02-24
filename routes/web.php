<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$products = [
    [
        'index' => 0,
        'name' => 'LONG YELLOW SHIRT',
        'price' => 39.90,
        'img' => 'img/products/1.jpg'
    ],
    [
        'index' => 1,
        'name' => 'HYPE BLUE SHIRT',
        'price' => 19.50,
        'img' => 'img/products/2.jpg'
    ],
    [
        'index' => 2,
        'name' => 'HYPE SHORT SHIRT',
        'price' => 12.50,
        'img' => 'img/products/6.jpg'
    ],
    [
        'index' => 3,
        'name' => 'HYPE ORANGE MINIMALIST',
        'price' => 13.60,
        'img' => 'img/products/11.jpg'
    ],
    [
        'index' => 4,
        'name' => 'APAYA',
        'price' => 59.90,
        'img' => 'img/products/3.jpg'
    ],
    [
        'index' => 5,
        'name' => 'GREY BAG',
        'price' => 5.60,
        'img' => 'img/products/12.jpg'
    ]
];

$productCategories = [
    'long' => [
        $products[0],
        $products[1]
    ],
    'short' => [
        $products[2],
        $products[3]
    ],
    'bag' => [
        $products[4],
        $products[5]
    ]
];

Route::get('/', function (Request $request) {
    if (!$request->session()->has('created')) {
        $request->session()->put('created', true);
        $request->session()->put('testimonials', []);
        $request->session()->put('cartCount', []);
    }
    return view('index');
})->name('home');

Route::get('/promo', function (Request $request) {
    return view('promo');
})->name('promo');

Route::get('/testimonial', function (Request $request) {
    $testimonials = $request->session()->get('testimonials');
    return view('testimonial', ['testimonials' => $testimonials]);
})->name('testimonial');

Route::post('/testimonial', function (Request $request) {
    $testimonials = $request->session()->get('testimonials');
    array_push($testimonials, ['fullname' => $request->fullname, 'description' => $request->description]);
    $request->session()->put('testimonials', $testimonials);
    return redirect('/testimonial');
})->name('testimonial-post');

Route::get('/categories', function (Request $request) use ($productCategories) {
    return view('categories', ['productCategories' => $productCategories]);
})->name('categories');

Route::get('/cart', function (Request $request) use ($products) {
    $cartCount = $request->session()->get('cartCount');
    $subtotal = 0;
    foreach ($cartCount as $key => $cc) {
        $subtotal += $products[$key]['price'] * $cc;
    }
    return view('cart', ['products' => $products, 'cartCount' => $cartCount, 'subtotal' => $subtotal]);
})->name('cart');

Route::get('/cart/{index}', function (Request $request) {
    $index = intval($request->index);
    $cartCount = $request->session()->get('cartCount');
    if (!array_key_exists(strval($index), $cartCount)) {
        $cartCount[$index] = 1;
    } else {
        $cartCount[$index]++;
    }
    $request->session()->put('cartCount', $cartCount);
    return redirect()->route('categories');
})->name('cart-index');

Route::post('/checkout', function (Request $request) {
    return view('checkout', ['total' => $request->total]);
});
