<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/schema/create',function(){
    Schema::create('khoahoc',function($table){
        $table -> increments('id');
        $table -> string('hoten');
        $table -> string('monhoc');
        $table -> integer('hocphi');
        $table -> text('mota');
        $table -> timestamps();


    });
});
Route::get('/schema/drop',function(){

    Schema::DropIfExists('khoahoc');
});
Route::get('/schema/col-atr',function(){
    Schema::table('khoahoc',function($table){
        $table -> string('hoten',60) -> change();

    });
});
Route::get('/schema/rename',function(){
    Schema::rename('khoahoc','kh');

});
Route::get('/schema/drop_col',function(){
    Schema::table('kh',function($table){
        $table->dropColumn('mota');

    });

});
Route::get('/schema/create_col',function(){
    Schema::table('kh',function($table){

        $table->string('mota');
    });
});
Route::get('/schema/create/category',function(){
    Schema::create('category',function($table){
        $table->increments('id');
        $table->string('ten_category');
        $table->timestamps();
    });
});
Route::get('/schema/create/product',function(){
    Schema::create('product',function($table){
        $table->increments('id');
        $table->string('ten_product');
        $table->integer('gia')->unsigned();
        $table->integer('cate_id')->unsigned();
        $table->foreign('cate_id')->references('id')->on('category');
        $table->timestamps();
    });
});
Route::get('/schema/edit/foreign',function(){
    Schema::table('product',function($table){
        $table->dropForeign(['cate_id']);
        $table->foreign('cate_id')->references('id')->on('category')->onUpdate('cascade');
    });

});