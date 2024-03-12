@extends('partials.header')

@section('content')
    <div class="blog padding-top padding-bottom" style="margin: 12em">
        <div class="container">
            <div class="blog__wrapper">
                <div class="row ">
                    <div class="col-lg-8">
                        <article>
                            <div class="post-item-2">
                                <div class="post-inner">
                                    <div class="post-thumb mb-30 px-30 pt-30">
                                        <img src="{{ asset('uploads/events/'. $event->image) }}" alt="blog">
                                    </div>
                                    <div class="post-content pt-0">
                                        <h3>{{$event->name}}</h3>
                                        <ul class="blog__meta d-flex flex-wrap align-items-center mb-4">
                                            <li class="blog__meta-author">
                                                <a href="#"><span><i class="fa-solid fa-user"></i></span> @foreach ($users as $user)
                                                    @if ( $user->id == $event->created_by)
                                                        {{$user->name}}
                                                    @endif
                                                    
                                                @endforeach
                                                </a>
                                            </li>
                                            <li class="blog__meta-date">
                                                <a href="#"><span><i class="fa-solid fa-calendar-days"></i></span> {{$event->date}}</a>
                                            </li>
                                        </ul>
                                        <p>{{$event->description}} </p>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
    integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/all.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/aos.js') }}"></script>
<script src="{{ asset('assets/js/countdown.min.js') }}"></script>
<script src="{{ asset('assets/js/lightcase.js') }}"></script>
<script src="{{ asset('assets/js/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/search.js') }}"></script>
</body>
