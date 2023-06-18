@extends('layout')
@section('content')
    <div class="mt-20 "></div>
    <h1 class="mb-10">Recipes you can already make:</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mx-4">
        @if ($recipes->count() > 0)
        @foreach($recipes as $recipe)
        @include('components.recipe-card', ['recipes' => $recipes])
        @endforeach
        @else
            <p>No recipes found 😭</p>
        @endif
    </div>
    </body>

    <style>
      .tooltip {
        /* Increase the width of the tooltip container */
        width: 160px;
        /* Adjust the positioning to accommodate the wider text */
        left: -170px;
        
      }
      
      .tooltip p {
        /* Set a fixed height and enable word-wrap for two lines of text */
        height: 2.4em;
        overflow: hidden;
        word-wrap: break-word;
      }
      
      </style>
      
      <script>
        const heartButtons = document.querySelectorAll('.heart-button');
        heartButtons.forEach(button => {
          button.addEventListener('mouseover', () => {
            const tooltip = button.querySelector('.tooltip');
            if (tooltip) {
              tooltip.classList.remove('hidden');
            }
          });
      
          button.addEventListener('mouseout', () => {
            const tooltip = button.querySelector('.tooltip');
            if (tooltip) {
              tooltip.classList.add('hidden');
            }
          });
        });
      </script>
      
@endsection
