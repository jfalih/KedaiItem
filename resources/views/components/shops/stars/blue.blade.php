<div class="star-rating me-2">
    @php
     $i = 0;
     $y = floor((float)$rating);   
    @endphp
    @for($i; $i < $y; $i++)
    <i class="ci-star-filled fs-sm text-accent me-1"></i>
    @endfor
    
    @if(strpos($rating, '.5'))
    <i class="ci-star-half fs-sm text-accent me-1"></i>
      @for($i; $i < 4; $i++)
      <i class="ci-star fs-sm text-muted me-1"></i>
      @endfor
    @else
      @for($i; $i < 5; $i++)
      <i class="ci-star fs-sm text-muted me-1"></i>
      @endfor    
    @endif
</div>