<?php


namespace App\Controller;
use Fpdf\Fpdf;
use FPDM;


class pdfHandler
{
    private $code;
    private $valeur;
    private $numser;

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * @param mixed $valeur
     */
    public function setValeur($valeur): void
    {
        $this->valeur = $valeur;
    }

    /**
     * @return mixed
     */
    public function getNumser()
    {
        return $this->numser;
    }

    /**
     * @param mixed $numser
     */
    public function setNumser($numser): void
    {
        $this->numser = $numser;
    }

    public function fillMe(){
        /*$fields = array(
            'name' => $this->code,
            'address'=> $this->valeur,
            'city'=> $this->numser
        );*/
        $fields = array(
            'name' => 'tst' ,
            'address'=> 'tst' ,
            'city'=> 'tst'
        );
        //echo($fields['token']);
        $file= new FPDM('C:\xampp\htdocs\testP\templates\pdf\template.pdf');
        $file->Load($fields, false);
        $file->Merge();
        $res_path='C:/xampp/htdocs/testP/templates/pdf/';
        $res_name=$res_path.$this->numser . ".pdf";
        $file->Output('F',$res_name);
    }
}