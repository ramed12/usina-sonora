<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'site'], function () {

    Route::get('/email', 'homeController@email');
    Route::get('/', 'homeController@index')->name('site.home');
    Route::get('/politica-de-privacidade', 'homeController@privacyPolitc')->name('site.politic-privacy');
    Route::get('/investidor', 'homeController@investor')->name('site.investor');
    Route::get('/contato', 'homeController@contact')->name('site.contact');
    Route::post('/contato', 'homeController@contactSend')->name('site.contact.send');
    Route::post('/investidor', 'homeController@investorSend')->name('site.investor.send');
    Route::get('/lgpd/{slug}', 'homeController@lgpd')->name('site.lgdp');
    Route::get('/trabalhe', 'homeController@work')->name('site.work');

    Route::get('/noticia/{id}/{slug}', 'newsController@detail')->name('site.news.detail');
    Route::get('/noticia', 'newsController@list')->name('site.news.list');


    Route::get('/usina/{id}/{url}', 'factoryController@listPage');
    Route::get('/produtos/{id}/{url}', 'productController@listPage');
    Route::get('/sustentabilidade/{id}/{url}', 'sustainabilityController@listPage');

    Route::get('/video', 'homeController@videoList')->name('site.video.list');
    Route::get('/video/{id}', 'homeController@videoDetail')->name('site.video.detail');

    Route::get('/idea', 'homeController@idea')->name('site.idea');
    Route::post('/idea', 'homeController@ideaSend')->name('site.idea.send');

    /*  Route::get('/socioambiental/responsabilidade-social','sustainabilityController@socialresponsability')->name('site.sustainability.socialresponsability');
    Route::get('/socioambiental/ambiental','sustainabilityController@environmental')->name('site.sustainability.environmental');
 */
    Route::group(['middleware' => ['auth']], function () {
        Route::group(['middleware' => ['can:isInvestor']], function () {
            Route::get('/area-do-investidor/lista', 'investorController@index')->name('site.investorarea');
            Route::get('/area-do-investidor/download/{file_id}', 'investorController@download')->name('site.download');
        });
    });
});

