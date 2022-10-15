
<div class="row">

    					
    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
        <div class="widget-stat card">
            <div class="card-body p-4">
                <div class="media ai-icon">
                    <span class="me-3 bgl-primary text-primary">
                        <!-- <i class="ti-user"></i> -->
                        <svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <div class="media-body">
                        <p class="mb-1">Média de Visitas</p>
                        <h4 class="mb-0">{{number_format($visitors->where('referer', null)->count() / $visitors->count(), 2, '.') }}</h4>
                        <span class="badge badge-primary">media</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
        <div class="widget-stat card">
            <div class="card-body p-4">
                <div class="media ai-icon">
                    <span class="me-3 bgl-warning text-warning">
                        <svg id="icon-orders" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                    </span>
                    <div class="media-body">
                        <p class="mb-1">Visitas por Páginas</p>
                        <h4 class="mb-0">{{number_format($visitors->count() / $visitors->where('referer', null)->count(), 2, '.')}}</h4>
                        <span class="badge badge-warning">media</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-xxl-6 col-lg-6">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h4 class="card-title">Timeline</h4>
            </div>
            <div class="card-body">
                <div id="DZ_W_TimeLine" class="widget-timeline dlab-scroll height370">
                    <ul class="timeline">
                        
                        @foreach ($posts->where('published', true)->orderBy('created_at', 'desc')->limit(10)->get() as $post) 
                        @if ($post->visitLogs()->count() >= 5)
                        <li>
                            <div class="timeline-badge primary">
                            </div>
                            <a class="timeline-panel text-muted" href="{{env('SITE_URL').'post/'. $post->slug}}">
                                <span>Publicado a: {{$post->created_at->diffForHumans()}}</span>
                                <h6 class="mb-0">{{Str::words($post->title, 3, '...')}} <strong class="text-primary">#Views. {{$post->visitLogs()->count()}}</strong></h6>
                                <p class="mb-0">{{Str::words($post->body, 10, '...')}}</p>
                            </a>
                        </li>
                        @else
                        <li>
                            <div class="timeline-badge primary">
                            </div>
                            <a class="timeline-panel text-muted" target="_blank" href="{{env('SITE_URL').'post/'. $post->slug}}">
                                <span>Publicado a: {{$post->created_at->diffForHumans()}}</span>
                                <h6 class="mb-0">{{Str::words($post->title, 3, '...')}} <strong class="text-primary">#Views. {{$post->visitLogs()->count()}}</strong></h6>
                                <p class="mb-0">{{Str::words($post->body, 10, '...')}}</p>
                            </a>
                        </li>
                        @endif
                        @endforeach 

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-xxl-6 col-lg-6">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h4 class="card-title">Interações</h4>
            </div>
            <div class="card-body">
                <div id="DZ_W_TimeLine11" class="widget-timeline dlab-scroll style-1 height370">
                    <ul class="timeline">
                        @foreach ($comments->with(['post'])->orderBy('created_at', 'desc')->limit(10)->get() as $comment) 
                        <li>
                            <div class="timeline-badge primary"></div>
                            <a class="timeline-panel text-muted" target="_blank" href="{{env('SITE_URL').'post/'. $comment->post->slug}}">
                                <span>{{$comment->created_at->diffForHumans()}}</span>
                                <h6 class="mb-0">{{Str::words($comment->body, 10, '...')}}<strong class="text-primary"></strong>.</h6>
                            </a>
                        </li>
                        @endforeach
                      
                    </ul>
                </div>
            </div>
        </div>
    </div>



