        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
				
				<ul class="metismenu" id="menu">
                    <li class="{{ Route::currentRouteName() == 'dashboard' ? 'mm-active' : ''  }}">
                        <a class="has-arrow " href="{{route('dashboard')}}" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                    </li>
					<li class="{{ Route::currentRouteName() == 'category' ? 'mm-active' : ''  }}">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-043-menu"></i>
							<span class="nav-text">Categoria</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('categoryindex')}}">Gerenciar</a></li>
                            <li><a href="{{route('categorystore')}}">Adicionar</a></li>
                        </ul>
                    </li>
					<li class="{{ Route::currentRouteName() == 'service' ? 'mm-active' : ''  }}">
                        <a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="flaticon-093-waving"></i>
							<span class="nav-text">Serviços</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('serviceindex')}}">Gerenciar</a></li>
                            <li><a href="{{route('servicestore')}}">Adicionar</a></li>
                        </ul>
                    </li>
					<li class="{{ Route::currentRouteName() == 'post' ? 'mm-active' : ''  }}">
                        <a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="flaticon-022-copy"></i>
							<span class="nav-text">Postagens</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('postindex')}}">Gerenciar</a></li>
                            <li><a href="{{route('poststore')}}">Adicionar</a></li>
                        </ul>
                    </li>
					<li class="{{ Route::currentRouteName() == 'post' ? 'mm-active' : ''  }}">
                        <a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="flaticon-045-heart"></i>
							<span class="nav-text">Portifólio</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('portfolioindex')}}">Gerenciar</a></li>
                            <li><a href="{{route('portfoliostore')}}">Adicionar</a></li>
                        </ul>
                    </li>
					<li class="{{ Route::currentRouteName() == 'post' ? 'mm-active' : ''  }}">
                        <a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="flaticon-086-star"></i>
							<span class="nav-text">Empresa</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('enterpriseindex')}}">Visualisar</a></li>
                        </ul>
                    </li>
					<li class="{{ Route::currentRouteName() == 'post' ? 'mm-active' : ''  }}">
                        <a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="flaticon-043-menu"></i>
							<span class="nav-text">Outros</span>
						</a>
                        <ul aria-expanded="false">
                            @if (Auth::user()->level !== 2)
                            <li><a href="{{route('userindex')}}">Gerenciar Usuários</a></li>
                            <li><a href="{{route('userstore')}}">Adicionar Usuário</a></li>
                            @endif
                            <li><a href="{{route('teamindex')}}">Gerenciar Team</a></li>
                            <li><a href="{{route('aparenceindex')}}">Aparência</a></li>
                            <li><a href="{{route('faqindex')}}">Gerenciar FAQS</a></li>
                        </ul>
                    </li>
                </ul>
				<div class="plus-box">
					<p class="fs-14 font-w600 mb-2">Inside-Panel<br>Gerenciamento total<br></p>
					<p>Painel de gestão do website</p>
				</div>
				<div class="copyright">
					<p><strong>Inside Panel</strong> © 2022 All Rights Reserved</p>
					<p class="fs-12">Made with <span class="heart"></span> by Inside Linked</p>
				</div>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
