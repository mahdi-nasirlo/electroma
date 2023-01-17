 <!-- BLog Start -->
 <div class="col-lg-8 col-md-6">
     <div class="row">
         <div class="px-4 card-body content">
             {!! $category->description !!}
         </div>
         @foreach ($posts as $post)
             @include('home.post-cart', ['post' => $post])
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
