@extends('layouts.app')


@section ('content')
    @if($posts->count() == 0)
        <div class="row justify-content-center">
            <div class="card" id="postsCard">
                <div class="card-body">
                    <p style="text-align: center; font-size: 100px; margin-bottom: 0;"><i class="fas fa-utensils"></i>
                    </p>
                    <p style="text-align: center; font-size: 40px;">No recipes to show </p>
                    <a href="{{ route('create') }}" type="button" class="btn btn-primary btn-lg btn-block">Add your
                        first recipe</a>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <form method="post" enctype="multipart/form-data" action="{{ route('sortMypost') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Sort by</label>
                        </div>
                        <select name="sortMypost" class="custom-select" id="inputGroupSelect01">
                            <option href="/?sortMypost=1" value="1" {{ $option == '1'  ? "selected" : "" }} >Latest
                            </option>
                            <option href="/?sortMypost=2" value="2" {{ $option == '2'  ? "selected" : "" }} >Oldest
                            </option>
                            <option href="/?sortMypost=3" value="3" {{ $option == '3'  ? "selected" : "" }} >Like
                            </option>
                            <option href="/?sortMypost=4" value="4" {{ $option == '4'  ? "selected" : "" }} >Comments
                            </option>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-10">
                @foreach ($posts as $post)







                    <div class="card" id="postsCard">
                        <div class="card-body">
                            @include('posts.post')
                        </div>
                        <div class="d-flex justify-content-end" style="padding-bottom: 15px;">
                            <div class="col-sm-6">
                                <a href="/posts/{{ $post->id }}/edit">
                                    <button type="button" class="btn btn-primary btn-block"
                                            style="margin-right: 10px; float:left; ">
                                        Edit
                                    </button>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <form action="{{ route('destroy', ['post' => $post]) }}" method="POST">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger btn-block" style="float:left;">Delete</button>
                                </form>
                            </div>

                        </div>
                    </div>
                    <br>

                @endforeach
            </div>
        </div>

        <div class="d-flex justify-content-end">
            {{ $posts->links() }}
        </div>
    @endif
@endsection

