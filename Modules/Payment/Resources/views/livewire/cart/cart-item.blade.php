 <tr class="shop-list">
     <td class="h6">
         <a wire:click.prevent="removeCart" href="javascript:void(0)" class="text-danger">
             <span wire:loading.remove>X</span>
             <div wire:loading style="width: 20px;height: 20px" class="spinner-border text-danger" role="status">
             </div>
         </a>
     </td>
     <td>
         <div class="d-flex align-items-center">
             <a href="{{ route('shop.product.single', $product) }}">
                 <img src="{{ $product->getCoverUrl() }}" alt="{{ $product->name }}"
                     class="img-fluid avatar avatar-small rounded shadow" style="height:auto;">
             </a>
             <a class="text-secendry mx-2 text-body" href="{{ route('shop.product.single', $product) }}">
                 {{ $product->name }}
             </a>
         </div>
     </td>
     <td class="text-center">
         @if ($product->price != $new_price)
             <del class="text-danger">
                 {{ number_format($product->price) }}
             </del>

             {{ number_format($new_price) }}
             تومان
         @else
             {{ number_format($product->price) }} تومان
         @endif
     </td>
     <td class="text-center qty-icons">
         <button wire:click='decrement' onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
             class="btn btn-icon btn-soft-primary minus">-</button>
         <input wire:model='count' min="1" max="{{ $product->inventory }}" name="quantity" type="number"
             class="btn btn-icon btn-soft-primary qty-btn quantity">
         <button wire:click='increment' onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
             class="btn btn-icon btn-soft-primary plus">+</button>
     </td>
     <td class="text-center fw-bold">
         {{ number_format($new_price * $count) }} تومان
     </td>
 </tr>
