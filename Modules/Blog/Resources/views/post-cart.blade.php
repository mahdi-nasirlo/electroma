   <div class="col-12 col-lg-3 col-md-6 mb-4 pb-2">
       <div class="card blog rounded border-0 shadow">
           <div class="position-relative">
               <img height="200px" style="object-fit: cover" src="{{ asset('/storage/' . $post->image) }}"
                   class="card-img-top rounded-top" alt="..." />
               <div class="overlay rounded-top bg-dark"></div>
           </div>
           <div class="card-body content">
               <h5>
                   <a href="{{ route('blog.article.single', $post) }}" style="height: 66px"
                       class="card-title title text-dark">
                       {{ $post->title }}
                   </a>
               </h5>
               <div class="post-meta d-flex justify-content-between mt-3">
                   <ul class="list-unstyled mb-0 ps-0">
                       <li class="list-inline-item me-2 mb-0">
                           <a href="javascript:void(0)" class="text-muted like">
                               <x-font-eye style="height: 18px;width: 18px" />
                               {{ $post->view }}
                           </a>
                       </li>
                       <li class="list-inline-item">
                           <a href="javascript:void(0)" class="text-muted comments">
                               <x-font-comment-o style="height: 18px;width: 18px" />
                               {{ $post->comments->count() }}
                           </a>
                       </li>
                   </ul>
                   <a href="{{ route('blog.article.single', $post) }}" class="text-muted readmore">ادامه مطلب
                       <x-font-angle-left />
                   </a>
               </div>
           </div>
           <div class="author">
               <small class="text-light user d-block">
                   <x-font-user-circle class="mx-1" /></i>{{ $post->user->name }}
               </small>
               <small class="text-light date">
                   <x-icon-o-calendar />
                   {{ \Morilog\Jalali\Jalalian::forge($post->updated_at)->format('%A, %d %B %Y') }}
               </small>
           </div>
       </div>
   </div>
