@if ($paginator->lastPage() > 1)
  <ul class="unstyled inbox-pagination">
    <li class="page-item {{ ($paginator->currentPage() ==  $paginator->onFirstPage()) ? 'disabled' : '' }}">
      @if($paginator->currentPage() ==  $paginator->onFirstPage())
        <span class="disabled page-link pr-5"><i class="fa fa-angle-left  pagination-left"></i></span>
      @else
      <a href="{{ $paginator->url($paginator->currentPage()-1) }}" class="page-link pr-5"><i class="fa fa-angle-left  pagination-left"></i></a>
      @endif
    </li>
    <?php
      $half_total_links = floor($link_limit / 2);
      $from = ($paginator->currentPage() - $half_total_links) < 1 ? 1 : $paginator->currentPage() - $half_total_links;
      $to = ($paginator->currentPage() + $half_total_links) > $paginator->lastPage() ? $paginator->lastPage() : ($paginator->currentPage() + $half_total_links);
      if ($from > $paginator->lastPage() - $link_limit) {
        $from = ($paginator->lastPage() - $link_limit) + 1;
        $to = $paginator->lastPage();
      }
      if ($to <= $link_limit) {
        $from = 1;
        $to = $link_limit < $paginator->lastPage() ? $link_limit : $paginator->lastPage();
      }
    ?>
    @for ($i = $from; $i <= $to; $i++)
      <li class="page-item {{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
        @if($paginator->currentPage() == 1 && $i == 1)  
        <span class="disabled page-link pl-5 pr-5">{{ $i }}</span>
        @elseif($paginator->currentPage() == $paginator->lastPage() && $i == $paginator->lastPage())  
        <span class="disabled page-link pl-5 pr-5">{{ $i }}</span>
        @else
        <a href="{{ $paginator->url($i) }}" class="page-link pl-5 pr-5">{{ $i }}</a>
        @endif
      </li>
    @endfor
    <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? 'disabled' : '' }}">
      @if($paginator->currentPage() == $paginator->lastPage())
      <span class="disabled page-link pl-5"><i class="fa fa-angle-right pagination-right"></i></span>
      @else
      <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" class="page-link pl-5"><i class="fa fa-angle-right pagination-right"></i></a>
      @endif
    </li>
  </ul>
@endif
