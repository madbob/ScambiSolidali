@for($rat = 0; $rat < $user->rating; $rat++)
    <i class="bi bi-star-fill"></i>
@endfor
@for(; $rat < 5; $rat++)
    <i class="bi bi-star"></i>
@endfor
