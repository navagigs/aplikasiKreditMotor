<?
ob_start();
 include "pengajuan_view.php";
 $content = ob_get_clean();

// conversion HTML => PDF
 require_once "../../assets/pdf/html2pdf.class.php";
 try
 {
 $html2pdf = new HTML2PDF('P','A4', 'en', false, 'ISO-8859-15');
 $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
 $html2pdf->Output('"pengajuan.pdf');
 }
 catch(HTML2PDF_exception $e) { echo $e; }
?>