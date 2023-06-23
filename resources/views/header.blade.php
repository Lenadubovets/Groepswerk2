<header class="absolute inset-x-0 top-0 z-50" id="headertop">

                <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                    <div class="flex lg:flex-1">
                        <a href="/" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <img class="h-20 w-auto"
                                src="{{ asset('img/icon-black.png') }}" alt="">
                        </a>
                    </div>
                    <div class="flex lg:hidden" id="toggleMenuBtn">
                        <button type="button"
                            class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                            <span class="sr-only">Open main menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>

                    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                        @auth()
                            <div class="hidden lg:flex lg:gap-x-12">
                                <a href="/shoppinglist" class="text-sm font-semibold leading-6 text-gray-900">
                                    <i class="fa-solid fa-cart-shopping text-indigo-600"></i> Shopping List
                                </a>
                                <a href="/recipes" class="text-sm font-semibold leading-6 text-gray-900">
                                    <i class="fa-solid fa-plate-wheat text-indigo-600"></i> Recipes
                                </a>
                                <a href="/profile" class="text-sm font-semibold leading-6 text-gray-900">
                                    <i class="fa-solid fa-circle-user text-indigo-600"></i> Your Profile
                                </a>
                                <form class="h-full text-sm font-semibold leading-6" method="POST" action="/logout">
                                    @csrf
                                    <button type="submit">
                                      <i class="fa-solid fa-right-from-bracket text-indigo-600 pr-0.5"></i>Logout
                                    </button>
                                  </form>
                            </div>

                            {{-- If not logged in, show default links --}}
                        @else
                        <div class="hidden lg:flex lg:gap-x-12">
                            <a href="/login" class="text-sm font-semibold leading-6 text-gray-900">Log in <i class="fa-solid fa-right-to-bracket text-indigo-600"></i>
                                <span
                                    aria-hidden="true"></span></a>
                            <a href="/register" class="text-sm font-semibold leading-6 text-gray-900">Register <i class="fa-solid fa-user-plus text-indigo-600"></i><span
                                    aria-hidden="true"></span></a>
                        </div>
                        @endauth
                    </div>
                </nav>
                <!-- Mobile menu, show/hide based on menu open state. -->
                <div class="lg:hidden" role="dialog" aria-modal="true" id="mobileheader">
                    <!-- Background backdrop, show/hide based on slide-over state. -->
                    <div class="fixed inset-0 z-50" ></div>
                    <div
                        class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                        <div class="flex items-center justify-between">
                            <a href="#" class="-m-1.5 p-1.5">
                                <span class="sr-only">Your Company</span>
                                <img class="h-8 w-auto"
                                    src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                    alt="">
                            </a>
                            <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" >
                                <span class="sr-only">Close menu</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-6 flow-root">
                            <div class="-my-6 divide-y divide-gray-500/10">
                                <div class="space-y-2 py-6">
                                    <a href="#"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                        Your Freego </a>
                                    <a href="/shoppinglist"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                        <i class="fa-solid fa-cart-shopping"></i></a>
                                    <a href="/recipes"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Recipes</a>
                                    <a href="#"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"><i
                                            class="fa-solid fa-heart"></i> </a>
                                </div>
                                <div class="py-6">
                                    <a href="/login"
                                        class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log
                                        in</a>
                                    <a href="/register"
                                        class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Register</a>
                                </div>
                            </div>
                        </div>

                        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                            <div class="flex lg:flex-1">
                                <a href="/" class="-m-1.5 p-1.5">
                                    <span class="sr-only">Your Company</span>
                                    <img class="h-8 w-auto"
                                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                        alt="">
                                </a>
                            </div>
                            <div class="flex lg:hidden" 
                                <button type="button" 
                                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                                    <span class="sr-only">Open main menu</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" 
                                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                    </svg>
                                </button>
                            </div>
                            <div class="hidden lg:flex lg:gap-x-12">
                                <a href="/ingredients" class="text-sm font-semibold leading-6 text-gray-900"> Your
                                    Freego
                                </a>
                                <a href="/shoppinglist" class="text-sm font-semibold leading-6 text-gray-900"><i class="fa-solid fa-cart-shopping text-indigo-600"></i><a>
                                <a href="/recipes" class="text-sm font-semibold leading-6 text-gray-900"> Recipes </a>
                                <a href="#" class="text-sm font-semibold leading-6 text-gray-900"><i class="fa-solid fa-heart"></i></a>
                            </div>
                            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                                <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Log in <span
                                        aria-hidden="true">&rarr;</span></a>
                                <a href="/register" class="text-sm font-semibold leading-6 text-gray-900">Register
                                    <span aria-hidden="true">&rarr;</span></a>

                            </div>
                        </nav>
                        <!-- Mobile menu, show/hide based on menu open state. -->
                        <div class="lg:hidden" role="dialog" aria-modal="true" >
                            <div class="lg:hidden" role="dialog" aria-modal="true" id="mobileMenu">
                                <button>Toggle Menu</button>
                            </div>
                        </div>
                            <!-- Background backdrop, show/hide based on slide-over state. -->
                            <div class="fixed inset-0 z-50"></div>
                            <div
                                class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                                <div class="flex items-center justify-between">
                                    <a href="/" class="-m-1.5 p-1.5">
                                        <span class="sr-only">Your Company</span>
                                        <img class="h-20 w-auto"
                                src="{{ asset('img/icon-black.png') }}" alt="">
                                    </a>
                                    <button id="myButton" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                                        <span class="sr-only">Close menu</span>
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                      </button>
                                </div>
                                
                         <div class="mt-6 flow-root">
                            @auth()
                                
                          
                            <div class="-my-6 divide-y divide-gray-500/10">
                                <div class="space-y-2 py-6">
                                    <a href="/ingredients" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                        Your Freego
                                    </a>
                                    <a href="/shoppinglist" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                    <i class="fa-solid fa-cart-shopping text-indigo-600"></i> Shopping List
                                    </a>
                                    <a href="/recipes" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                        <i class="fa-solid fa-plate-wheat text-indigo-600"></i> Recipes
                                    </a>
                                    <a href="/profile" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                        <i class="fa-solid fa-circle-user text-indigo-600"></i> Your Profile
                                    </a> 
                                    <form class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50" method="POST" action="/logout">
                                         @csrf
                                         <button type="submit">
                                             <i class="fa-solid fa-right-from-bracket text-indigo-600"></i>
                                            <span class="text-black lowercase">Logout</span>
                                        </button>
                                    </form>
                                </div>
                                <div class="py-6">
                                     @else
                                   <a href="/login" class="-mx-3 block rounded-lg px-3 py-2.5 font-semibold leading-6 text-gray-900">Log in <i class="fa-solid fa-right-to-bracket text-indigo-600"></i>
                                <span
                                    aria-hidden="true"></span></a>
                                    <a href="/register" class=" -mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Register<i class="fa-solid fa-user-plus text-indigo-600"></i><span
                                        aria-hidden="true"></span></a>
                                    
                                   
                                    @endauth
                                </div>
                            </div>
                        </div>

</header>

<script>
    // Get references to the button and mobile menu elements
    var myButton = document.getElementById('myButton');
    var mobileHeader = document.getElementById('mobileheader');

    // Add a click event listener to the button
    myButton.addEventListener('click', function() {
        // Toggle the visibility of the mobile menu by adding or removing the 'hidden' class
        mobileHeader.classList.toggle('hidden');
    });

    // Add another click event listener to the slide menu button
    var toggleMenuBtn = document.getElementById('toggleMenuBtn');
    toggleMenuBtn.addEventListener('click', function() {
        // Show the mobile menu by removing the 'hidden' class
        mobileHeader.classList.remove('hidden');
    });
</script>
