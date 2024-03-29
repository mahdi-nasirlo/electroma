 <!-- BLog Start -->
 <div class="col-lg-8 col-md-6">
     <div class="row">
         <div style="position: absolute" class="px-4 card-body content pt-0">
             {!! $category->description !!}
         </div>
         @foreach ($posts as $post)
             @include('blog::post-cart', [
                 'post' => $post,
                 'class' => 'col-12 col-lg-6 col-md-6 mb-4 pb-2 entenal',
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
