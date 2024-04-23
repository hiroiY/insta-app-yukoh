<?php
# regular user
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;

# Admin user
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
# Note: We need to protect our route. This mean that, the user need to register and Login befor the can accesss the homepage / dashbord
# We will use the [middleware'=>'auth'] for route protected
Route::group(['middleware'=>'auth'], function(){
    # Homepage
    Route::get('/', [HomeController::class, 'index'])->name('index'); //Home page
    Route::get('/people', [HomeController::class, 'search'])->name('search');
    Route::get('/suggestions', [HomeController::class, 'suggestions'])->name('suggestions');

    #create post page
    Route::get('/post/create',[PostController::class, 'create'])->name('post.create');

    #save/ post store
    Route::post('/post/store',[PostController::class, 'store'])->name('post.store');

    # Open the post page
    Route::get('/post/{id}/show', [PostController::class, 'show'])->name('post.show');

    # Open the edt post page
    Route::get('/post/{id}/edit',[PostController::class, 'edit'])->name('post.edit');

    # Perform the actual update
    Route::patch('/post/{id}/update',[PostController::class, 'update'])->name('post.update');

    #delete a post
    Route::delete('/post/{id}/delete',[PostController::class, 'destroy'])->name('post.destroy');

    #####Comment Route #####
    Route::post('/comment/{id}/store',[CommentController::class, 'store'])->name('comment.store');

    Route::delete('/comment/{id}/destroy',[CommentController::class, 'destroy'])->name('comment.destroy');

    ########## Profle section ###########
    Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/profile/edit',[ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile/uptade',[ProfileController::class, 'update'])->name('profile.update');

    Route::get('profile/{user_id}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
    Route::get('profile/{user_id}/following', [ProfileController::class, 'following'])->name('profile.following');

    ####### Like section #########
    Route::post('/like/{post_id}/store', [LikeController::class, 'store'])->name('like.store');

    Route::delete('/lke/{post_id}/destroy', [LikeController::class, 'destroy'])->name('like.destroy');

    ###########  Follow section  ##############
    Route::post('/follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');

    Route::delete('/follow/{user_id}/destroy', [FollowController::class, 'destroy'])->name('follow.destroy');

    ###########  Admin Route for Adminstorator ##############
    # 'prefix' -> to append before it .
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function() {
        // USERS Dashboard
        Route::get('/users',[UsersController::class, 'index'])->name('users'); //admin.users
        Route::delete('/users/{id}/deactivate',[UsersController::class, 'deactivate'])->name('users.deactivate');  // admin.users.deactivate
        Route::patch('/users/{id}/activate', [UsersController::class, 'activate'])->name('users.activate');

        // POSTS Admin Dashboard
        Route::get('/posts', [PostsController::class, 'index'])->name('posts'); //admin.posts
        Route::delete('/posts/{id}/hide', [PostsController::class, 'hide'])->name('posts.hide'); //admin.posts.hide
        Route::patch('/posts/{id}/unhide', [PostsController::class, 'unhide'])->name('posts.unhide'); //admin.posts.hide

          // CATEGORIES Admin Dashboard
        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
        Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
        Route::patch('/categories/{id}/update', [CategoriesController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}/destroy', [CategoriesController::class, 'destroy'])->name('categories.destroy');
    });
});

