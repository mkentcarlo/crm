@if ($paginator->hasPages())
@php
  $perCountStart = ($paginator->currentPage() - 1) * $paginator->perPage() + 1; 
  $perCountEnd = $paginator->currentPage() * $paginator->perPage();
  $perCountEnd = $paginator->total() < $perCountEnd ? $paginator->total() : $perCountEnd;
@endphp
<div class="table-header">
  <p class="pagination-text">全{{ $paginator->total() }}件中{{ $perCountStart }}-{{ $perCountEnd }}件を表示</p>
  <ul class="table-pagination list-inline">
    @if ($paginator->onFirstPage())
      <li class="disabled"><span>前</span></li>
    @else
      <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">前</a></li>
    @endif

    @foreach ($elements as $element)
      @if (is_string($element))
        <li class="disabled"><span>{{ $element }}</span></li>
      @endif

      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <li class="active"><span>{{ $page }}</span></li>
          @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
      @endif
    @endforeach

    @if ($paginator->hasMorePages())
      <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">次</a></li>
    @else
      <li class="disabled"><span>次</span></li>
    @endif
  </ul>
</div>
@endif
