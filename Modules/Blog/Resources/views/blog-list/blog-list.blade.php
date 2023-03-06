 <!-- BLog Start -->
 <div class="col-lg-8 col-md-6">
     <div class="row">
         <div class="px-4 card-body content">
             {!! $category->description !!}
         </div>
         @foreach ($posts as $post)
             @include('blog::post-cart', [
                 'post' => $post,
                 'class' => 'col-12 col-lg-6 col-md-6 mb-4 pb-2',
             ])
         @endforeach

         <!--end col-->

         <!-- PAGINATION START -->
         {{ $posts->links('vendor.pagination.bootstrap-5') }}
         <!--end col-->
         <!-- PAGINATION END -->
     </div>
     <!--end row-->
 </div>
 <!--end col-->
 <!-- BLog End -->
