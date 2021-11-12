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
            <input type="text" class="form-control" name="titulo" value="<?=$objVaga->titulo?>" required>
        </div>

        <script type="text/javascript">
            function autosize() 
            {
                var text = document.getElementById('text');
                function resize () {
                    text.style.height = 'auto';
                    text.style.height = (text.scrollHeight+8)+'px';

                    if ( text.scrollHeight < 300 )
                    text.style.height = '300px';
                }
                
                if ( text.scrollHeight > 300 )
                    resize();
            }
        </script>

        <div class="form-group">
            <label>Descrição</label>
            <textarea onkeyup="autosize()" class="form-control text-justify" name="descricao" id="text" style="resize:none; height:300px; overflow-y:hidden;" required><?=str_replace('<br />', '', nl2br($objVaga->descricao))?></textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            
            <div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="s" checked> Ativo
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="n" <?=$objVaga->ativo == 'n' ? 'checked' : ''?>> Inativo
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>

    </form>

</main>