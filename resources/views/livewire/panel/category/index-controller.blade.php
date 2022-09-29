<div>
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Categoria</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Lisrtagem</a></li>
        </ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Todas as Categorias</h4>
                    <button type="button" class="btn btn-primary" 
                        data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Adicionar Novo<span
                        class="btn-icon-end"><i class="fa fa-plus"></i></span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Relaciodos</th>
                                    <th>Status</th>
                                    <th>Data</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $item)
                                <tr>
                                    <td>{{$item['title']}} {{$item['published']}}</td>
                                    <td>{{$item->posts()->count()}} Registo(s)</td>
                                    <td><span class="badge light badge-{{($item['published'] === true)? 'success' : 'warning'}}">
                                        {{($item['published'] === true)? 'Publicado' : 'Pendente'}}</span></td>
                                    <td>{{$item['created_at']->diffForHumans()}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{route('categoryupdate', $item['key'])}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
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
