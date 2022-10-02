<div>
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Empresa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Visualisar</a></li>
        </ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="photo-content">
                        <div class="cover-photo rounded">
                            <img src="{{asset('storage/'. $enterprise['cover'])}}" alt="" class="img-fluid mb-3 w-100 rounded">
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-photo">
                            <img src="{{asset('storage/'. $enterprise['logo'])}}" class="img-fluid rounded-circle" alt="">
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">{{Str::ucfirst($enterprise->title)}}</h4>
                                <p>{{Str::ucfirst($enterprise->founder)}}</p>
                            </div>
                            <div class="dropdown ms-auto">
                                <a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i> Ver no Site</li>
                                    <a href="{{ route('enterpriseupdate', $enterprise->key) }}">
                                        <li class="dropdown-item"><i class="fa fa-edit text-primary me-2"></i>Editar Agora</li>
                                    </a>
                                    <a href="{{ route('partnerindex') }}">
                                        <li class="dropdown-item"><i class="fa fa-handshake text-primary me-2"></i>Adicionar Parceiro</li>
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4">
            <div class="row">

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-interest">
                                <h5 class="text-primary d-inline">Parceiros</h5>
                                <div class="row mt-4 sp4" id="lightgallery">
                                    @foreach ($partner as $item)
                                    <a href="{{asset('storage/'. $item->cover)}}" dlata-exthumbimage="{{asset('storage/'. $item->cover)}}" data-src="{{asset('storage/'. $item->cover)}}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                        <img src="{{asset('storage/'. $item->cover)}}" alt="" class="img-fluid">
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-blog">
                                <h4><a href="post-details.html" class="text-black">Missão</a></h4>
                                <p class="mb-0">{{$enterprise->mission}}</p>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-blog">
                                <h4><a href="post-details.html" class="text-black">Visão</a></h4>
                                <p class="mb-0">{{$enterprise->vision}}</p>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-blog">
                                <h4><a href="post-details.html" class="text-black">Valor</a></h4>
                                <p class="mb-0">{{$enterprise->value}}</p>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-blog">
                                <h4><a href="post-details.html" class="text-black"></a>Breve Descrição</h4>
                                <p class="mb-0">{{$enterprise->body}}</p>
                            </div>
                        </div>
                    </div>
                </div>
        
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="post-details">
                        <h3 class="mb-2 text-black">Historial</h3>
                       
                        <img src="{{asset('storage/'. $enterprise['cover'])}}" alt="" class="img-fluid mb-3 w-100 rounded">
                        <x-markdown>
                        {{ $enterprise->description }}
                        </x-markdown>
                        <div class="profile-skills mt-5 mb-5">
                            <h4 class="text-primary mb-2">Skills</h4>
                            @foreach ($services as $item)
                            <a href="javascript:void();;" class="btn btn-primary light btn-xs mb-1">{{$item->title}}</a>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
