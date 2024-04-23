@extends('layouts.app')

@section('title','Home')

@section('content')
    <div class="row gx-5">
        <div class="col-8">
            @forelse ($home_posts as $post)
                <div class="card mb-4">
                    {{-- Show all the post details here --}}
                    {{-- title.blade.php --}}
                    @include('users.posts.contents.title')
                    {{-- body.blade.php --}}
                    @include('users.posts.contents.body')
                </div>
            @empty
                {{-- If the $all_posts don't have any post yet (empty), then display a link to create a post --}}
                <div class="text-center">
                    <h2>Share Photos</h2>
                    <p class="text-muted">When you share photos, they'll appear on your profile.</p>
                    <a href="{{ route('post.create') }}" class="text-decoration-none">Share first photo</a>
                </div>
            @endforelse
        </div>
        <div class="col-4 bg-light">
            {{-- Profile Overview --}}
            <div class="row align-items-center mb-5 bg-white shadow-sm rounded-3 py-3">
                <div class="col-auto">
                    <a href="{{ route('profile.show', Auth::user()->id) }}">
                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                        @endif
                    </a>
                </div>
                <div class="col ps-0">
                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="text-decoration-none text-dark fw-bold">{{ Auth::user()->name }}</a>
                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <!-- // Suggestions area -->
            @if($suggested_users)
                <div class="row align-items-center mb-3 bg-white py-2">
                    <div class="row my-2">
                        <div class="col-auto">
                            <h3 class="text-muted fw-bold h5">Uggestions For You</h3>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('suggestions') }}" class="fw-bold text-decoration-none pe-0 text-dark">See all</a>
                        </div>
                    </div>
                    @foreach ($suggested_users as $suggested_user)
                        <div class="row align-items-center mb-2">
                            <div class="col-auto">
                                <a href="{{ route('profile.show', $suggested_user->id) }}">
                                    @if ($suggested_user->avatar)
                                        <img src="{{ $suggested_user->avatar }}" alt="{{ $suggested_user->name }}" class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col ps-0 text-truncate">
                                <a href="{{ route('profile.show', $suggested_user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $suggested_user->name }}</a>
                            </div>
                            <div class="col-auto">
                                <form action="{{ route('follow.store', $suggested_user->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn border-0 bg-tarnsparent p-0 text-primary btn-sm">Follow</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

