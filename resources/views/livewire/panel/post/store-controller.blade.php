<div>
	<div class="row page-titles">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="javascript:void(0)">Postagens</a></li>
			<li class="breadcrumb-item"><a href="javascript:void(0)">Novo</a></li>
		</ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Formulário</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form wire:submit.prevent='submit' class="needs-validation" enctype="multipart/form-data" method="post" novalidate >
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom01">Titulo
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <input wire:model='post.title' type="text" class="form-control" id="validationCustom01"  placeholder="Titulo" required>
                                            @error('post.title') <span class="text-danger error">{{ $message }}</span>@enderror
                                            <div class="invalid-feedback">
                                                Por favor, informe um titulo para esta categoria
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom04">Breve Descrição <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <textarea wire:model.lazy='post.body' class="form-control" id="validationCustom04"  rows="5" placeholder="Insira uma descrição" required></textarea>
                                            @error('post.body') <span class="invalid-feedback">{{ $message }}</span>@enderror
                                            <div class="invalid-feedback">
                                                Por favor, precisa inserir uma breve Ddescrição
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom04">Descrição Completa</label>
                                        <div class="col-lg-10">
                                            <textarea wire:model.lazy='post.description' class="form-control" rows="5" placeholder="Insira a descrição completa (opcional)"></textarea>
                                            @error('post.description') <span class="invalid-feedback">{{ $message }}</span>@enderror
                                            <div class="invalid-feedback">
                                                Por favor, precisa inserir uma breve Ddescrição
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom05">Categoria Pai
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <select wire:model='post.category_id' class="default-select wide form-control" id="validationCustom05">
                                                <option  data-display="Selecionar">Selecionar</option>
                                                @foreach ($postCategory as $item)
                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                            @error('post.category_id') <span class="invalid-feedback">{{ $message }}</span>@enderror
                                            <div class="invalid-feedback">
                                                Please select a one.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom05">Status
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <select wire:model='post.published' class="default-select wide form-control" id="validationCustom05">
                                                <option  data-display="Selecionar">Selecionar</option>
                                                <option value="1">Publicar</option>
                                                <option value="0">Rascunho</option>
                                            </select>
                                            @error('post.published') <span class="invalid-feedback">{{ $message }}</span>@enderror
                                            <div class="invalid-feedback">
                                                Please select a one.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom05">Capa & Imagens adicionais
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-5">
                                            <input type="file" wire:model='cover' class="form-control" placeholder="Titulo" required>
                                            @error('cover') <span class="text-danger error">{{ $message }}</span>@enderror
                                            <div class="invalid-feedback">
                                                Por favor, informe um titulo para esta categoria
                                            </div>
                                            @error('cover') <span class="invalid-feedback">{{ $message }}</span>@enderror
                                            <div class="invalid-feedback">
                                                Please select a one.
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <input type="file" multiple wire:model='covers' class="form-control" placeholder="Titulo" required>
                                            @error('covers') <span class="text-danger error">{{ $message }}</span>@enderror
                                            <div class="invalid-feedback">
                                                Por favor, informe um titulo para esta categoria
                                            </div>
                                            @error('covers') <span class="invalid-feedback">{{ $message }}</span>@enderror
                                            <div class="invalid-feedback">
                                                Please select a one.
                                            </div>
                                        </div>
                                    </div>
                                    @if ($cover)
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom05">Previsualizações</label>
                                        <div class="col-lg-5">
                                            <div class="profile-interest">
                                                <h5 class="text-primary d-inline">Prever Capa</h5>
                                                @if ($cover || $covers)
                                                    <a href="#" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-10">
                                                        <img src="{{ $cover->temporaryUrl() }}" alt="" class="img-fluid mt-4 mb-4 w-100">
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="profile-interest">
                                                <h5 class="text-primary d-inline">Prever Relacionados (Máximo quatros arquivos)</h5>
                                                <div class="row mt-4 sp4" id="lightgallery">
                                                    @if ($covers)
                                                        @foreach ($covers as $item)
                                                            <a href="#" class="mb-1 col-lg-4 col-xl-6 col-sm-4 col-6">
                                                                <img src="{{ $item->temporaryUrl() }}" alt="" class="img-fluid">
                                                            </a>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Salvar<span
                                            class="btn-icon-end"><i class="fa fa-plus"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>