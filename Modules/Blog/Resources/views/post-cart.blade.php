   {{-- <div class="col-lg-6 mt-4 pt-2">
       <div class="card blog rounded border-0 shadow">
           <div style="width: 100%; height: 30%;" class="position-relative">
               <a href="{{ route('article.single', $post) }}">
                   <img style="height: 100%" src="{{ asset('storage/' . $post->image) }}"
                       class="card-img-top rounded-top" alt="...">
                   <div class="overlay rounded-top bg-dark"></div>
               </a>
           </div>
           <div class="card-body content">
               <h5><a href="{{ route('article.single', $post) }}" class="card-title title text-dark">
                       {{ $post->title }}
                   </a></h5>
               <div class="post-meta d-flex justify-content-between mt-3">
                   <ul class="list-unstyled mb-0 ps-0">
                       <li class="list-inline-post me-2 mb-0">
                           <a href="javascript:void(0)" class="text-muted like">
                               <i class="uil uil-eye"></i>{{ $post->view }}</a>
                       </li>
                       <li class="list-inline-post">
                           <a href="javascript:void(0)" class="text-muted comments"><i class="uil uil-comment me-1">
                                   {{ $post->comments->count() }}
                               </i>
                           </a>
                       </li>
                   </ul>
                   <a href="{{ route('article.single', $post) }}" class="text-muted readmore">ادامه
                       مطلب
                       <i class="uil uil-angle-left-b align-middle"></i></a>
               </div>
           </div>
           <div class="author">
               <small class="text-light user d-block"><i class="uil uil-user"></i>
                   {{ $post->user->name }}
               </small>
               <small class="text-light date"><i class="uil uil-calendar-alt"></i>
               </small>
           </div>
       </div>
   </div> --}}

   <div class="col-lg-6 col-md-12 mb-4 pb-2">
       <div class="card blog rounded border-0 shadow">
           <div class="position-relative">
               <img height="200px" src="{{ asset('/storage/' . $post->image) }}" class="card-img-top rounded-top"
                   alt="..." />
               <div class="overlay rounded-top bg-dark"></div>
           </div>
           <div class="card-body content">
               <h5>
                   <a href="{{ route('blog.article.single', $post) }}" class="card-title title text-dark">
                       {{ $post->title }}
                   </a>
               </h5>
               <div class="post-meta d-flex justify-content-between mt-3">
                   <ul class="list-unstyled mb-0 ps-0">
                       <li class="list-inline-item me-2 mb-0">
                           <a href="javascript:void(0)" class="text-muted like"><i
                                   class="uil uil-eye me-1"></i>{{ $post->view }}</a>
                       </li>
                       <li class="list-inline-item">
                           <a href="javascript:void(0)" class="text-muted comments"><i
                                   class="uil uil-comment me-1"></i>{{ $post->comments->count() }}</a>
                       </li>
                   </ul>
                   <a href="{{ route('blog.article.single', $post) }}" class="text-muted readmore">ادامه مطلب
                       <i class="uil uil-angle-left-b align-middle"></i></a>
               </div>
           </div>
           <div class="author">
               <small class="text-light user d-block"><i class="uil uil-user"></i>{{ $post->user->name }}</small>
               <small class="text-light date"><i class="uil uil-calendar-alt"></i>
                   {{ \Morilog\Jalali\Jalalian::forge($post->updated_at)->format('%A, %d %B %Y') }}
               </small>
           </div>
       </div>
   </div>
