<main>

    <!-- ARQUIVO QUE ARMAZENA O FORMULÁRIO PARA CADASTRAR/EDITAR VAGA -->
    
    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>

    <h2 class="mt-3"><?=TITLE?></h2>

    <form method="post">

        <div class="form-group">
            <label>Título</label>
            <input type="text" class="form-control" name="titulo" value="<?=$objVaga->titulo?>" disabled>
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <textarea class="form-control text-justify" name="descricao" rows="10" disabled><?=$objVaga->descricao?></textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            
            <div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="s" checked disabled> Ativo
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="n" <?=$objVaga->ativo == 'n' ? 'checked' : ''?> disabled> Inativo
                    </label>
                </div>
            </div>
        </div>

    </form>

</main>