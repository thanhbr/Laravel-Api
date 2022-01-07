
@if(empty(Auth::user())) return ''; @endif
{{-- <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-dark bg-primary navbar-shadow navbar-brand-center"> --}}
  <div class="navbar-wrapper">
    <div class="navbar-header">
      <ul class="nav navbar-nav">
        <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a href="#" class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="ft-menu font-large-1"></i></a></li>
        <li class="nav-item">
          <a href="/" class="navbar-brand">
            {{-- <img alt="upos logo" src="/images/icon_logo_upos.png" class="brand-logo" style="height: 32px"> --}}
            <svg width="36" height="37" viewBox="0 0 36 37" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M12.7152 0H27.7263C30.0221 0 32.053 0.89734 33.5541 2.42282L33.5121 2.46544C34.2846 3.1795 34.8872 4.14728 35.3201 5.11506C35.7616 6.19187 36.0265 7.26868 35.7616 8.43522V22.7927C35.7616 25.036 34.8786 27.1896 33.2892 28.8048L27.6379 34.4581C26.4017 35.6246 24.8123 36.3425 23.0463 36.3425H11.7439C11.2141 36.3425 10.6843 36.163 10.3311 35.8041C9.6247 35.0862 9.4481 33.7402 10.3311 32.8429L18.8079 24.2284C19.8675 23.2413 21.4569 23.2413 22.4282 24.2284L23.841 25.6641C25.607 27.4588 28.6092 26.2025 28.6092 23.69L28.5209 9.51203V9.15309V9.06336C28.4703 9.0119 28.4487 8.98995 28.4395 8.96366C28.4326 8.94411 28.4326 8.92216 28.4326 8.88389V8.79416C28.4326 8.74929 28.4106 8.70442 28.3885 8.65956C28.3664 8.61469 28.3443 8.56982 28.3443 8.52496C28.2635 8.36073 28.1827 8.19649 28.0343 8.03226L27.9912 8.07606C27.5497 7.71712 27.0199 7.44792 26.4901 7.44792L12.5386 7.35819C10.0662 7.35819 8.83002 10.4091 10.596 12.2038L12.0971 13.6396C13.0684 14.6266 13.0684 16.3316 12.0971 17.3187L3.53201 26.0229C2.82561 26.7407 1.766 26.7407 1.0596 26.2921C0.999448 26.2921 0.939294 26.2504 0.907057 26.1955C0.370132 25.8258 0 25.2368 0 24.4974V13.3704C0 11.2168 0.883002 9.15287 2.38411 7.71713L8.12362 1.88441C9.35982 0.717872 10.9492 0 12.7152 0Z" fill="#3DDBBC"/>
            </svg>

            <h2 class="brand-text">
              <svg width="73" height="29" viewBox="0 0 73 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M54.7644 3.21673C52.8217 1.24258 50.4376 0.255505 47.7003 0.255505C44.963 0.255505 42.5789 1.24258 40.6363 3.21673C40.6363 3.21673 40.548 3.30646 40.548 3.39619C41.431 4.56274 42.0491 5.72928 42.4023 7.07529C42.4906 6.89582 42.6672 6.71635 42.8438 6.53689C43.0204 6.35742 43.197 6.17795 43.3736 5.99848C44.6098 4.74221 46.1109 4.11407 47.7886 4.11407C49.5546 4.11407 50.9674 4.74221 52.2036 5.99848C53.4398 7.25476 54.0579 8.6905 54.0579 10.4852C54.0579 12.2799 53.4398 13.7156 52.2036 14.9719C50.9674 16.2282 49.4663 16.8563 47.7886 16.8563C46.1109 16.8563 44.6098 16.2282 43.3736 14.9719C43.197 14.7924 43.0204 14.6129 42.8438 14.3437L42.7555 14.254C42.5789 14.0745 42.4906 13.8053 42.314 13.6259C41.7842 12.7285 41.5193 11.7415 41.5193 10.6646C41.5193 10.5749 41.5193 10.4852 41.5193 10.3057C41.5193 7.52396 40.548 5.10114 38.6054 3.12699C36.6628 1.15284 34.2787 0.165771 31.5414 0.165771C28.8041 0.165771 26.42 1.15284 24.4774 3.12699C22.5348 5.10114 21.5635 7.52396 21.5635 10.3057C21.5635 10.5749 21.5635 10.9339 21.5635 11.1133V28.2525L25.2721 26.727V20.5354V18.1126V10.216C25.2721 8.4213 25.8902 6.98556 27.1264 5.72928C28.3626 4.473 29.8637 3.84487 31.5414 3.84487C33.3074 3.84487 34.7202 4.473 35.9564 5.72928C37.1926 6.98556 37.8107 8.51103 37.8107 10.216C37.8107 10.3057 37.8107 10.3057 37.8107 10.3954C37.8107 10.8441 37.8107 11.2031 37.899 11.6517C37.899 11.7415 37.899 11.7415 37.899 11.8312C37.9873 12.1901 37.9873 12.6388 38.0756 12.9977C38.5171 14.7027 39.4001 16.2282 40.6363 17.5742C42.5789 19.5483 44.963 20.5354 47.7003 20.5354C50.4376 20.5354 52.8217 19.5483 54.7644 17.5742C56.707 15.6 57.6783 13.1772 57.6783 10.3954C57.6783 7.61369 56.707 5.19088 54.7644 3.21673Z" fill="#272459"/>
                <path d="M35.9566 14.7027C34.7204 15.959 33.2193 16.5871 31.5415 16.5871C30.0404 16.5871 28.6276 16.0487 27.4797 15.0616V19.4586C28.7159 19.997 30.0404 20.2662 31.5415 20.2662C34.2789 20.2662 36.663 19.2791 38.6056 17.305C38.6939 17.2153 38.6939 17.2153 38.7822 17.1255C37.8992 15.959 37.2811 14.7027 36.9279 13.3567C36.663 13.8951 36.3098 14.3438 35.9566 14.7027Z" fill="#272459"/>
                <path d="M70.4817 10.0365C69.5987 9.40838 68.1859 8.78024 66.155 8.33157C64.7422 7.97263 63.8592 7.70343 63.506 7.43423C63.3294 7.34449 63.1528 7.16503 63.0645 6.98556C62.9762 6.71636 62.8879 6.44715 62.8879 6.08822C62.8879 5.63955 62.9762 5.28061 63.1528 4.92167C63.3294 4.65247 63.506 4.38327 63.7709 4.2038C64.3007 3.84487 64.9188 3.6654 65.7135 3.57566C66.155 3.57566 66.5082 3.6654 66.8614 3.75513C67.2146 3.84487 67.4795 4.02433 67.6561 4.2038C67.921 4.38327 68.0976 4.65247 68.1859 4.92167C68.3625 5.19088 68.4508 5.63955 68.4508 6.17795L72.0711 4.65247C71.9828 4.29354 71.8945 3.9346 71.7179 3.57566C71.3647 2.85779 70.8349 2.13992 70.1285 1.60152C69.5104 1.15285 68.8923 0.793909 68.0976 0.524707C67.3912 0.255505 66.5965 0.165771 65.8018 0.165771C64.9188 0.165771 64.1241 0.255505 63.3294 0.524707C62.5347 0.793909 61.8283 1.15285 61.2102 1.60152C60.5038 2.13992 59.974 2.76806 59.6208 3.57566C59.2676 4.38327 59.0027 5.19088 59.0027 6.17795C59.0027 7.07529 59.1793 7.8829 59.5325 8.60077C59.8857 9.22891 60.4155 9.85705 61.0336 10.3057C61.8283 10.8441 63.0645 11.3825 64.9188 11.8312C66.4199 12.1901 67.3912 12.5491 67.8327 12.908C68.0976 13.0875 68.1859 13.2669 68.3625 13.5361C68.5391 13.8053 68.5391 14.254 68.5391 14.7924C68.5391 15.1514 68.4508 15.4206 68.3625 15.6898C68.1859 15.959 68.0093 16.3179 67.7444 16.4974C67.4795 16.7666 67.1263 16.946 66.7731 17.0358C66.5965 17.1255 66.4199 17.1255 66.2433 17.2152C66.0667 17.2152 65.8018 17.305 65.6252 17.305C65.1837 17.305 64.8305 17.2152 64.4773 17.1255C64.1241 17.0358 63.7709 16.7666 63.506 16.5871C63.2411 16.3179 63.0645 16.0487 62.8879 15.7795C62.7113 15.5103 62.7113 15.1514 62.7113 14.7027L59.1793 16.2282C59.2676 16.5871 59.3559 16.8563 59.5325 17.2152C59.8857 17.9331 60.4155 18.5612 61.0336 19.1894C61.6517 19.7278 62.3581 20.1765 63.1528 20.4457H63.2411C64.0358 20.7149 64.9188 20.8943 65.8018 20.8943C66.6848 20.8943 67.4795 20.7149 68.3625 20.4457C69.1572 20.1765 69.9519 19.7278 70.57 19.1894C71.1881 18.651 71.7179 17.9331 72.0711 17.2152C72.4243 16.4974 72.6009 15.6898 72.6009 14.8822C72.6009 13.8951 72.4243 12.9977 72.0711 12.2799C71.6296 11.2031 71.0998 10.5749 70.4817 10.0365Z" fill="#272459"/>
                <path d="M16.1771 1.87058V4.92154V10.7543C16.1771 12.4592 15.559 13.8949 14.4111 15.0615C13.2632 16.228 11.8504 16.7664 10.261 16.8562C8.67156 16.8562 7.25875 16.228 6.11085 15.0615C4.96294 13.8949 4.34484 12.3695 4.34484 10.7543V3.66527V0.255371L0.63623 1.87058V4.83181V10.6645C0.63623 13.4463 1.60753 15.7794 3.55014 17.7535C5.40444 19.6379 7.61195 20.625 10.261 20.625C10.3493 20.625 10.3493 20.625 10.4376 20.625C10.5259 20.625 10.5259 20.625 10.6142 20.625C13.1749 20.5353 15.4707 19.5482 17.325 17.7535C19.2676 15.7794 20.2389 13.4463 20.2389 10.6645V3.66527V0.255371L16.1771 1.87058Z" fill="#272459"/>
              </svg>
            </h2>
          </a>
        </li>
        <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="fa fa-ellipsis-v"></i></a></li>
      </ul>
    </div>
    <div class="navbar-container content container-fluid px-1">
      <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
        <ul class="nav navbar-nav">
          <li class="nav-item hidden-sm-down d-non">
            <a id="menu-toggle" href="#" class="nav-link nav-menu-main menu-toggle hidden-xs d-none"><i class="ft-menu"></i>
            </a>
          </li>
          <li class="dropdown nav-item mega-dropdown d-none"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link">Mega</a>
            <ul class="mega-dropdown-menu dropdown-menu row">
              <li class="col-md-2">
                <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="fa fa-newspaper-o"></i> News</h6>
                <div id="mega-menu-carousel-example">
                  <div><img src="../../../app-assets/images/slider/slider-2.png" alt="First slide" class="rounded img-fluid mb-1"><a href="#" class="news-title mb-0">Poster Frame PSD</a>
                    <p class="news-content"><span class="font-small-2">January 26, 2016</span></p>
                  </div>
                </div>
              </li>
              <li class="col-md-3">
                <h6 class="dropdown-menu-header text-uppercase"><i class="fa fa-random"></i> Drill down menu</h6>
                <ul class="drilldown-menu">
                  <li class="menu-list">
                    <ul>
                      <li><a href="layout-2-columns.html" class="dropdown-item"><i class="ft-file"></i> Page layouts & Templates</a></li>
                      <li><a href="#"><i class="ft-align-left"></i> Multi level menu</a>
                        <ul>
                          <li><a href="#" class="dropdown-item"><i class="fa fa-bookmark-o"></i> Second level</a></li>
                          <li><a href="#"><i class="fa fa-lemon-o"></i> Second level menu</a>
                            <ul>
                              <li><a href="#" class="dropdown-item"><i class="fa fa-heart-o"></i> Third level</a></li>
                              <li><a href="#" class="dropdown-item"><i class="fa fa-file-o"></i> Third level</a></li>
                              <li><a href="#" class="dropdown-item"><i class="fa fa-trash-o"></i> Third level</a></li>
                              <li><a href="#" class="dropdown-item"><i class="fa fa-clock-o"></i> Third level</a></li>
                            </ul>
                          </li>
                          <li><a href="#" class="dropdown-item"><i class="fa fa-hdd-o"></i> Second level, third link</a></li>
                          <li><a href="#" class="dropdown-item"><i class="fa fa-floppy-o"></i> Second level, fourth link</a></li>
                        </ul>
                      </li>
                      <li><a href="color-palette-primary.html" class="dropdown-item"><i class="ft-camera"></i> Color pallet system</a></li>
                      <li><a href="sk-2-columns.html" class="dropdown-item"><i class="ft-edit"></i> Page starter kit</a></li>
                      <li><a href="changelog.html" class="dropdown-item"><i class="ft-minimize-2"></i> Change log</a></li>
                      <li><a href="http://support.pixinvent.com/" class="dropdown-item"><i class="fa fa-life-ring"></i> Customer support center</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="col-md-3">
                <h6 class="dropdown-menu-header text-uppercase"><i class="fa fa-list-ul"></i> Accordion</h6>
                <div id="accordionWrap" role="tablist" aria-multiselectable="true">
                  <div class="card no-border box-shadow-0 collapse-icon accordion-icon-rotate">
                    <div id="headingOne" role="tab" class="card-header p-0 pb-2 no-border"><a data-toggle="collapse" data-parent="#accordionWrap" href="#accordionOne" aria-expanded="true" aria-controls="accordionOne">Accordion Item #1</a></div>
                    <div id="accordionOne" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true" class="card-collapse collapse in">
                      <div class="card-body">
                        <p class="accordion-text text-small-3">Caramels dessert chocolate cake pastry jujubes bonbon. Jelly wafer jelly beans. Caramels chocolate cake liquorice cake wafer jelly beans croissant apple pie.</p>
                      </div>
                    </div>
                    <div id="headingTwo" role="tab" class="card-header p-0 pb-2 no-border"><a data-toggle="collapse" data-parent="#accordionWrap" href="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo" class="collapsed">Accordion Item #2</a></div>
                    <div id="accordionTwo" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" class="card-collapse collapse">
                      <div class="card-body">
                        <p class="accordion-text">Sugar plum bear claw oat cake chocolate jelly tiramisu dessert pie. Tiramisu macaroon muffin jelly marshmallow cake. Pastry oat cake chupa chups.</p>
                      </div>
                    </div>
                    <div id="headingThree" role="tab" class="card-header p-0 pb-2 no-border"><a data-toggle="collapse" data-parent="#accordionWrap" href="#accordionThree" aria-expanded="false" aria-controls="accordionThree" class="collapsed">Accordion Item #3</a></div>
                    <div id="accordionThree" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false" class="card-collapse collapse">
                      <div class="card-body">
                        <p class="accordion-text">Candy cupcake sugar plum oat cake wafer marzipan jujubes lollipop macaroon. Cake dragée jujubes donut chocolate bar chocolate cake cupcake chocolate topping.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="col-md-4">
                <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="fa fa-envelope-o"></i> Contact Us</h6>
                <form>
                  <fieldset class="form-group">
                    <label for="inputName1" class="col-sm-3 form-control-label">Name</label>
                    <div class="col-sm-9">
                      <div class="position-relative has-icon-left">
                        <input type="text" id="inputName1" placeholder="John Doe" class="form-control">
                        <div class="form-control-position"><i class="fa fa-user-o pl-1"></i></div>
                      </div>
                    </div>
                  </fieldset>
                  <fieldset class="form-group">
                    <label for="inputEmail1" class="col-sm-3 form-control-label">Email</label>
                    <div class="col-sm-9">
                      <div class="position-relative has-icon-left">
                        <input type="email" id="inputEmail1" placeholder="john@example.com" class="form-control">
                        <div class="form-control-position pl-1"><i class="fa fa-envelope-o"></i></div>
                      </div>
                    </div>
                  </fieldset>
                  <fieldset class="form-group">
                    <label for="inputMessage1" class="col-sm-3 form-control-label">Message</label>
                    <div class="col-sm-9">
                      <div class="position-relative has-icon-left">
                        <textarea id="inputMessage1" rows="2" placeholder="Simple Textarea" class="form-control"></textarea>
                        <div class="form-control-position pl-1"><i class="fa fa-commenting-o"></i></div>
                      </div>
                    </div>
                  </fieldset>
                  <div class="col-sm-12 mb-1">
                    <button type="button" class="btn btn-primary float-xs-right"><i class="fa fa-paper-plane-o"></i> Send</button>
                  </div>
                </form>
              </li>
            </ul>
          </li>
          <li class="nav-item nav-search d-none"><a href="#" class="nav-link nav-link-search"><i class="ficon ft-search"></i></a>
            <div class="search-input">
              <input type="text" placeholder="Explore CRM" name="txt-reseaching" class="input">
            </div>
          </li>
          <li class="nav-item navbar-more">
            <a class="nav-link">
              @yield('navbar-more')
            </a>
          </li>
        </ul>
        <ul class="nav navbar-nav float-xs-right">
          <li class="dropdown nav-item d-none">
            <a href="#" class="nav-link nav-link-expand"><i class="ficon ft-maximize"></i></a>
          </li>
          <li class="dropdown dropdown-language nav-item d-none">
            <a id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link"><i class="flag-icon flag-icon-vn"></i><span class="selected-language"></span></a>
            <div aria-labelledby="dropdown-flag" class="dropdown-menu d-none">
              <a href="#" class="dropdown-item"><i class="flag-icon flag-icon-gb"></i> English</a>
              <a href="#" class="dropdown-item"><i class="flag-icon flag-icon-fr"></i> French</a>
              <a href="#" class="dropdown-item"><i class="flag-icon flag-icon-cn"></i> Chinese</a>
              <a href="#" class="dropdown-item"><i class="flag-icon flag-icon-de"></i> German</a>
            </div>
          </li>
          <li class="dropdown dropdown-notification nav-item d-none"><a href="#" data-toggle="dropdown" class="nav-link nav-link-label"><i class="ficon ft-bell"></i><span class="tag tag-pill tag-default tag-danger tag-default tag-up">5</span></a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
              <li class="dropdown-menu-header">
                <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span><span class="notification-tag tag tag-default tag-danger float-xs-right m-0">5 New</span></h6>
              </li>
              <li class="list-group scrollable-container"><a href="javascript:void(0)" class="list-group-item">
                  <div class="media">
                    <div class="media-left valign-middle"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                    <div class="media-body">
                      <h6 class="media-heading">You have new order!</h6>
                      <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit amet, consectetuer elit.</p><small>
                        <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">30 minutes ago</time></small>
                    </div>
                  </div></a><a href="javascript:void(0)" class="list-group-item">
                  <div class="media">
                    <div class="media-left valign-middle"><i class="ft-download-cloud icon-bg-circle bg-red bg-darken-1"></i></div>
                    <div class="media-body">
                      <h6 class="media-heading red darken-1">99% Server load</h6>
                      <p class="notification-text font-small-3 text-muted">Aliquam tincidunt mauris eu risus.</p><small>
                        <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Five hour ago</time></small>
                    </div>
                  </div></a><a href="javascript:void(0)" class="list-group-item">
                  <div class="media">
                    <div class="media-left valign-middle"><i class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i></div>
                    <div class="media-body">
                      <h6 class="media-heading yellow darken-3">Warning notifixation</h6>
                      <p class="notification-text font-small-3 text-muted">Vestibulum auctor dapibus neque.</p><small>
                        <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Today</time></small>
                    </div>
                  </div></a><a href="javascript:void(0)" class="list-group-item">
                  <div class="media">
                    <div class="media-left valign-middle"><i class="ft-check-circle icon-bg-circle bg-cyan"></i></div>
                    <div class="media-body">
                      <h6 class="media-heading">Complete the task</h6><small>
                        <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Last week</time></small>
                    </div>
                  </div></a><a href="javascript:void(0)" class="list-group-item">
                  <div class="media">
                    <div class="media-left valign-middle"><i class="ft-file icon-bg-circle bg-teal"></i></div>
                    <div class="media-body">
                      <h6 class="media-heading">Generate monthly report</h6><small>
                        <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Last month</time></small>
                    </div>
                  </div></a></li>
              <li class="dropdown-menu-footer"><a href="javascript:void(0)" class="dropdown-item text-muted text-xs-center">Read all notifications</a></li>
            </ul>
          </li>
          <li class="dropdown dropdown-notification nav-item d-none"><a href="#" data-toggle="dropdown" class="nav-link nav-link-label"><i class="ficon ft-mail"></i><span class="tag tag-pill tag-default tag-warning tag-default tag-up">3</span></a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
              <li class="dropdown-menu-header">
                <h6 class="dropdown-header m-0"><span class="grey darken-2">Messages</span><span class="notification-tag tag tag-default tag-warning float-xs-right m-0">4 New</span></h6>
              </li>
              <li class="list-group scrollable-container"><a href="javascript:void(0)" class="list-group-item">
                  <div class="media">
                    <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="../../../app-assets/images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span></div>
                    <div class="media-body">
                      <h6 class="media-heading">Margaret Govan</h6>
                      <p class="notification-text font-small-3 text-muted">I like your portfolio, let's start the project.</p><small>
                        <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Today</time></small>
                    </div>
                  </div></a><a href="javascript:void(0)" class="list-group-item">
                  <div class="media">
                    <div class="media-left"><span class="avatar avatar-sm avatar-busy rounded-circle"><img src="../../../app-assets/images/portrait/small/avatar-s-2.png" alt="avatar"><i></i></span></div>
                    <div class="media-body">
                      <h6 class="media-heading">Bret Lezama</h6>
                      <p class="notification-text font-small-3 text-muted">I have seen your work, there is</p><small>
                        <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Tuesday</time></small>
                    </div>
                  </div></a><a href="javascript:void(0)" class="list-group-item">
                  <div class="media">
                    <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="../../../app-assets/images/portrait/small/avatar-s-3.png" alt="avatar"><i></i></span></div>
                    <div class="media-body">
                      <h6 class="media-heading">Carie Berra</h6>
                      <p class="notification-text font-small-3 text-muted">Can we have call in this week ?</p><small>
                        <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">Friday</time></small>
                    </div>
                  </div></a><a href="javascript:void(0)" class="list-group-item">
                  <div class="media">
                    <div class="media-left"><span class="avatar avatar-sm avatar-away rounded-circle"><img src="../../../app-assets/images/portrait/small/avatar-s-6.png" alt="avatar"><i></i></span></div>
                    <div class="media-body">
                      <h6 class="media-heading">Eric Alsobrook</h6>
                      <p class="notification-text font-small-3 text-muted">We have project party this saturday night.</p><small>
                        <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">last month</time></small>
                    </div>
                  </div></a></li>
              <li class="dropdown-menu-footer"><a href="javascript:void(0)" class="dropdown-item text-muted text-xs-center">Read all messages</a></li>
            </ul>
          </li>
          <li class="dropdown dropdown-user nav-item">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link">
              <span class="avatar avatar-online">
                <img src="{{url('app-assets/images/portrait/small/avatar-s-1.png')}}" alt="avatar"><i></i></span>
                <span class="user-name">{{Auth::user()->name ?? ''}}</span>
              </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="#" class="dropdown-item">
                <i class="flag-icon flag-icon-vn"></i> 
                {{env('APP_VERSION')}}
                @if(env('APP_ENV') !== 'production') {{env('APP_ENV')}} @endif
              </a>
              <a href="{{ url('/users/'.Auth::user()->__get('id'))}}" class="dropdown-item"><i class="ft-user"></i>{!! trans('titles.profile') !!}</a>
              
              <a href="#" class="dropdown-item d-none"><i class="ft-check-square"></i></a>
              <a href="#" class="dropdown-item d-none"><i class="ft-comment-square"></i> Chats</a>
              <div class="dropdown-divider"></div>
              <a href="{{route('logout')}}" class="dropdown-item"><i class="ft-power"></i>{!! trans('titles.logout') !!}</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
{{-- </nav> --}}