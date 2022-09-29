<div>
	<div class="row page-titles">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="javascript:void(0)">Categoria</a></li>
			<li class="breadcrumb-item"><a href="javascript:void(0)">Editar</a></li>
		</ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$Category['title']}}</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form wire:submit.prevent='update' class="needs-validation" novalidate >
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom01">Titulo
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <input wire:model='Category.title' type="text" class="form-control" id="validationCustom01"  placeholder="Tirulo da categoria" required>
                                            @error('Category.title') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                            <textarea wire:model='Category.body' class="form-control" id="validationCustom04"  rows="5" placeholder="Insira uma descrição" required></textarea>
                                            @error('Category.body') <span class="invalid-feedback">{{ $message }}</span>@enderror
                                            <div class="invalid-feedback">
                                                Por favor, precisa inserir uma breve Ddescrição
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom04">Descrição Completa</label>
                                        <div class="col-lg-10">
                                            <textarea wire:model='Category.description' class="form-control" rows="5" placeholder="Insira a descrição completa (opcional)"></textarea>
                                            @error('Category.description') <span class="invalid-feedback">{{ $message }}</span>@enderror
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
                                            <select wire:model='Category.parent' wire:change="filterChengeParentById" class="default-select wide form-control" id="validationCustom05">
                                                <option  Category-display="Selecionar">Selecionar</option>
                                                @foreach ($categoryParent->where('parent', null)->get() as $item)
                                                @if ($item->id == $Category['parent'])
                                                <option selected value="{{$item->id}}" wire:key="{{ $item->id}}">{{$item->title}}</option>
                                                @else
                                                <option value="{{$item->id}}" wire:key="{{ $item->id}}">{{$item->title}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('Category.parent') <span class="invalid-feedback">{{ $message }}</span>@enderror
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
                                            <select wire:model='Category.published' wire:change="filterChengeStatus" class="default-select wide form-control" id="validationCustom05">
                                                <option  Category-display="{{($Category['published'] == true) ? 'Publicado' : 'Rascunho'}} ">Selecionar</option>
                                                <option value='1'>Publicar</option>
                                                <option value='0'>Rascunho</option>
                                            </select>
                                            @error('Category.published') <span class="invalid-feedback">{{ $message }}</span>@enderror
                                            <div class="invalid-feedback">
                                                Please select a one.
                                            </div>
                                        </div>
                                    </div>
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
