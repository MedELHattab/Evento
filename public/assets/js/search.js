// function confurmDelete(e) {
//     e.preventDefault();
//     Swal.fire({
//         title: "Are you sure?",
//         text: "You won't be able to revert this!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Yes, delete it!"
//     }).then((result) => {
//         if (result.isConfirmed) {

//             e.target.closest('form').submit();
//         }
//     });
// }
$(document).ready(function () {
    document.getElementById('search_input').addEventListener('input', fetchData);
    document.getElementById('category').addEventListener('change', fetchData);

    function fetchData() {
        var search_string = document.getElementById('search_input').value;
        var category = document.getElementById('category').value;
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        console.log(token)
       
        searchLoading()
        fetch(`/search?search_string=${search_string}&category=${category}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                }
            })
            .then(response => {

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data.events)
                if (data.status) {
                    showProduct(data.events, data.token);
                } else noResult();
            })
            .catch(error => {
                console.error('Fetch Error:', error);
            });
    }

    function searchLoading() {
        $("#place_result").html(`
            <div aria-label="Loading..." role="status" class="flex items-center space-x-2">
            <svg class="h-20 w-20 animate-spin stroke-gray-500" viewBox="0 0 256 256">
                <line x1="128" y1="32" x2="128" y2="64" stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></line>
                <line x1="195.9" y1="60.1" x2="173.3" y2="82.7" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="24"></line>
                <line x1="224" y1="128" x2="192" y2="128" stroke-linecap="round" stroke-linejoin="round" stroke-width="24">
                </line>
                <line x1="195.9" y1="195.9" x2="173.3" y2="173.3" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="24"></line>
                <line x1="128" y1="224" x2="128" y2="192" stroke-linecap="round" stroke-linejoin="round" stroke-width="24">
                </line>
                <line x1="60.1" y1="195.9" x2="82.7" y2="173.3" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="24"></line>
                <line x1="32" y1="128" x2="64" y2="128" stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></line>
                <line x1="60.1" y1="60.1" x2="82.7" y2="82.7" stroke-linecap="round" stroke-linejoin="round" stroke-width="24">
                </line>
            </svg>
            <span class="text-4xl font-medium text-gray-500">Loading...</span>
        </div>
            `)
    }
    function noResult() {
        $("#place_result").html(`
            <div class="w-full flex justify-center" >
                <img src="https://cdn.dribbble.com/users/235730/screenshots/2936116/no-resultfound.jpg" alt="">
            </div>
        `)
    }

    function showProduct(events, token) {
        $("#place_result").html("")
        events.forEach(event => {
            $("#place_result").append(`
            <div class="col-lg-4 col-md-6">
            <div class="blog__item" data-aos="fade-up" data-aos-duration="900">
                <div class="blog__inner">
                    <div class="blog__thumb h-60">
                        <img src="http://127.0.0.1:8000/uploads/events/${event.image}" alt="Blog Images">
                    </div>
                    <div class="blog__content">
                        <div class="blog__content-top">
                            <span class="blog__meta-tag">${event.category.name}</span>
                            <h4><a href="http://127.0.0.1:8000/events/${event.id}">${event.name}</a></h4>
                            <ul class="blog__meta d-flex flex-wrap align-items-center">
                                <li class="blog__meta-author">
                                    <a href="http://127.0.0.1:8000/events/${event.id}"><span><i class="fa-solid fa-user"></i></span> 
                                    
                                </li>
                                <li class="blog__meta-date">
                                    <a href="http://127.0.0.1:8000/events/${event.id}"><span><i class="fa-solid fa-calendar-days"></i></span>
                                    ${event.date}</a>
                                </li>
                            </ul>
                        </div>
                        <p>${event.description}</p>
                        <div class="blog__content-bottom">
                            <a href="http://127.0.0.1:8000/events/${event.id}" class="text-btn">Read More</a>
                            <form method="POST" action="http://127.0.0.1:8000/reservations/book">
                                
                                <input type="hidden" name="event_id" value="${event.id}">
                                <button type="submit" class="btn btn-primary">Create Reservation</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>`);


        });
    }


});