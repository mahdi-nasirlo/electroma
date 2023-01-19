@foreach ($categoreis as $category)
    @if ($category->is_visible)
        {{-- @if ($category->childIsVisible()) --}}
        <li class="has-megasubmenu">
            <a class="dropdown-item d-flex justify-content-between" href="{{ $category->link() }}">
                {{ $category->name }}
                <img src="\static\menu-back.png" width="12" height="12">
            </a>
            <div class="megasubmenu dropdown-menu">
                <div class="row">
                    @foreach ($category->children as $parent)
                        <div class="col-6">
                            <a class="d-flex align-center justify-content-between" href="{{ $parent->link() }}">
                                <h6 class="title">
                                    {{ $parent->name }}
                                </h6>
                                <img class="mt-2" src="\static\menu-back.png" width="12" height="12">
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
