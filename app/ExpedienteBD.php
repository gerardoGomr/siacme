<?php
namespace Siacme;

use DB;

class ExpedienteBD
{
	//buscar expedientes coincidentes
	public function buscarExpedientesPorNombre($nombreBusqueda = '')
	{
		$listaExpedientes = null;
		try {
			$expedienteBD = DB::table('expediente')
								->select('idExpediente', 'Nombre', 'Paterno', 'Materno', 'Telefono', 'Celular', 'Email', 'Direccion')
								->whereNotNull('idExpediente');

			// quitar espacis en blanco
			$nombreBusqueda = str_replace(' ', '', $nombreBusqueda);

			//verificar cuales son los parametros enviados
			if(strlen($nombreBusqueda)) {
				$expedienteBD->where(DB::raw("REPLACE(CONCAT(Nombre, Paterno, Materno), ' ', '')"), 'LIKE', "%$nombreBusqueda%");
			}

			// var_dump($expedienteBD->get());exit;
			$expedientes      = $expedienteBD->get();
			$totalExpedientes = count($expedientes);

			if($totalExpedientes > 0)
			{
				$listaExpedientes = array();

				foreach ($expedientes as $expedientes) {

					$expediente = new Expediente();
					$expediente->setId($expedientes->idExpediente);
					$expediente->setNombre($expedientes->Nombre);
					$expediente->setPaterno($expedientes->Paterno);
					$expediente->setMaterno($expedientes->Materno);
					$expediente->setTelefono($expedientes->Telefono);
					$expediente->setCelular($expedientes->Celular);
					$expediente->setEmail($expedientes->Email);
					$expediente->setDireccion($expedientes->Direccion);

					$listaExpedientes[] = $expediente;

				}

				return $listaExpedientes;
			}

			return $listaExpedientes;

		} catch(Exception $e) {
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACME", "Error: ".$e->getMessage());
			echo "Error: ".$e->getMessage();
		}
	}

	public function editarFirma(Expediente $expediente)
	{
		$this->query = "UPDATE expediente SET Firma = ? WHERE idExpediente = ?";

		$valores = $expediente->getFirma()."::".$expediente->getId();
		$tiposDatos = "si";

		try
		{
			BaseDatos::conectar();
			BaseDatos::insertar($this->query, $tiposDatos, $valores);
			BaseDatos::desconectar();

			return true;
		}
		catch(Exception $e)
		{
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}
	}
}