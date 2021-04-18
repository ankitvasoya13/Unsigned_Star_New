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

Auth::routes();

// Frontend Routes

Route::get('/user/verify/{token}', 'HomeController@verifyUser');
//Login, Register & forgotPassword Routes
Route::post('/user-login', 'HomeController@userLogin');
Route::match(['get', 'post'], '/user-logout', 'Auth\LoginController@userLogout');


Route::get('/', 'HomeController@index');

Route::get('/searchArtist', 'ArtistController@searchArtist');
Route::get('/searchTopArtist', 'ArtistController@searchTopArtist');

Route::get('/songViewCounter', 'HomeController@songViewCounter');
Route::get('/TopSongList', 'TopSongController@index');

Route::get('/about-us', 'HomeController@about')->name('about-us');
Route::get('/top-songs', 'HomeController@topsongs')->name('top-songs');
Route::get('/terms-of-use', 'HomeController@termsofuse')->name('terms-of-use');
Route::get('/privacy-policy', 'HomeController@privacypolicy')->name('privacy-policy');
Route::get('/faqs', 'HomeController@faqs')->name('faqs');

// Chat function
Route::post('/sendMessage', 'MessageController@sendMessage');
Route::post('/getMessage', 'MessageController@getMessage');
Route::post('/getChatList', 'MessageController@getChatList');
Route::post('/getChatListPanel', 'MessageController@getChatListPanel');
Route::get('/profile/{id}/message', 'MessageController@index');
Route::get('/message', 'MessageController@index');
Route::get('/dashboard/message', 'MessageController@artistMessage');
Route::post('/getMessageNotification', 'MessageController@getMessageNotification');

Route::get('/success-stories', 'StoryController@userStory');
Route::get('/storyLoadAjax', 'StoryController@userStoryAjax');
Route::get('/success-stories/storyDetails/{id}', 'HomeController@viewStory');

Route::get('/events', 'EventController@userEvents')->name('events');
Route::get('/eventsLoadAjax', 'EventController@userEventsAjax');
Route::get('/events/eventDetails/{id}', 'HomeController@viewEvent');

Route::get('/competitions', 'CompetitionController@userCompetitions')->name('competitions');
Route::get('/competitionsLoadAjax', 'CompetitionController@userCompetitionsAjax');
Route::get('/competitions/competitionDetails/{id}', 'HomeController@viewCompetition');

Route::match(['get', 'post'], '/contact-us', 'HomeController@contactSubmit');

Route::get('/join', 'HomeController@join')->name('join');

Route::match(['get', 'post'], '/artist-signup', 'HomeController@artistSignup');
Route::match(['get', 'post'], '/fan-signup', 'HomeController@fanSignup');
Route::match(['get', 'post'], '/panel-signup', 'HomeController@panelSignup');

Route::post('/check_email', 'HomeController@check_email');


Route::get('/artists', 'ArtistController@getArtists');
Route::get('/top-artists', 'ArtistController@getTopArtists');
Route::get('/featured-artists', 'ArtistController@getFeaturedArtists');

Route::get('/our-panel','HomeController@ourPanel');
Route::get('/searchPanel', 'HomeController@searchPanel');

/*Route::get('/stations','HomeController@stations');*/

Route::match(['get', 'post'], '/follow/{id}', 'HomeController@followUser');
Route::match(['get', 'post'], '/unfollow/{id}', 'HomeController@unfollowUser');

Route::match(['get', 'post'], '/like/{id}', 'HomeController@likeArtist');
Route::match(['get', 'post'], '/dislike/{id}', 'HomeController@DislikeArtist');


