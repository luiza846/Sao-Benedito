<link rel="stylesheet" href="../css/style.css">
<?php if (!empty($_SESSION['sucesso'])): ?>
    <!-- Modal -->
    <div class="modal fade" id="modalSucesso" tabindex="-1" aria-labelledby="modalSucessoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalSucessoLabel">Sucesso</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body">
                    <strong>Solicitação criada com sucesso!</strong>

                    <p class="mt-2">
                        Sua solicitação foi recebida com carinho e oração 💛
                        Agora ela passará por uma análise, e em breve nossa equipe entrará em contato.
                    </p>

                    <p class="mb-0">
                        <strong>Número do protocolo:</strong><br>
                        <span class="text-primary fs-5">
                            <?= $_SESSION['protocolo'] ?>
                        </span>
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                        OK
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = new bootstrap.Modal(document.getElementById('modalSucesso'));
            modal.show();
        });
    </script>

<?php
    unset($_SESSION['sucesso']);
    unset($_SESSION['protocolo']);
endif; ?>