Route::group(['middleware' => ['auth'], 'namespace' => 'dashboard'], function () {



    Route::group(['middleware' => ['can:isAdmin']], function () {

        Route::get('/dashboard/home', 'HomeController@index')->name('home');

        Route::get('/dashboard/factory', 'factoryController@index')->name('factory');
        Route::get('/dashboard/factory/add', 'factoryController@add')->name('factory.add');
        Route::post('/dashboard/factory/add', 'factoryController@store')->name('factory.send.add');
        Route::get('/dashboard/factory/edit/{id}', 'factoryController@edit')->name('factory.edit');
        Route::post('/dashboard/factory/edit', 'factoryController@update')->name('factory.send.edit');
        Route::get('/dashboard/factory/delete/{id}', 'factoryController@delete')->name('factory.send.del');

        Route::get('/dashboard/product', 'productController@index')->name('product');
        Route::get('/dashboard/product/add', 'productController@add')->name('product.add');
        Route::post('/dashboard/product/add', 'productController@store')->name('product.send.add');
        Route::get('/dashboard/product/edit/{id}', 'productController@edit')->name('product.edit');
        Route::post('/dashboard/product/edit', 'productController@update')->name('product.send.edit');
        Route::get('/dashboard/product/delete/{id}', 'productController@delete')->name('product.send.del');

        Route::get('/dashboard/client/edit/{id}', 'clientController@edit')->name('client.edit');
        Route::post('/dashboard/client/edit', 'clientController@update')->name('client.send.edit');

        Route::get('/dashboard/policy/edit/{id}', 'policyController@edit')->name('policy.edit');
        Route::post('/dashboard/policy/edit', 'policyController@update')->name('policy.send.edit');

        Route::get('/dashboard/contact', 'contactController@index')->name('contact');
        Route::get('/dashboard/contact/edit/{id}', 'contactController@edit')->name('contact.edit');
        Route::post('/dashboard/contact/edit', 'contactController@update')->name('contact.send.edit');
        Route::get('/dashboard/contact/delete/{id}', 'contactController@delete')->name('contact.send.del');

        Route::get('/dashboard/idea', 'ideaController@index')->name('idea');
        Route::get('/dashboard/idea/{id}', 'ideaController@show')->name('idea.show');
        Route::get('/dashboard/idea/delete/{id}', 'ideaController@delete')->name('idea.send.del');

        Route::get('/dashboard/investor/edit/{id}', 'investorController@editPage')->name('investor.edit');
        Route::post('/dashboard/investor/edit', 'investorController@updatePage')->name('investor.send.edit');
        Route::get('/dashboard/investor/delete/{id}', 'investorController@delete')->name('investor.send.del');
        Route::post('/dashboard/investor/password', 'investorController@activePassword');

        Route::get('/dashboard/sustainability', 'sustainabilityController@index')->name('sustainability');
        Route::get('/dashboard/sustainability/add', 'sustainabilityController@add')->name('sustainability.add');
        Route::post('/dashboard/sustainability/add', 'sustainabilityController@store')->name('sustainability.send.add');
        Route::get('/dashboard/sustainability/edit/{id}', 'sustainabilityController@edit')->name('sustainability.edit');
        Route::post('/dashboard/sustainability/edit', 'sustainabilityController@update')->name('sustainability.send.edit');
        Route::get('/dashboard/product/sustainability/{id}', 'sustainabilityController@delete')->name('sustainability.send.del');

        Route::get('/dashboard/news', 'newsController@index')->name('news');
        Route::get('/dashboard/news/add', 'newsController@add')->name('news.add');
        Route::get('/dashboard/news/edit/{id}', 'newsController@edit')->name('news.edit');
        Route::post('/dashboard/news/edit', 'newsController@update')->name('news.send.edit');
        Route::post('/dashboard/news/add', 'newsController@store')->name('news.send.add');
        Route::get('/dashboard/news/delete/{id}', 'newsController@delete')->name('news.send.del');

        Route::get('/dashboard/gallery/carousel', 'carouselController@list')->name('gallery.carousel');
        Route::get('/dashboard/gallery/carousel/add', 'carouselController@add')->name('gallery.carousel.add');
        Route::post('/dashboard/gallery/carousel/add', 'carouselController@store')->name('gallery.carousel.send.add');
        Route::get('/dashboard/gallery/carousel/edit/{id}', 'carouselController@edit')->name('gallery.carousel.edit');
        Route::post('/dashboard/gallery/carousel/edit', 'carouselController@update')->name('gallery.carousel.send.edit');
        Route::get('/dashboard/gallery/carousel/del/{id}', 'carouselController@delete')->name('gallery.carousel.send.del');

        Route::get('/dashboard/gallery/image', 'imageController@list')->name('gallery.image');
        Route::get('/dashboard/gallery/image/add', 'imageController@add')->name('gallery.image.add');
        Route::post('/dashboard/gallery/image/add', 'imageController@store')->name('gallery.image.send.add');
        Route::get('/dashboard/gallery/image/edit/{id}', 'imageController@edit')->name('gallery.image.edit');
        Route::post('/dashboard/gallery/image/edit', 'imageController@update')->name('gallery.image.send.edit');
        Route::get('/dashboard/gallery/image/del/{id}', 'imageController@delete')->name('gallery.image.send.del');

        Route::get('/dashboard/gallery/certificate', 'certificateController@list')->name('gallery.certificate');
        Route::get('/dashboard/gallery/certificate/add', 'certificateController@add')->name('gallery.certificate.add');
        Route::post('/dashboard/gallery/certificate/add', 'certificateController@store')->name('gallery.certificate.send.add');
        Route::get('/dashboard/gallery/certificate/edit/{id}', 'certificateController@edit')->name('gallery.certificate.edit');
        Route::post('/dashboard/gallery/certificate/edit', 'certificateController@update')->name('gallery.certificate.send.edit');
        Route::get('/dashboard/gallery/certificate/del/{id}', 'certificateController@delete')->name('gallery.certificate.send.del');

        Route::get('/dashboard/gallery/video', 'videoController@list')->name('gallery.video');
        Route::get('/dashboard/gallery/video/add', 'videoController@add')->name('gallery.video.add');
        Route::post('/dashboard/gallery/video/add', 'videoController@store')->name('gallery.video.send.add');
        Route::get('/dashboard/gallery/video/edit/{id}', 'videoController@edit')->name('gallery.video.edit');
        Route::post('/dashboard/gallery/video/edit', 'videoController@update')->name('gallery.video.send.edit');
        Route::get('/dashboard/gallery/video/del/{id}', 'videoController@delete')->name('gallery.video.send.del');

        Route::get('/dashboard/gallery/journal', 'journalController@list')->name('gallery.journal');
        Route::get('/dashboard/gallery/journal/add', 'journalController@add')->name('gallery.journal.add');
        Route::post('/dashboard/gallery/journal/add', 'journalController@store')->name('gallery.journal.send.add');
        Route::get('/dashboard/gallery/journal/edit/{id}', 'journalController@edit')->name('gallery.journal.edit');
        Route::post('/dashboard/gallery/journal/edit', 'journalController@update')->name('gallery.journal.send.edit');
        Route::get('/dashboard/gallery/journal/del/{id}', 'journalController@delete')->name('gallery.journal.send.del');

        Route::get('/dashboard/user', 'userController@list')->name('user');
        Route::get('/dashboard/user/add', 'userController@add')->name('user.add');
        Route::get('/dashboard/user/edit/{id}', 'userController@edit')->name('user.edit');
        Route::post('/dashboard/user/add', 'userController@store')->name('user.send.add');
        Route::post('/dashboard/user/edit', 'userController@update')->name('user.send.edit');
        Route::get('/dashboard/user/del/{id}', 'userController@delete')->name('user.send.del');

        Route::get('/dashboard/investor', 'investorController@list')->name('investor');
        Route::get('/dashboard/investor/add', 'investorController@add')->name('investor.add');
        Route::get('/dashboard/investor/edit/{id}', 'investorController@edit')->name('investor.edit');
        Route::post('/dashboard/investor/add', 'investorController@store')->name('investor.send.add');
        Route::post('/dashboard/investor/edit', 'investorController@update')->name('investor.send.edit');
        Route::get('/dashboard/investor/del/{id}', 'investorController@delete')->name('investor.send.del');
        Route::post('/dashboard/investor/password', 'investorController@activePassword')->name('investor.send.password');
        Route::get('/dashboard/investor/envio-de-senha-arquivo/{id}', 'investorController@activeSendPasswordFile')->name('investor.send.file.password');

        Route::get('/dashboard/investor/file', 'investorController@listFile')->name('investor.file');
        Route::get('/dashboard/investor/file/add', 'investorController@addFile')->name('investor.file.add');
        Route::get('/dashboard/investor/file/edit/{id}', 'investorController@editFile')->name('investor.file.edit');
        Route::post('/dashboard/investor/file/add', 'investorController@shoreFile')->name('investor.file.send.add');
        Route::post('/dashboard/investor/file/edit', 'investorController@updateFile')->name('investor.file.send.edit');
        Route::get('/dashboard/investor/file/del/{id}', 'investorController@deleteFile')->name('investor.file.send.del');

        Route::get('/dashboard/company/basic', 'companyController@index')->name('basic');
        Route::post('/dashboard/company/basic/edit', 'companyController@update')->name('basic.send.edit');

        Route::get('/dashboard/company/departament', 'departamentController@index')->name('departament');
        Route::get('/dashboard/company/departament/add', 'departamentController@add')->name('departament.add');
        Route::get('/dashboard/company/departament/edit/{id}', 'departamentController@edit')->name('departament.edit');
        Route::post('/dashboard/company/departament/edit', 'departamentController@update')->name('departament.send.edit');
        Route::post('/dashboard/company/departament/add', 'departamentController@store')->name('departament.send.add');
        Route::get('/dashboard/company/departament/del/{id}', 'departamentController@delete')->name('departament.send.del');

        Route::get('/dashboard/paramenter/email', 'emailController@index')->name('email');
        Route::get('/dashboard/paramenter/email/add', 'emailController@add')->name('email.add');
        Route::get('/dashboard/paramenter/email/edit/{id}', 'emailController@edit')->name('email.edit');
        Route::post('/dashboard/paramenter/email/add', 'emailController@store')->name('email.send.add');
        Route::post('/dashboard/paramenter/email/edit', 'emailController@update')->name('email.send.edit');
        Route::get('/dashboard/paramenter/email/del/{id}', 'emailController@delete')->name('email.send.del');

        Route::get('/dashboard/paramenter/lgpd', 'lgpdController@index')->name('lgpd');
        Route::get('/dashboard/paramenter/lgpd/add', 'lgpdController@add')->name('lgpd.add');
        Route::get('/dashboard/paramenter/lgpd/edit/{id}', 'lgpdController@edit')->name('lgpd.edit');
        Route::post('/dashboard/paramenter/lgpd/add', 'lgpdController@store')->name('lgpd.send.add');
        Route::post('/dashboard/paramenter/lgpd/edit', 'lgpdController@update')->name('lgpd.send.edit');
        Route::get('/dashboard/paramenter/lgpd/del/{id}', 'lgpdController@delete')->name('lgpd.send.del');

        Route::get('/dashboard/log-investor', 'LogInvestorController@index')->name('log-investor');
    });
});
Auth::routes();
