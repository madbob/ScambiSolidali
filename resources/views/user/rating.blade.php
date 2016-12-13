@for($rat = 0; $rat < $user->rating; $rat++)
    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
@endfor
@for(; $rat < 5; $rat++)
    <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
@endfor
