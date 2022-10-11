<!-- Modal -->
<div wire.ignore.self class="modal fade" id="exampleModalCenter">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nova Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="form-validation">
                    <form class="needs-validation" novalidate >
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label" for="validationCustom01">Titulo
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input wire:model='category.title' type="text" class="form-control" id="validationCustom01"  placeholder="Titulo" required>
                                        @error('category.title') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                        <textarea wire:model='category.body' class="form-control" id="validationCustom04"  rows="5" placeholder="Insira uma descrição" required></textarea>
                                        <div class="invalid-feedback">
                                            Por favor, precisa inserir uma breve Ddescrição
                                            @error('category.body') <span class="invalid-feedback">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label" for="validationCustom04">Descrição Completa</label>
                                    <div class="col-lg-10">
                                        <textarea wire:model='category.description' class="form-control" rows="5" placeholder="Insira a descrição completa (opcional)"></textarea>
                                        <div class="invalid-feedback">
                                            Por favor, precisa inserir uma breve Ddescrição
                                            @error('category.description') <span class="invalid-feedback">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-form-label" for="validationCustom05">Categoria Pai
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select wire:model='category.parent' class="default-select wide form-control" id="validationCustom05">
                                            <option  data-display="Selecionar">Selecionar</option>
                                            <option value="html">HTML</option>
                                            <option value="css">CSS</option>
                                        </select>
                                        @error('category.parent') <span class="invalid-feedback">{{ $message }}</span>@enderror
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
                                        <select wire:model='category.published' class="default-select wide form-control" id="validationCustom05">
                                            <option  data-display="Selecionar">Selecionar</option>
                                            <option value="html">HTML</option>
                                            <option value="html">HTML</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a one.
                                            @error('category.published') <span class="invalid-feedback">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                             
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Fechar</button>
                <button type="button" wire:click.prevent="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </div>
    </div>
</div>
