@if (Route::has('login'))
                    @auth
                        @extends('admin.dashboard')
                    @else   
                        Redirect::route('login');
                    @endauth
            @endif


@section('content')

@endsection
