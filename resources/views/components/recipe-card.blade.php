<div class="bg-gray-50 border border-gray-200 rounded p-6 flex">
    <div class="flex flex-col items-center w-full"> 
      <h3 class="text-2xl text-center hover:text-indigo-600"> 
        <a href="/recipe/{{$recipe['id']}}">{{$recipe->name}}</a>
      </h3>
      <div class="flex justify-between items-center mt-4 relative">
        <!-- Heart (like) button -->
        <form action="{{ route('recipes.like', $recipe) }}" method="POST">
          @csrf
          @if ($recipe->isLiked)
            <button type="submit" class="heart-button text-red-500 hover:text-red-600" >
              <i class="fa fa-heart"></i>
            </button>
          @else
             <button type="submit" class="heart-button text-gray-400 hover:text-red-500 relative">
               <i class="fa fa-heart"></i>
                <div class="tooltip hidden bg-indigo-400 text-black text-sm py-1 px-4 rounded-md absolute -top-10 left ">
                Add recipe to your favorites
               </div>
              </button>
          
          @endif
        </form>
      </div>
      <img src="{{ $recipe->image }}" alt="{{ $recipe->name }}" class="mt-4 mx-auto max-w-200">
    </div>
  </div>