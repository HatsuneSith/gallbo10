<?php 
class SireController extends Controller {




    public function inicio()
    {
        
        return View::make('sire.inicio');
    }

    public function pdf()
    {
        
        /*$html = '<html><body>'
            . '<p>Este es mi primer documento pdf ñ comunicaión'
            . 'generado con laravel.</p>'
            . '</body></html>';
        */

        $html = View::make('tests.pdf1');
    	return PDF::load(utf8_decode($html), 'letter', 'portrait')->show();
        //return PDF::load(utf8_decode($html), 'A4', 'portrait')->download("Aviso de siniestro persona fisica directamente");
    }


    public function word()
    {
        require_once 'src/PhpWord/Autoloader.php';
        \PhpOffice\PhpWord\Autoloader::register();
        
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/contratos/pm.docx');

        $nombre_asegurado = "Markoptic";
        $nombre = "Markop";

        $templateWord->setValue('nombre_asegurado',$nombre_asegurado);
        $templateWord->setValue('nombre',$nombre);
        $templateWord->saveAs('Documento2.docx');
        header("Content-Disposition: attachment; filename=Documento2.docx; charset=iso-8859-1");
        echo file_get_contents('Documento2.docx');
        unlink('Documento2.docx');
    }

    public function exampleview()
    {
        return View::make('sire.example');
    }

    public function examplepost()
    {
        
        if (Input::hasFile('fileex'))
        {
            Input::file('fileex')->move("img/logos_asegurados",'cliente1.jpg');
        }
        

        require_once 'src/PhpWord/Autoloader.php';
        \PhpOffice\PhpWord\Autoloader::register();
        
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/example.docx');
        $nombre = "Miguel";
        $apellido = "Lara";

        

        $templateWord->setImageValueAlt('logoempresa','img/logos_asegurados/cliente1.jpg');
        $templateWord->setValue('nombre',$nombre);
        $templateWord->setValue('apellido',$apellido);
        
        $templateWord->saveAs('Doc.docx');
        header("Content-Disposition: attachment; filename=Doc.docx; charset=iso-8859-1");
        echo file_get_contents('Doc.docx');
        unlink('Doc.docx');
    }





}
?>