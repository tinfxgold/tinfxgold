<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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


// cmd  php -i | grep cURL
// php -i | grep curl
// trang chủ ở đây
Route::fallback(function () {
    return redirect('/');
});

Route::group(['prefix' => '/'], function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/','index')->name('home');
        Route::get('/chatbox','chatbox');

        Route::get('khieu-nai','complain')->name('complain');
        Route::get('video','video')->name('video');

        Route::get('economic','economic')->name('economic');
        
        //border
        Route::get('brokers','brokers')->name('brokers');
        Route::get('brokers_detail','brokers_detail')->name('brokers_detail');
      
        // post
        Route::get('article_detail','article_detail')->name('article_detail');
        Route::get('article','article')->name('article');

        // comment
        Route::post('commentPost','commentPost')->name('commentPost');

        // blogs
        Route::get('blogs','blogs')->name('blogs');
        Route::get('blogs_detail','blogs_detail')->name('blogs_detail');
      
        //gold
        Route::get('gold','gold')->name('gold');

        //oanh code form
        Route::get('userinfo','userinfo')->name('userinfo');
        Route::post('userinfo','updateUserInfo')->name('update');
    });
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login','showLoginForm')->name('login');
        Route::post('/login','login')->name('login');
        Route::get('/logout', 'logout')->name('logout');

        Route::get('/register', 'showRegistrationForm')->name('register');
        Route::post('/register', 'register');

        Route::get('/shared/{token}','updateShare')->name('registerShareGet');
        Route::post('/register/{id}', 'registerShare')->name('registerShare');

        Route::get('/mang-xa-hoi/dang-nhap','redirectToGoogle')->name('loginMail');
        Route::get('/mang-xa-hoi/dang-nhap/callback','handleGoogleCallback');
        Route::post('/updatePassword', 'updatePassword')->name('updatePassword');

        Route::get('forgot-password', 'showLinkRequestForm')->name('password.request');
        Route::post('forgot-password', 'sendResetLinkEmail')->name('password.email');
        Route::get('reset-password/{id_user}', 'showResetForm')->name('password.reset');
        Route::post('reset-password', 'reset')->name('password.update');

    });

    Route::middleware(['CheckLoginUser'])->group(function () {

        Route::controller(MessagesController::class)->group(function () {
            Route::post('/sendMessage','index');
            Route::get('/listChat','getChat');
            Route::get('/listChatAdmin/{id}','getChatAdmin');
            Route::post('/sendMessageAdmin','sendMessageAdmin');
        });
        Route::controller(UserInfoController::class)->group(function () {
            Route::get('/danh-sach-nguoi-gioi-thieu','listGT')->name('listGT');
            Route::get('/thong-tin-ca-nhan','create')->name('updateInfo');
            Route::post('/thong-tin-ca-nhan','createPost')->name('updateInfoPost');

        });
    });

});
Route::group(['prefix' => 'admin', 'middleware'=>['CheckAdmin', 'CheckLoginUser']], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/','index')->name('admin');
        Route::get('/huong-dan-su-dung','docs')->name('docs');
    });
    Route::group(['prefix' => 'chat', 'as' =>'chat.'], function () {
        Route::controller(MessagesController::class)->group(function () {
            Route::get('/','indexAdmin')->name('index');
            Route::get('/getUser','getUser');
            Route::put('/updateRead','updateReadMessage');
            Route::get('/getUserSearch','searchUser');
        });
    });
    Route::group(['prefix' => 'user', 'as' =>'user.'], function () {
        Route::controller(UserController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');
            Route::get('/list/{type}','list')->name('list');
            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addPost');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editPost');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');

            // hiển thị tất cả
            Route::get('/show/{id}', 'show')->name('show');

        });
    });

    Route::group(['prefix' => 'category', 'as' =>'category.'], function () {
        Route::controller(CategoryController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');

            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addPost');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editPost');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');

            // hiển thị tất cả
            Route::get('/show/{id}', 'show')->name('show');
        });
    });

    Route::group(['prefix' => 'post', 'as' =>'post.'], function () {
        Route::controller(PostController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');

            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addPost');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editPost');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');

        });
    });
    Route::group(['prefix' => 'social', 'as' =>'social.'], function () {
        Route::controller(SocialController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');

            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addSocial');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editSocial');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');

        });
    });

    Route::group(['prefix' => 'video', 'as' =>'video.'], function () {
        Route::controller(VideoController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');

            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addVideo');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editVideo');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');

        });
    });

    Route::group(['prefix' => 'license', 'as' =>'license.'], function () {
        Route::controller(LicenseController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');

            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addLicense');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editLicense');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');

        });
    });

    Route::group(['prefix' => 'complaint', 'as' =>'complaint.'], function () {
        Route::controller(ComplaintController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');

            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addComplaint');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editComplaint');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');

        });
    });

    Route::group(['prefix' => 'broker', 'as' =>'broker.'], function () {
        Route::controller(BrokerController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');

            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addBroker');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editBroker');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');

        });
    });

    Route::group(['prefix' => 'economic', 'as' =>'economic.'], function () {
        Route::controller(EconomicCalendarController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');

            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addEconomic');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editEconomic');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');

        });
    });
    Route::group(['prefix' => 'blog', 'as' =>'blog.'], function () {
        Route::controller(BlogController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');

            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addBlog');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editBlog');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');

        });
    });

    Route::group(['prefix' => 'gold', 'as' =>'gold.'], function () {
        Route::controller(GoldController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');

            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addGold');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editGold');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');

        });
    });
});

