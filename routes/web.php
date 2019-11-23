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
// Registration & Login Route
Route::post('/app/registration', "UserController@registration");

Route::post('/app/add_user_information', "UserController@update_an_user");
Route::get('/app/user/{id}', "UserController@single_user");


//Add book
Route::post('/app/create_book', "BookController@create_book");

Route::get('/app/all_books', "BookController@all_books");

//add category
Route::get('/app/all_category', "CategoryController@all_category");
Route::get('/app/all_category/{id}', "BookController@all_books_of_this_category");
Route::get('/app/all_author/{id}', "BookController@all_books_of_this_author");

Route::post('/app/create_category', "CategoryController@create_category");
//add author
Route::get('/app/all_author', "UserController@all_author");
Route::post('/app/add_details_of_author', "AuthorController@add_details_of_author");

Route::post('/app/login', "UserController@login");
//logout
Route::get('/logout', function () {
    Auth::logout();
    Session::flush();
    return redirect("/");
});
//copied from basicblog

//order
Route::post('/app/create_order', "OrderController@create_order");
Route::get('/app/all_orders', "OrderController@all_orders");
//shipping
Route::post('/app/add_shipping_information', "ShippingController@add_shipping_information");
Route::get('/app/show_shipping_information/{id}', "ShippingController@show_shipping_information");




Route::get('/app/all_book/{id}', "BookController@show_book_long");


//crud review and rating
Route::post('/app/add_review_rating', "BookController@add_review_rating");
Route::post('/app/edit_review_rating', "BookController@update_review_rating");
Route::post('/app/delete_review_rating', "BookController@delete_review_rating");
//reaction routes
Route::post('/app/add_reaction', "ReactionController@add_reaction");

//end



Route::any('{slug}', 'HomeController@home')->where('slug', '([A-z\d-\/_.]+)?');
