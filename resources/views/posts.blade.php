@extends('layout')
@section('content')
<article>
    @foreach($posts as $post)
        <a href="posts/{{$post->slug}}">
        <h1>{{$post->title}}</h1>
        <a>
        <div>
            {{$post->excerpt}}
        <div>
    @endforeach
</article>
@endsection

<!--<x-layout>
    <article>
        @foreach($posts as $post)
            <a href="posts/{{$post->slug}}">
            <h1>{{$post->title}}</h1>
            </a>
            <div>
                {{$post->excerpt}}
            <div>
        @endforeach
    </article>
</x-layout> -->

