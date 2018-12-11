@extends('layouts.app')

@section('content')





    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $user->name }} profile</div>
                    {{ $user->id }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">

                                @if ($user->avatar != 'default.jpg')
                                    <img src="{{ $user->getUsersAvatar() }}" style="width: 150px; height: 150px; float: left; border-radius: 50%;">
                                @else
                                    {!! Avatar::create($user->name)->setDimension(150, 150)->toSvg(); !!}
                                @endif


                            <!-- <form method="POST" action="{{ route('profile') }}">
                          <div class="form-group row">
                              <label for="file" class="col-sm-4 col-form-label text-md-right">{{ __('Avatar') }}</label>
                              <div class="col-md-6">
                                  <input type="file" class="form-control" name="avatar">
                              </div>
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Dodaj') }}
                                </button>
                            </div>
                        </form> -->

                                {{--<form enctype="multipart/form-data" method="POST" action="/profile">--}}
                                {{--@csrf--}}
                                {{----}}
                                {{--<div class="form-group">--}}
                                {{--<label for="exampleInputFile">File input</label>--}}
                                {{--<input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">--}}
                                {{--<small id="fileHelp" class="form-text text-muted">This is some placeholder.</small>--}}
                                {{--</div>--}}
                                {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                                {{--</form>--}}




                                {{--<button type="submit" class="btn btn-danger" style="float:left; margin-top:15px; margin-right:10px;">Delete</button>--}}
                                {{--<button type="submit" class="btn btn-primary" style="float:left; margin-top:15px;">Edit</button>--}}






                            </div>
                            <div class="col-sm">
                                <strong>Name:</strong> {{ $user->name }} <br>
                                <strong>Email:</strong> {{ $user->email }}
                            </div>
                            <div class="col-sm">

                            </div>
                        </div>

                        <br>
                        {{--<a class="btn btn-success" href="{{ route('follow', $user->id )}}" role="button">Follow </a>--}}
                        {{--<a class="btn btn-danger" href="{{ route('unfollow', $user->id )}}" role="button">Unfollow</a>--}}



                        @if (auth()->user()->isFollowing($user->id))
                            <td>
                                <form action="{{route('unfollow', ['id' => $user->id])}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-follow-{{ $user->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Unfollow
                                    </button>
                                </form>
                            </td>
                        @else
                            <td>
                                <form action="{{route('follow', ['id' => $user->id])}}" method="POST">
                                    {{ csrf_field() }}

                                    <button type="submit" id="follow-user-{{ $user->id }}" class="btn btn-success">
                                        <i class="fa fa-btn fa-user"></i>Follow
                                    </button>
                                </form>
                            </td>
                        @endif
                        Liczba followersów <span id="followers-count">{{ $followers->count() }}</span> <br> <br>








                        {{--@foreach ($followers as $follower)--}}

                        {{--@if (Auth::user()->id == $follower->id )--}}
                        {{--{{ $follower->id}}<a class="btn btn-danger" href="{{ route('unfollow', $user->id )}}" role="button">Unfollow</a>--}}
                        {{--@endif--}}
                        {{----}}
                        {{--@endforeach--}}






                    </div>
                </div>
            </div>
        </div>
        <hr>
        @foreach ($posts as $post)
            <div class="card">
                <div class="card-body">



                    <div class="blog-post post" data-postid="{{$post->id}}">
                        <h2 class="blog-post-title">
                            <a href="/posts/{{ $post->id }}">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <p class="blog-post-meta">

                            <a href="/users/{{ $post->user->id }}">
                                {{ $post->user->name }}
                            </a>
                            {{ $post->created_at->toFormattedDateString() }}
                        </p>
                        <p>
                            <img src="{{ $post->getFoodPic() }}" style="width: 150px; height: 150px; float: left; border-radius: 50%;">
                        {{ $post->body }}

                        </p>
                        <div>
                            @if (Auth::user() != false)

                                @php $likes = $post->likes()->where('user_id', auth()->id())->first() @endphp
                                <a href="#" class="btn {{$likes ? 'btn-danger' : 'btn-success'}} like-btn" role="button" data-postid="{{$post->id}}">{{$likes ? 'DisLike' : 'Like'}}</a>
                                <br><br>
                                Liczba lajków  <span id="likes-count-{{$post->id}}">{{ $post->likes()->count() }}</span> <br> <br>
                                Liczba komentarzy  <span>{{ $post->comments()->count() }}</span> <br> <br>
                            @else

                            @endif

                        </div>
                    </div>





                </div>
            </div>
            <br>
        @endforeach
    </div>
@endsection
