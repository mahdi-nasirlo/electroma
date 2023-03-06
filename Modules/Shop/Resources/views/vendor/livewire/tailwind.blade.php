<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))

        <nav role="navigation" aria-label="Pagination Navigation" class="d-flex align-items-center justify-between">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div style="padding-top: 10px">
                    <h5 class="d-flex">
                        <span class="mx-1">نمایش</span>
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        <span class="mx-1">-</span>
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                        <span class="mx-1">از</span>
                        <span class="font-medium">{{ $paginator->total() }}</span>
                        <span class="mx-1">نتیجه</span>
                    </h5>
                </div>
            </div>
        </nav>
    @endif
</div>
