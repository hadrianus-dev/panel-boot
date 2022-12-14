<div>
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">FAQS</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Lisrtagem</a></li>
        </ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Todas as FAQS</h4>
                    <a href="{{route('faqstore')}}" class="btn btn-primary">Adicionar Novo<span
                        class="btn-icon-end"><i class="fa fa-plus"></i></span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Pergunta</th>
                                    <th>Serviço Relaciondo</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($FAQ as $item)
                               
                                <tr>
                                    <td>{{Str::words($item['question'], 4, ' ...')}}</td>
                                    <td>{{$item->service->title}}</td>
                                    <td>{{$item['created_at']->diffForHumans()}}</td>
                                    <td><span class="badge light badge-{{($item['published'] === true)? 'success' : 'warning'}}">
                                        {{($item['published'] === true)? 'Publicado' : 'Pendente'}}</span></td>
                                    
                                   <td>
                                        <div class="d-flex">
                                            <a href="{{route('faqupdate', $item->key)}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="#" wire:click="checkDelete('{{$item->key}}')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
