<?php
require_once __DIR__ . '/../models/Produtos.php';
require_once __DIR__ . '/../../vendor/autoload.php';

class ProdutoCOntroller {
    private $produtoModel;

    public function __construct($db) {
        $this->produtoModel = new Produto($db);
    }

    public funtion gerarRelatorioPDF() {
        $produtos = $this->produtoModel->ListarProdutos();

        // Requisição da visualização (HTML do relatório)
        ob_start();
        include __DIR__ . '/../views/relatorio_produtos.php';
        $html = ob_get_clean();
        // Geração do PDF com mPDF
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->writeHTML($html);
        $mpdf->Output('relatorio_produtos.pdf', \Mpdf\Output\Destination::INLINE);
    }
}