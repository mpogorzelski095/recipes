@extends('layouts.app')

@section ('content')
    <div class="blog-post">
        <h2>Tags</h2>
        <ol class="list-unstyled">
            @foreach($categories as $category)
                <li>
                    <a href="/categories/{{ $category->name }}">
                        {{ $category->name }}
                        {{ $category->posts->count() }}
                    </a>
                </li>
            @endforeach
        </ol>
    </div>
@endsection