{{-- 
    <div class="col-xl-6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row separate-row">
                            <div class="col-sm-6">
                                <div class="job-icon pb-4 d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">342</h2>
                                            <span class="text-success ms-3">+0.5 %</span>
                                        </div>	
                                        <span class="fs-14 d-block mb-2">Interview Schedules</span>
                                    </div>	
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="job-icon pb-4 pt-4 pt-sm-0 d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">984</h2>
                                        </div>	
                                        <span class="fs-14 d-block mb-2">Application Sent</span>
                                    </div>	
                                    <div id="NewCustomers1"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="job-icon pt-4 pb-sm-0 pb-4 pe-3 d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">1,567k</h2>
                                            <span class="text-danger ms-3">-2 % </span>
                                        </div>	
                                        <span class="fs-14 d-block mb-2">Profile Viewed</span>
                                    </div>	
                                    <div id="NewCustomers2"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="job-icon pt-4  d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">437</h2>
                                        </div>	
                                        <span class="fs-14 d-block mb-2">Unread Messages</span>
                                    </div>	
                                    <div id="NewCustomers3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card "  id="user-activity">
                    <div class="card-header border-0 pb-0 flex-wrap">
                        <h4 class="fs-20 mb-1">Vacany Stats</h4>
                        <div class="card-action coin-tabs mt-3 mt-sm-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link " data-bs-toggle="tab" href="#Daily" role="tab">Daily</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-bs-toggle="tab" href="#weekly" role="tab" >Weekly</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#monthly" role="tab" >Monthly</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="pb-4 d-flex flex-wrap">
                            <span class="d-flex align-items-center">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                  <rect  width="13" height="13" rx="6.5" fill="#35c556"/>
                                </svg>
                                Application Sent	
                            </span>
                            <span class="application d-flex align-items-center">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                  <rect  width="13" height="13" rx="6.5" fill="#3f4cfe"/>
                                </svg>

                                Interviews	
                            </span>
                            <span class="application d-flex align-items-center">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                  <rect  width="13" height="13" rx="6.5" fill="#f34040"/>
                                </svg>

                                Rejected
                            </span>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="Daily">
                                <canvas id="activity" height="115"></canvas>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
    

        </div>
    </div>
    <div class="col-xl-6">
        <div class="row">
            
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="fs-20 mb-3">Recent Activity</h4>
                        <div>	
                            <select class="default-select dashboard-select">
                              <option data-display="newest">newest</option>
                              
                              <option value="2">oldest</option>
                            </select>
                            <div class="dropdown custom-dropdown mb-0">
                                <div class="btn sharp tp-btn dark-btn" data-bs-toggle="dropdown">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#342E59" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#342E59" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#342E59" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0);">Details</a>
                                    <a class="dropdown-item text-danger" href="javascript:void(0);">Cancel</a>
                                </div>
                            </div>
                        </div>	
                    </div>
                    <div class="card-body loadmore-content  recent-activity-wrapper" id="RecentActivityContent">
                        <div class="d-flex recent-activity">
                            <span class="me-3 activity">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                  <circle  cx="8.5" cy="8.5" r="8.5" fill="#f93a0b"/>
                                </svg>
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71">
                                  <g  transform="translate(-457 -443)">
                                    <rect  width="71" height="71" rx="12" transform="translate(457 443)" fill="#c5c5c5"/>
                                    <g  transform="translate(457 443)">
                                      <rect  data-name="placeholder" width="71" height="71" rx="12" fill="#2769ee"/>
                                      <circle  data-name="Ellipse 12" cx="18" cy="18" r="18" transform="translate(15 20)" fill="#fff"/>
                                      <circle  data-name="Ellipse 11" cx="11" cy="11" r="11" transform="translate(36 15)" fill="#ffe70c" style="mix-blend-mode: multiply;isolation: isolate"/>
                                    </g>
                                  </g>
                                </svg>
                            </span>
                            <div class="ms-3">
                                <h5 class="mb-1">Bubles Studios have 5 available positions for you</h5>
                                <span>8min ago</span>
                            </div>
                        </div>
                        <div class="d-flex recent-activity">
                            <span class="me-3 activity">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                  <circle  cx="8.5" cy="8.5" r="8.5" fill="#a1a1a1"/>
                                </svg>
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71">
                                      <g  transform="translate(-457 -443)">
                                        <rect  width="71" height="71" rx="12" transform="translate(457 443)" fill="#c5c5c5"/>
                                        <g  transform="translate(457 443)">
                                          <rect  data-name="placeholder" width="71" height="71" rx="12" fill="#eeac27"/>
                                          <circle  data-name="Ellipse 12" cx="18" cy="18" r="18" transform="translate(15 20)" fill="#fff"/>
                                          <circle  data-name="Ellipse 11" cx="11" cy="11" r="11" transform="translate(36 15)" fill="#ffe70c" style="mix-blend-mode: multiply;isolation: isolate"/>
                                        </g>
                                      </g>
                                </svg>
                            </span>
                            <div class="ms-3">
                                <h5 class="mb-1">Elextra Studios has invited you to interview meeting tomorrow</h5>
                                <span>8min ago</span>
                            </div>
                        </div>
                        <div class="d-flex recent-activity">
                            <span class="me-3 activity">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                  <circle  cx="8.5" cy="8.5" r="8.5" fill="#a1a1a1"/>
                                </svg>
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71">
                                      <g  transform="translate(-457 -443)">
                                        <rect  width="71" height="71" rx="12" transform="translate(457 443)" fill="#c5c5c5"/>
                                        <g  transform="translate(457 443)">
                                          <rect  data-name="placeholder" width="71" height="71" rx="12" fill="#22bc32"/>
                                          <circle  data-name="Ellipse 12" cx="18" cy="18" r="18" transform="translate(15 20)" fill="#fff"/>
                                          <circle  data-name="Ellipse 11" cx="11" cy="11" r="11" transform="translate(36 15)" fill="#ffe70c" style="mix-blend-mode: multiply;isolation: isolate"/>
                                        </g>
                                      </g>
                                </svg>
                            </span>
                            <div class="ms-3">
                                <h5 class="mb-1">Highspeed Design Team have 2 available positions for you</h5>
                                <span>8min ago</span>
                            </div>
                        </div>
                        <div class="d-flex recent-activity">
                            <span class="me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                  <circle  cx="8.5" cy="8.5" r="8.5" fill="#a1a1a1"/>
                                </svg>
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="71" height="71" viewBox="0 0 71 71">
                                      <g  transform="translate(-457 -443)">
                                        <rect  width="71" height="71" rx="12" transform="translate(457 443)" fill="#c5c5c5"/>
                                        <g  transform="translate(457 443)">
                                          <rect  data-name="placeholder" width="71" height="71" rx="12" fill="#9933cb"/>
                                          <circle  data-name="Ellipse 12" cx="18" cy="18" r="18" transform="translate(15 20)" fill="#fff"/>
                                          <circle  data-name="Ellipse 11" cx="11" cy="11" r="11" transform="translate(36 15)" fill="#ffe70c" style="mix-blend-mode: multiply;isolation: isolate"/>
                                        </g>
                                      </g>
                                </svg>
                            </span>
                            <div class="ms-3">
                                <h5 class="mb-1">Kleon Studios have 5 available positions for you</h5>
                                <span>8min ago</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-0 m-auto pt-0">
                        <a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded m-auto dlab-load-more" id="RecentActivity" rel="ajax/recentactivity.html">View more</a>
                    </div>
                </div>
            </div>
           
        </div>
    </div> --}}
</div>	

