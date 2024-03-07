@extends('partials.header')

@section('content')
    
    <!-- ================> Banner section start here <================== -->
    <section id="home" class="banner banner--overlay" style="background-image: url(assets/images/banner/bg.jpg);">
        <div class="container">
            <div class="banner__wrapper">
                <div class="banner__content text-center" data-aos="zoom-in" data-aos-duration="900">
                    <h1>envato meetup 2023</h1>
                    <h3>12 Dec In New York</h3>
                    <div class="banner__bottom">
                        <ul class="countdown justify-content-center" data-date="July 25, 2023 21:14:01" id="countdown">
                            <li class="countdown__item">
                                <h3 class="countdown__number color--theme-color countdown__number-days">99</h3>
                                <p class="countdown__text">Days</p>
                            </li>
                            <li class="countdown__item">
                                <h3 class="countdown__number color--theme-color countdown__number-hours">18</h3>
                                <p class="countdown__text">Hours</p>
                            </li>
                            <li class="countdown__item">
                                <h3 class="countdown__number color--theme-color countdown__number-minutes">44</h3>
                                <p class="countdown__text">Min</p>
                            </li>
                            <li class="countdown__item">
                                <h3 class="countdown__number color--theme-color countdown__number-seconds">36</h3>
                                <p class="countdown__text">Sec</p>
                            </li>
                        </ul>
                    </div>
                    <a href="#" class="default-btn move-right"><span>Get Ticket <i
                                class="fa-solid fa-arrow-right"></i></span> </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ================> Banner section end here <================== -->
        <!-- ================Blog section start here <================== -->
        <section class="blog padding-top padding-bottom bg--white">
            <div class="container">
                <div class="section-header text-center" data-aos="fade-up" data-aos-duration="900">
                    <p class="subtitle">Latest Articles</p>
                    <h2>Our Recent Blog Post</h2>
                </div>
                <div class="blog__wrapper">
                    <div class="row g-4">
                        @foreach ($events as $event)
                        <div class="col-lg-4 col-md-6">
                            <div class="blog__item" data-aos="fade-up" data-aos-duration="900">
                                <div class="blog__inner">
                                    <div class="blog__thumb">
                                        <img src="{{ asset('uploads/events/'. $event->image) }}" alt="Blog Images">
                                    </div>
                                    <div class="blog__content">
                                        <div class="blog__content-top">
                                            <span class="blog__meta-tag">@foreach ($categories as $category)
                                                @if ($category->id === $event->category_id)
                                                    {{ $category->name }}
                                                @endif
                                            @endforeach</span>
                                            <h4><a href="{{ route('events.show', $event) }}">{{$event->name}}</a></h4>
                                            <ul class="blog__meta d-flex flex-wrap align-items-center">
                                                <li class="blog__meta-author">
                                                    <a href="#"><span><i class="fa-solid fa-user"></i></span> @foreach ($users as $user)
                                                        @if ($user->id === $event->created_by)
                                                            {{ $user->name }}
                                                        @endif
                                                    @endforeach</a>
                                                </li>
                                                <li class="blog__meta-date">
                                                    <a href="#"><span><i class="fa-solid fa-calendar-days"></i></span>
                                                    {{$event->date}}</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <p>{{$event->description}}</p>
                                        <div class="blog__content-bottom">
                                            <a href="blog-single.html" class="text-btn">Read More</a>
                                            <form method="POST" action="{{ route('reservations.book') }}">
                                                @csrf
                                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                                <button type="submit" class="btn btn-primary">Create Reservation</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-5 text-center">
                        <a href="blog.html" class="default-btn move-right"><span>View more</span></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- ================Blog section end here <================== -->
@endsection
@include('sweetalert::alert')
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/all.min.js')}}"></script>
<script src="{{asset('assets/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets/js/aos.js')}}"></script>
<script src="{{asset('assets/js/countdown.min.js')}}"></script>
<script src="{{asset('assets/js/lightcase.js')}}"></script>
<script src="{{asset('assets/js/purecounter_vanilla.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
</body>