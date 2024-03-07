@extends('partials.header')

@section('content')
    <div class="py-12">

        @if (session('success'))
            <div id="alert-3"
                class=" lg:m-10 flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
        <div class="relative overflow-x-auto lg:px-10 py-16">

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            id
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Event
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Payement
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ $reservation->id }}
                            </td>
                            <td class="px-6 py-4">
                                @foreach ($events as $event)
                                    @if ($event->id === $reservation->event_id)
                                        {{ $event->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                {{ $reservation->number }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $reservation->price = $reservation->number * $event->price }} DHS
                            </td>
                            <td class="px-6 py-4">
                                {{ $reservation->status }}

                            </td>
                            <td>
                              @if ($reservation->status == 'accepted')
                              <form action="{{ route('mollie',$reservation)}}" method="post">
                                @csrf
                                <input type="text" name="reservation" value="{{ $reservation->id }}" hidden>
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Payment</button>
                              </form>
                            @elseif ($reservation->status == 'pending')
                                <p class="text-yellow-500">Wait, please...</p>
                            @elseif ($reservation->status == 'refused')
                                <p class="text-red-500">Rejected</p>
                            @endif  
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-9 p-3">
                {{ $reservations->links() }}
            </div>
        </div>
    </div>
@endsection


<script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/all.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/aos.js') }}"></script>
<script src="{{ asset('assets/js/countdown.min.js') }}"></script>
<script src="{{ asset('assets/js/lightcase.js') }}"></script>
<script src="{{ asset('assets/js/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
