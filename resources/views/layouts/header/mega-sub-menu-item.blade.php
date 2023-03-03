@foreach ($categoreis as $category)
    @if (!$category->children()->get()->isEmpty())
        {{-- @if ($category->childIsVisible()) --}}
        <li class="has-megasubmenu">
            <a style="align-items: center;" class="dropdown-item d-flex justify-content-between align-item-center"
                href="{{ $category->link() }}">
                {{ $category->name }}
                <x-icon-o-chevron-left />
            </a>
            <div class="megasubmenu dropdown-menu">
                <div class="row">
                    @foreach ($category->children()->get() as $parent)
                        <div class="col-6">
                            <a style="align-items: center;"
                                class="d-flex align-center justify-content-between align-item-center"
                                href="{{ $parent->link() }}">
                                <h6 class="title">
                                    {{ $parent->name }}
                                </h6>
                                {{-- <x-icon-o-chevron-left /> --}}
                            </a>
                            <ul class="list-unstyled bg-light">
                                @foreach ($parent->children as $child)
                                    <li><a href="{{ $child->categoryLink() }}"> {{ $child->name }}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- end col-3 -->
                    @endforeach
                </div>
        </li>
    @else
        <li><a class="dropdown-item" href="{{ $category->link() }}"> {{ $category->name }} </a></li>
    @endif
    {{-- @endif --}}
@endforeach
