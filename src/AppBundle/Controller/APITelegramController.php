<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Horario;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class APITelegramController extends Controller
{

	/**
    * @Route("/botTelegram", name="botTelegram")
    */
    public function botTelegramAction(Request $request)
    {
		$miToken='485510662:AAGwjcPL_JLD6Hd2whMOLS2iUsdOqdUHDnk';
		$url="https://api.telegram.org/bot".$miToken;

		$content = file_get_contents($url."/input"); // file_get_contents transmite el contenido de un archivo a un string
		$updates = json_decode($content,TRUE); // decodificamos a array las actualizaciones
		//var_dump($updates);
		$msg = $updates["message"];
		$chatId = $msg["chat"]["id"];
		$first_name = $msg["chat"]["first_name"];
		$text = $msg["text"];
		$text = strtolower($text);

		$text2=trim($text," ");
		$arrayText=preg_split("/[\s]+/",$text2);
		$comando=$arrayText[0];

		switch ($comando) 
		{
			case '/Start':
			case '/start':
				$content = "¡Bienvenido!".$first_name.".Para mas informacion /help";
				sendMessage($chatId,$content);
			break;
			case '/Turnos':
			case '/turnos':
				if(!(is_null($arrayText[1])))
				{
					$fecha=$arrayText[1];
					$url2=urldecode($request.getBaseURL().'/botTurnos/'.$fecha);

					$curl= curl_init($url2);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					$result=curl_exec ($curl);
					if($result == false)
					{
						curl_close($curl);
						$msg = "En este momento no funciona la aplicacion";
						sendMessage($chatId,$msg);
					}
					else
					{
						curl_close($curl);
						sendMessage($chatId,$result);
					}
				}
				else
				{
					$content = "Debe ingresar la fecha(aaaa-mm-dd)";
					sendMessage($chatId,$content);
				}
			break;
			case '/Reservar':
			case '/reservar':
				if(!(is_null($arrayText[1])))
				{
					$dni= $arrayText[1];
					$fecha= $arrayText[2];
					$hora= $arrayText[3];
					if(isset($dni) && isset($fecha) && isset($hora))
					{
						$url2=urldecode($this->request.getBaseURL().'/botReserva/');

						$curl= curl_init();
						curl_setopt($curl, CURLOPT_URL, $url2);
						curl_setopt($curl, CURLOPT_POST, true);
						curl_setopt($curl, CURLOPT_POSTFIELDS, $dni."/".$fecha."/".$hora);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
						$result=curl_exec ($curl);
						if($result == false)
						{
							curl_close($curl);
							$msg = "En este momento no funciona la aplicacion";
							sendMessage($chatId,$msg);
						}
						else
						{
							curl_close($curl);
							sendMessage($chatId,$result);
						}
					}
					else
					{
						$mensaje = "Debe ingresar el dni del paciente sin puntos, la fecha(aaaa-mm-dd) y la hora (hh:mm:ss)";
						sendMessage($chatId,$mensaje);
					}
				}
				else
				{
					$content = "Debe ingresar el dni del paciente sin puntos, la fecha(aaaa-mm-dd) y la hora (hh:mm:ss)";
					sendMessage($chatId,$content);
				}
	        break;
	        case '/Help':
			case '/help':
				$content = "Comandos disponibles:\n/turnos aaaa-mm-dd ->Devuelve los turnos disponibles para la fecha indicada.\n/reservar dni aaaa-mm-dd hh:mm ->Permite reservar un turno indicando indicando dni fecha y hora";
				sendMessage($chatId,$content);
			break;
			default:
				$content = "Por favor, ingrese /help para ver las opciones disponibles.";
				sendMessage($chatId,$content);
			break;
	    }
	}

	private function sendMessage($chatId,$content)
	{
		$ruta = $GLOBALS['url']."/sendMessage?chat_id=".$GLOBALS['chatId']."&text=".urlencode($content); //urlencode Codifica como URL una cadena
		file_get_contents($ruta);
	}

	/**
    * @Route("/botTurnos/{fecha}", name="botTurnos")
    */
    public function botTurnosAction($fecha)
    {
    	$repository = $this->getDoctrine()->getRepository(Horario::class);
        $turnosDisponibles = $repository->getTurnos($fecha);
		echo json_encode($turnosDisponibles);
		die();
		//return withJson($turnosDisponibles,200);
	}

	/**
    * @Route("/botReserva/{dni}/{fecha}/{hora}", name="botReserva")
    */
    public function botReservaAction($dni = 0, $fecha = null, $hora = null)
    {
    	$hora = $hora.":00";
	    if($this->validarAtributos($fecha, $hora))
	    {
	    	$repository = $this->getDoctrine()->getRepository(Horario::class);
			if( $repository->consultarReserva($fecha,$hora) == 0)
			{
				$reserva=$repository->reservarTurno($fecha,$hora,$dni);
				//$idReserva=$reserva['id_reserva'];
				echo json_encode($reserva);
			}
			else
			{
				echo "ya esta reservado";
			}
    	}
    	else
		{
			echo "El formato de los datos ingresados no corresponde";
		}
    	die();
    }

	private function validarAtributos($fecha, $hora)
	{
		if($this->validar_fecha($fecha)&&($this->validar_hora($hora))&&($this->fecha_valida($fecha,$hora)))
		{
			return true;
		}
		else {
			return false;
		}
	}

   private function validar_fecha($fecha)
   {
		$valores = explode('-', $fecha);
		if((count($valores) == 3) && checkdate($valores[1], $valores[2], $valores[0]))
		{
			return true;
		}
		else
		{
			return false;
		}
    }

   private function fecha_valida($fecha,$hora)
   {
   		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$fecha_actual = date("Y-m-d H:i:s");
		if(($fecha." ".$hora) >= $fecha_actual)
		{
			return true;
		}
		else
		{echo "fecha no valida";
			return false;
		}
	}

    private function validar_hora($hora)
    {
		$valores = explode(':', $hora);
		if((count($valores) == 3) && preg_match("#([0-1]{1}[0-9]{1}|[2]{1}[0-3]{1}):[0-5]{1}[0-9]{1}#", $hora))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>