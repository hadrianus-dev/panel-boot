<div>
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Portifólio</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Lisrtagem</a></li>
        </ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Todas os Portifólio</h4>
                    <a href="{{route('portfoliostore')}}" class="btn btn-primary">Adicionar Novo<span
                        class="btn-icon-end"><i class="fa fa-plus"></i></span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th></th> 
                                    <th>Titulo</th>
                                    <th>Views</th>
                                    <th>Serviço</th>
                                    <th>Relacionados</th>
                                    <th>Status</th>
                                    <th>Data</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($portfolio as $item)   
                                <tr>
                                    <td><img class="" width="35" src="{{asset('storage/'.$item['cover'])}}" alt="NULL"></td>
                                    <td>{{$item['title']}}</td>
                                    <td>{{$item->visitLogs()->count()}} Views</td>
                                    <td>{{$item->service->title}}</td>
                                    <td>{{$item->gallery()->count()}} Arquivo(s)</td>
                                    <td><span class="badge light badge-{{($item['published'] === true)? 'success' : 'warning'}}">
                                        {{($item['published'] === true)? 'Publicado' : 'Pendente'}}</span></td>
                                    <td>{{$item['created_at']->diffForHumans()}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{route('portfolioupdate', $item['key'])}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="#" wire:click="checkDelete('{{$item['key']}}')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>												
                                    </td>												
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
