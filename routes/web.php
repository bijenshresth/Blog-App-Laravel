<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Spatie\YamlFrontMatter\YamlFrontMatter;
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

Route::get('/', function () {
    // $files = File::files(resource_path('posts'));
    
    // $posts = collect($files)
    // ->map(function($file){
    //     $document = YamlFrontMatter::parseFile($file);
    //     return new Post(
    //         $document->title, 
    //         $document->excerpt,
    //         $document->date,
    //         $document->slug,
    //         $document->body()
    //     );
    // });

    // $files = File::files(resource_path('posts'));
    
    // $posts = collect($files)
    // ->map(function($file){
    //     return YamlFrontMatter::parseFile($file);
    // })
    // ->map(function($document){
    //     return new Post(
    //         $document->title, 
    //         $document->excerpt,
    //         $document->date,
    //         $document->slug,
    //         $document->body()
    //     );
    // });
    
    // $posts = collect(File::files(resource_path('posts')))
    // ->map(fn($file)=>YamlFrontMatter::parseFile($file))
    // ->map(fn($document)=> new Post(
    //         $document->title, 
    //         $document->excerpt,
    //         $document->date,
    //         $document->slug,
    //         $document->body()
    //     ));


    // $posts = array_map(function($file){
    //     $document = YamlFrontMatter::parseFile($file);
    //     return new Post(
    //         $document->title, 
    //         $document->excerpt,
    //         $document->date,
    //         $document->slug,
    //         $document->body()
    //     );
    // }, $files);
    
    // foreach($files as $file){
    //     $document = YamlFrontMatter::parseFile($file);
    //     $posts[] = new Post(
    //         $document->title, 
    //         $document->excerpt,
    //         $document->date,
    //         $document->slug,
    //         $document->body()
    //     );  
    // }

    $posts = Post::all();
    return view('posts', ['posts' => $posts]);
});

Route::get('/posts/{post}', function($slug){
    return view("post", ['post' => Post::findOrFail($slug)]);
})->where('post', '[A-z_\-]+');