Route::group(['middleware' => ['web']], function () {
	Route::get('/dashboard', 'HomeController@userDashboard')->name('dashboard');
	Route::post('image_crop/upload', 'ArtistController@upload')->name('image_crop.upload');
	Route::post('image_crop/upload-track-cover', 'HomeController@uploadTrackCover')->name('image_crop.upload-track-cover');
	Route::match(['get', 'post'], '/update-profile/{id}', 'HomeController@updateProfile');
	Route::match(['get', 'post'], '/change-password/{id}', 'HomeController@changePassword');
	Route::match(['get', 'post'], '/upload-track', 'HomeController@uploadTrack');
	Route::match(['get', 'post'], '/upload-video', 'HomeController@uploadVideo');
	Route::match(['get', 'post'], '/upload-photos', 'ArtistController@PhotoUpload')->name('image_crop.photoUpload');
	Route::get('/delete-track/{id}', 'HomeController@deleteTrack');
	Route::get('/delete-photo/{id}', 'HomeController@deletePhotos');
	Route::get('/profile/{id}', 'HomeController@myProfile');
	Route::get('/profile/{id}/{name}', 'HomeController@myProfile');

	//Route::get('/', 'PayPalController@getIndex');
	Route::get('payment/process/{packageId}', 'PayPalController@getExpressCheckout');
	Route::get('payment/success/{packageId}', 'PayPalController@getExpressCheckoutSuccess');
	Route::get('payment/cancel', 'PayPalController@getExpressCheckoutCancel');
	Route::get('paypal/adaptive-pay', 'PayPalController@getAdaptivePay');
	Route::post('paypal/notify', 'PayPalController@notify');


	// Route::get('create_paypal_plan', 'PayPalController@create_plan');
	
	Route::get('admin/plan/list', 'PayPalController@list_plan');
	Route::get('admin/plan/add', 'PayPalController@add_plan');
	Route::post('admin/plan/add', 'PayPalController@create_plan');
	Route::get('admin/plan/edit/{id}', 'PayPalController@edit_plan');
	Route::post('admin/plan/edit/{id}', 'PayPalController@update_plan');	
	Route::get('admin/plan/active/{id}', 'PayPalController@activate_plan');
	Route::get('admin/plan/deactive/{id}', 'PayPalController@deactivate_plan');
	Route::get('admin/plan/delete/{id}', 'PayPalController@delete_plan');
	
	Route::get('/subscribe/plan/{id}', 'PayPalAPIController@plan_detail')->name('plan.detail');
	Route::get('/subscribe/plan/{id}/checkout', 'PayPalController@plan_checkout')->name('plan.checkout');
	
	Route::get('/subscribe/agreement_update/{agreementId}', 'PayPalController@update_agreement')->name('agreement.update');

	Route::get('/subscribe/autorenewal_agreement', 'PayPalController@auto_renewal_agreement')->name('autorenewal.agreement');

	// Route::get('/subscribe/paypal', 'PayPalController@paypalRedirect')->name('paypal.redirect');
	Route::get('/subscribe/paypal/return', 'PayPalController@paypalReturn')->name('paypal.return');
	Route::get('/subscribe/transaction', 'PayPalController@transaction')->name('paypal.transaction');

	// Coupons code
	Route::get('/admin/coupons/list', 'CouponController@index');
	Route::get('/admin/coupons/add', 'CouponController@create');
	Route::post('/admin/coupons/add', 'CouponController@create');
	Route::get('/admin/coupons/edit/{id}', 'CouponController@edit');
	Route::post('/admin/coupons/edit/{id}', 'CouponController@edit');
	Route::post('/admin/coupons/check', 'CouponController@checkApply')->name('coupon.check');
	// Subsciber save
	Route::post('/subscriber/create', 'PayPalAPIController@SubscriberCreate')->name('subscriber.create');

	Route::post('/reactive-plan', 'PayPalAPIController@reactivePlan')->name('reactive.plan');

	Route::get('/subscriber/update', 'PayPalAPIController@SubscriberUpdate')->name('subscriber.update');
	Route::get('/subscriber/{changeStatus}/{subscriptionID}', 'PayPalAPIController@SubscriberChangeStatus')->name('agreement.changeStatus');
	// Route::get('/subscriber/{s}/{subscriptionID}', 'PayPalAPIController@SubscriberActive')->name('agreement.active');
	Route::get('admin/subscriber/list', 'PayPalAPIController@list_subscriber');
	// Paypal Final
	Route::get('admin/paypal/syncPlan', 'PayPalAPIController@syncPlan');
	Route::get('paypal/test', 'PayPalAPIController@index');
});

// Admin Routes
Route::match(['get', 'post'], '/admin', 'AdminController@login');
Route::get('/admin/logout', 'AdminController@logout');
Route::match(['get', 'post'], '/admin/forgot-password', 'AdminController@forgotPassword');
Route::match(['get', 'post'], '/admin/password-reset', 'AdminController@resetPassword');

