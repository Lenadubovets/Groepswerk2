<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Import Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//unpkg.com/alpinejs" defer></script>  
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tippy.js -->
    <script src="https://unpkg.com/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6.3.2/dist/tippy-bundle.umd.js"></script>


    
    <title>Freego</title>

    <!-- CSS Styles -->
    <style>
        /* Apply imported font */
        body {
            font-family: 'Urbanist', sans-serif;
            font-weight: 300; /* Light (300) weight */
        }
    
        /* Your other styles */
        .header {
            font-family: 'Urbanist', sans-serif;
            font-weight: 300; /* Light (300) weight */
            font-size: 48px; /* Increase the font size */
        }
    
        .highlight {
            font-family: 'Urbanist', sans-serif;
            font-weight: 300; /* Light (300) weight */
        }
    
        code {
            font-family: 'Urbanist', sans-serif;
            font-weight: 300; /* Light (300) weight */
        }
    
        .fancy {
            font-family: 'Urbanist', sans-serif;
            font-weight: 300; /* Light (300) weight */
        }
    
        .text {
            font-family: 'Urbanist', sans-serif;
            font-weight: 300; /* Light (300) weight */
            font-size: 18px; /* Increase the font size */
        }
    </style>
</head>

<body>
    <div class="bg-white">
        <!-- TODO: Display Flash Message -->
        <x-flash-message />
        <div class="relative isolate px-6 pt-14 lg:px-8">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
            @include('header')
            <div class="content">
                @yield('content')
            </div>
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>
        @include('footer')
    </div>
    <x-flash-message/>
    <!-- Tooltips -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        tippy('[data-tippy-content]', {
            placement: 'top',
        });
    });
</script>
</body>

</html>

