<div class="star-rating">
    @php
     $i = 0;
     $y = floor((float)$rating);   
    @endphp
    @for($i; $i < $y; $i++)
    <i class="star-rating-icon ci-star-filled active"></i>
    @endfor
    @if(strpos($rating, '.5'))
    <i class="star-rating-icon ci-star-half active"></i>
      @for($i; $i < 4; $i++)
      <i class="star-rating-icon ci-star"></i>
      @endfor
    @else
      @for($i; $i < 5; $i++)
      <i class="star-rating-icon ci-star"></i>
      @endfor    
    @endif
  </div>