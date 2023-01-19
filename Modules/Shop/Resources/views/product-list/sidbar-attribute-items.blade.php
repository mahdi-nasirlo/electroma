<div class="accordion mt-4 pt-2" id="buyingquestion">

    @php
        $attributes = \Modules\Shop\Entities\Attribute::with(['products.category'])
            ->whereHas('products.category', function ($q) use ($category) {
                $q->where('id', $category->id);
            })
            ->get();
    @endphp
    @foreach ($attributes as $attribute)
        @if ($this->filterIsEnable($attribute->name))
            <div class="accordion-item rounded pt-2">
                <h2 class="accordion-header" id="heading_{{ $attribute->id }}">
                    <button class="accordion-button border-0 bg-light" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse_{{ $attribute->id }}" aria-expanded="true"
                        aria-controls="collapse_{{ $attribute->id }}">
                        {{ $attribute->name }}
                    </button>
                </h2>
                <div id="collapse_{{ $attribute->id }}" class="accordion-collapse border-0 collapse show"
                    aria-labelledby="heading_{{ $attribute->id }}" data-bs-parent="#buyingquestion" style="">
                    <div class="accordion-body text-muted bg-white d-flex flex-column">
                        @php
                            $attributeValue = $attribute->values ?? ['دارد', 'ندارد'];
                        @endphp
                        @foreach ($attributeValue as $item)
                            <div class="form-check form-check-inline">
                                <div class="mb-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model='filter'
                                            value="{{ $item }}.{{ $attribute->name }}"
                                            id="flexCheckDefault_{{ $item }}">
                                        <label class="form-check-label" for="flexCheckDefault_{{ $item }}">
                                            {{ $item }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="accordion-item rounded pt-2">
                <h2 class="accordion-header" id="heading_{{ $attribute->id }}">
                    <button class="accordion-button border-0 bg-light collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse_{{ $attribute->id }}" aria-expanded="false"
                        aria-controls="collapse_{{ $attribute->id }}">
                        {{ $attribute->name }}
                    </button>
                </h2>
                <div id="collapse_{{ $attribute->id }}" class="accordion-collapse border-0 collapse"
                    aria-labelledby="heading_{{ $attribute->id }}" data-bs-parent="#buyingquestion" style="">
                    <div class="accordion-body text-muted bg-white d-flex flex-column">
                        @php
                            $attributeValue = $attribute->values ?? ['دارد', 'ندارد'];
                        @endphp
                        @foreach ($attributeValue as $item)
                            <div class="form-check form-check-inline">
                                <div class="mb-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model='filter'
                                            value="{{ $item }}.{{ $attribute->name }}"
                                            id="flexCheckDefault_{{ $item }}">
                                        <label class="form-check-label" for="flexCheckDefault_{{ $item }}">
                                            {{ $item }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
