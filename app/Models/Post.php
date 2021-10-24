<?php

namespace App\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;


class Post 
{
    public $title;
    public $excerpt;
    public $date;
    public $slug;
    public $body;

    public function __construct($title, $excerpt, $date, $slug, $body)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->slug = $slug;
        $this->body = $body;
    }
    public static function all() {
        // $files = File::files(resource_path('posts/'));
        // return array_map (fn($file) => $file->getContents(), $files);
        return cache()->rememberForever('posts.all', function(){
            return collect(File::files(resource_path('posts')))
                ->map(fn($file)=>YamlFrontMatter::parseFile($file))
                ->map(fn($document)=> new Post(
                        $document->title, 
                        $document->excerpt,
                        $document->date,
                        $document->slug,
                        $document->body()
                    ))
                ->sortByDesc('date');
        });
    }
        
    public static function find($slug)
    {
        // if(!file_exists($path = resource_path("posts/{$slug}.html"))){
        //     throw new ModelNotFoundException();
        // }
        // return cache()->remember("posts.{$slug}", now()->addMinute(20), fn() => file_get_contents($path));
        return static::all()->firstWhere('slug', $slug);
    }
    public static function findOrFail($slug)
    {
        $post = static::find($slug);
        if(!$post){
            throw new ModelNotFoundException();
        }
        return $post;
    }
}