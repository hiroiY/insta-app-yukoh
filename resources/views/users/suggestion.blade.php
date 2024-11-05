@extends('layouts.app')

@section('title','Suggestion For You')

@section('content')
  <div class="container w-50 mx-auto mt-3">
    <h3 class="text-muted text-start mb-4">Suggestes</h3>

          @foreach ($suggested_users as $user)
            <div class="row align-items-center mt-3">
              <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}">
                  @if ($user->avatar)
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-md">
                  @else
                    <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                  @endif
                </a>
              </div>
              <div class="col ps-0 text-truncate">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                <p class="text-muted ms-0 mb-0">{{ $user->email }}</p>

                <!-- Infomation of how many followers the user have.--> 
                @if($user->following->count() > 0)
                    @if($user->isFollowing())
                      <p class="text-muted xsmall ms-0">Follows you</p> 
                    @else
                      <p class="text-muted xsmall ms-0">{{$user->following->count()}} {{ $user->following->count() <= 1 ? 'Follower':'Followers' }}</p>
                    @endif
                @else
                  <p class="text-muted xsmall ms-0">No Followers Yet</p>
                @endif
                
              </div>
              <div class="col-auto text-end">
                <form action="{{ route('follow.store', $user->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary p-1 ">Follow</button>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      </div>
  </div>
@endsection