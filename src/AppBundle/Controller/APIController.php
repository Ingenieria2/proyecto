<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class APIController extends Controller
{

	public function getTipos($url)
	{
		$array = array();
		$encabezados = @get_headers($url);
		if (preg_match("|200|", $encabezados[0]))
		{
			$json= file_get_contents($url);
			$array= json_decode($json,true);
		}
		return $array;
	}

	function getTiposDocumento()
	{
		$url="https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-documento";
		return $tipoDoc=$this->getTipos($url);
	}

	function getTiposObraSocial()
	{
		$url="https://api-referencias.proyecto2017.linti.unlp.edu.ar/obra-social";
		return $obraSocial=$this->getTipos($url);
	}

	function getTiposAgua()
	{
		$url="https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-agua";
		return $tipoAgua=$this->getTipos($url);
	}

	function getTiposVivienda()
	{
		$url="https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-vivienda";
		return $tipoVivienda=$this->getTipos($url);
	}

	function getTiposCalefaccion()
	{
		$url="https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-calefaccion";
		return $tipoCalefaccion=$this->getTipos($url);
	}

	public function getTipoDocumento($id)
	{
		$url="https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-documento/$id";
		return $tipoDoc=$this->getTipos($url);
	}

	function getTipoObraSocial($id)
	{
		$url="https://api-referencias.proyecto2017.linti.unlp.edu.ar/obra-social/$id";
		return $obraSocial=$this->getTipos($url);
	}

	function getTipoAgua($id)
	{
		$url="https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-agua/$id";
		return $tipoAgua=$this->getTipos($url);
	}

	function getTipoVivienda($id)
	{
		$url="https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-vivienda/$id";
		return $tipoVivienda=$this->getTipos($url);
	}

	function getTipoCalefaccion($id)
	{
		$url="https://api-referencias.proyecto2017.linti.unlp.edu.ar/tipo-calefaccion/$id";
		return $tipoCalefaccion=$this->getTipos($url);
	}

}
?>