// Admin Auth Modules Routes
Route::group(['middleware' => ['web']], function () {
	Route::get('/admin/dashboard', 'AdminController@dashboard');

	// Admin Pages Routes
	Route::match(['get', 'post'], '/admin/pages/add', 'PageController@addPage');
	Route::match(['get', 'post'], '/admin/pages/edit/{id}', 'PageController@editPage');
	Route::match(['get', 'post'], '/admin/pages/delete/{id}', 'PageController@deletePage');
	Route::get('/admin/pages/view', 'PageController@viewPages');

	// Admin Packages Routes
	Route::match(['get', 'post'], '/admin/packages/add', 'PackageController@addPackage');
	Route::match(['get', 'post'], '/admin/packages/edit/{id}', 'PackageController@editPackage');
	Route::match(['get', 'post'], '/admin/packages/delete/{id}', 'PackageController@deletePackage');
	Route::get('/admin/packages/view', 'PackageController@viewPackage');

	// Admin Event Routes
	Route::match(['get', 'post'], '/admin/events/add', 'EventController@addEvent');
	Route::match(['get', 'post'], '/admin/events/edit/{id}', 'EventController@editEvent');
	Route::match(['get', 'post'], '/admin/events/delete/{id}', 'EventController@deleteEvent');
	Route::get('/admin/events/view', 'EventController@viewEvents');

	// Admin Competition Routes
	Route::match(['get', 'post'], '/admin/competitions/add', 'CompetitionController@addCompetition');
	Route::match(['get', 'post'], '/admin/competitions/edit/{id}', 'CompetitionController@editCompetition');
	Route::match(['get', 'post'], '/admin/competitions/delete/{id}', 'CompetitionController@deleteCompetition');
	Route::get('/admin/competitions/view', 'CompetitionController@viewCompetitions');

	// Admin Story Routes
	Route::match(['get', 'post'], '/admin/stories/add', 'StoryController@addStory');
	Route::match(['get', 'post'], '/admin/stories/edit/{id}', 'StoryController@editStory');
	Route::match(['get', 'post'], '/admin/stories/delete/{id}', 'StoryController@deleteStory');
	Route::get('/admin/stories/view', 'StoryController@viewStories');

	// Admin Slider Routes
	Route::match(['get', 'post'], '/admin/sliders/add', 'SliderController@addSlider');
	Route::match(['get', 'post'], '/admin/sliders/edit/{id}', 'SliderController@editSlider');
	Route::match(['get', 'post'], '/admin/sliders/delete/{id}', 'SliderController@deleteSlider');
	Route::get('/admin/sliders/view', 'SliderController@viewSliders');

	// Users Routes
	Route::get('/admin/downloadCSV/{type}', 'AdminController@downloadCSV');
	Route::get('/admin/users/view', 'UserController@viewAdmin');
	Route::get('/admin/artists/view', 'UserController@viewArtist');
	Route::get('/admin/fans/view', 'UserController@viewFan');
	Route::get('/admin/panels/view', 'UserController@viewPanel');
	//Route::get('/admin/panels/edit/{id}', 'UserController@editPanel');
    Route::match(['get', 'post'],'/admin/panels/edit/{id}', 'UserController@editPanel');
	Route::get('/admin/artists/delete/{id}', 'UserController@deleteArtist');
	Route::get('/admin/panels/delete/{id}', 'UserController@deletePanel');
	Route::get('/admin/fans/delete/{id}', 'UserController@deleteFan');

	Route::get('/admin/artists/status/{id}', 'UserController@updateStatus');
	Route::get('/admin/panels/status/{id}', 'UserController@updateStatus');
	Route::get('/admin/fans/status/{id}', 'UserController@updateStatus');

	Route::get('/admin/artists/featured/{id}', 'UserController@isFeatured');
	Route::get('/admin/artists/homefeatured/{id}', 'UserController@isHomeFeatured');
	
	//Order Routes
	Route::get('/admin/orders/view', 'TransactionController@Index');

    Route::match(['get', 'post'], '/admin/image/upload', 'AdminController@PhotoUpload')->name('admin.image.upload');
});
