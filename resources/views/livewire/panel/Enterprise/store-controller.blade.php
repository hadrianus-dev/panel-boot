<div>
	<div class="row page-titles">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="javascript:void(0)">Enterprise</a></li>
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
                        <form wire:submit.prevent='submit' class="needs-validation" enctype="multipart/form-data" method="enterprise" novalidate >
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom01">Titulo
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <input wire:model='enterprise.title' type="text" class="form-control" id="validationCustom01"  placeholder="Titulo" required>
                                            @error('enterprise.title') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom01">Fundador(es)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <input wire:model='enterprise.founder' type="text" class="form-control" id="validationCustom01"  placeholder="Titulo" required>
                                            @error('enterprise.founder') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom04">Breve Descrição <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <textarea wire:model.lazy='enterprise.body' class="form-control" id="validationCustom04"  rows="10" placeholder="Insira uma descrição" required></textarea>
                                            @error('enterprise.body') <span class="invalid-feedback">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom04">Descrição Completa</label>
                                        <div class="col-lg-10">
                                            <textarea wire:model.lazy='enterprise.description' class="form-control" rows="12" placeholder="Insira a descrição completa (opcional)"></textarea>
                                            @error('enterprise.description') <span class="invalid-feedback">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom01">Missão
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <textarea wire:model.lazy='enterprise.mission' class="form-control" rows="6" placeholder="Insira a descrição completa (opcional)"></textarea>
                                            @error('enterprise.mission') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom01">Visão
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <textarea wire:model.lazy='enterprise.vision' class="form-control" rows="6" placeholder="Insira a descrição completa (opcional)"></textarea>
                                            @error('enterprise.vision') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom01">Valores
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <textarea wire:model.lazy='enterprise.value' class="form-control" rows="6" placeholder="Insira a descrição completa (opcional)"></textarea>
                                            @error('enterprise.value') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom01">Email(s)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-5">
                                            <input wire:model='enterprise.general_email' type="email" class="form-control" id="validationCustom01"  placeholder="Titulo" required>
                                            @error('enterprise.general_email') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-lg-5">
                                            <input wire:model='enterprise.comercial_email' type="email" class="form-control" id="validationCustom01"  placeholder="Titulo" required>
                                            @error('enterprise.comercial_email') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom01">Contacto(s)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-5">
                                            <input wire:model='enterprise.general_phone' type="text" class="form-control" id="validationCustom01"  placeholder="Telefone" required>
                                            @error('enterprise.general_phone') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-lg-5">
                                            <input wire:model='enterprise.comercial_phone' type="text" class="form-control" id="validationCustom01"  placeholder="Telemóvel" required>
                                            @error('enterprise.comercial_phone') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-2 col-form-label" for="validationCustom05">Status
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-10">
                                            <select wire:model='enterprise.published' class="default-select wide form-control" id="validationCustom05">
                                                <option  data-display="Selecionar">Selecionar</option>
                                                <option value="1">Publicar</option>
                                                <option value="0">Rascunho</option>
                                            </select>
                                            @error('enterprise.published') <span class="invalid-feedback">{{ $message }}</span>@enderror
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
                                            <input type="file" wire:model='covers' class="form-control" placeholder="Titulo" required>
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
                                        <div class="col-lg-3">
                                            <div class="profile-interest">
                                                @if ($cover)
                                                <h5 class="text-primary d-inline">Prever logo</h5>
                                                    <a href="#" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-10">
                                                        <img src="{{ $cover->temporaryUrl() }}" alt="" class="img-fluid mt-4 mb-4 w-100">
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="profile-interest">
                                                @if ($covers)
                                                <h5 class="text-primary d-inline">Prever Capa</h5>
                                                    <a href="#" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-10">
                                                        <img src="{{ $covers->temporaryUrl() }}" alt="" class="img-fluid mt-4 mb-4 w-100">
                                                    </a>
                                                @endif
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