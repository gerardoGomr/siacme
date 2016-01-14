<?php
namespace Siacme\Expedientes;

class ExpedienteOdontopediatria extends Expediente
{
	//string
	private $nombrePadre, $nombreMadre, $ocupacionPadre, $ocupacionMadre, $nombreEdadesHermanos, $fechaUltimoExamenBucal, $motivoVisitaDentista, $reaccionAnestesico, $descripcionHabito, $especifiqueAuxiliar, $notas, $labios, $carrillos, $frenillos, $paladar, $lengua, $pisoDeBoca, $parodonto, $uvula, $amigdalas;
	//int
	private $idExpediente, $edadErupcionoPrimerDiente, $haPresentadoDolorBoca, $presentaMalOlorBoca, $haNotadoSangradoEncias, $sienteDienteFlojo, $disartria, $dislalia, $afasia, $otroTrastorno, $negadoTrastorno, $primeraVisitaDentista, $leHanColocadoAnestesico, $tuvoMalaReaccionAnestesico, $tipoCepilloAdulto, $vecesCepillaDiente, $alguienAyudaACepillarse, $vecesComeDia, $hiloDental, $enjuagueBucal, $limpiadorLingual, $tabletasReveladoras, $otroAuxiliar, $succionDigital, $succionLingual, $biberon, $bruxismo, $succionLabial, $respiracionBucal, $onicofagia, $chupon, $otroHabito, $posturaRectaCaminar, $posturaRectaSentar, $mordidaBordeBorde, $sobremordidaVertical, $sobremordidaHorizontal, $mordidaAbiertaAnterior, $mordidaCruzadaAnterior, $mordidaCruzadaPosterior, $lineaMediaDental, $lineaMediaEsqueletica, $alteracionTamanio, $alteracionForma, $alteracionNumero, $alteracionEstructura, $alteracionTextura, $alteracionColor, $escalonMesialDerecho, $escalonMesialIzquierdo, $escalonDistalDerecho, $escalonDistalIzquierdo, $escalonRectoDerecho, $escalonRectoIzquierdo, $mesialExageradoDerecho, $mesialExageradoIzquierdo, $noDeterminadoDerecho, $noDeterminadoIzquierdo, $relacionMolarDerechaI, $relacionMolarDerechaII, $relacionMolarDerechaIII, $relacionMolarIzquierdaI, $relacionMolarIzquierdaII, $relacionMolarIzquierdaIII, $relacionCaninaDerechaI, $relacionCaninaDerechaII, $relacionCaninaDerechaIII, $relacionCaninaIzquierdaI, $relacionCaninaIzquierdaII, $relacionCaninaIzquierdaIII, $tipoArcoI, $traumatismoBucal;

	//marca pasta
	private $marcaPasta;
	//comportamiento inicial
	private $comportamientoInicial;
	//comportamiento frankl
	private $comportamientoFrankl;
	//trastorno lenguaje
	private $trastornoLenguaje;
	//morfologia craneofacial
	private $morfologiaCraneofacial;
	//morfologia facial
	private $morfologiaFacial;
	//convexividad facial
	private $convexividadFacial;
	// atm
	private $atm;

	public function getNombrePadre()
	{
		return $this->nombrePadre;
	}

	public function getNombreMadre()
	{
		return $this->nombreMadre;
	}

	public function getOcupacionPadre()
	{
		return $this->ocupacionPadre;
	}

	public function getOcupacionMadre()
	{
		return $this->ocupacionMadre;
	}

	public function getNombreEdadesHermanos()
	{
		return $this->nombreEdadesHermanos;
	}

	public function getFechaUltimoExamenBucal()
	{
		return $this->fechaUltimoExamenBucal;
	}

	public function getReaccionAnestesico()
	{
		return $this->reaccionAnestesico;
	}

	public function getEdadErupcionoPrimerDiente()
	{
		return $this->edadErupcionoPrimerDiente;
	}

	public function getDescripcionHabito()
	{
		return $this->descripcionHabito;
	}

	public function getEspecifiqueAuxiliar()
	{
		return $this->especifiqueAuxiliar;
	}

	public function getHaPresentadoDolorBoca()
	{
		return $this->haPresentadoDolorBoca;
	}

	public function getPresentaMalOlorBoca()
	{
		return $this->presentaMalOlorBoca;
	}

	public function getHaNotadoSangradoEncias()
	{
		return $this->haNotadoSangradoEncias;
	}

	public function getSienteDienteFlojo()
	{
		return $this->sienteDienteFlojo;
	}

	public function getDisartria()
	{
		return $this->disartria;
	}

	public function getDislalia()
	{
		return $this->dislalia;
	}

	public function getAfasia()
	{
		return $this->afasia;
	}

	public function getOtroTrastorno()
	{
		return $this->otroTrastorno;
	}

	public function getNegadoTrastorno()
	{
		return $this->negadoTrastorno;
	}

	public function getPrimeraVisitaDentista()
	{
		return $this->primeraVisitaDentista;
	}

	public function getLeHanColocadoAnestesico()
	{
		return $this->leHanColocadoAnestesico;
	}

	public function getTuvoMalaReaccionAnestesico()
	{
		return $this->tuvoMalaReaccionAnestesico;
	}

	public function getTipoCepilloAdulto()
	{
		return $this->tipoCepilloAdulto;
	}

	public function getVecesCepillaDiente()
	{
		return $this->vecesCepillaDiente;
	}

	public function getAlguienAyudaACepillarse()
	{
		return $this->alguienAyudaACepillarse;
	}

	public function getVecesComeDia()
	{
		return $this->vecesComeDia;
	}

	public function getHiloDental()
	{
		return $this->hiloDental;
	}

	public function getEnjuagueBucal()
	{
		return $this->enjuagueBucal;
	}

	public function getLimpiadorLingual()
	{
		return $this->limpiadorLingual;
	}

	public function getTabletasReveladoras()
	{
		return $this->tabletasReveladoras;
	}

	public function getOtroAuxiliar()
	{
		return $this->otroAuxiliar;
	}

	public function getSuccionDigital()
	{
		return $this->succionDigital;
	}

	public function getSuccionLingual()
	{
		return $this->succionLingual;
	}

	public function getBiberon()
	{
		return $this->biberon;
	}

	public function getBruxismo()
	{
		return $this->bruxismo;
	}

	public function getSuccionLabial()
	{
		return $this->succionLabial;
	}

	public function getRespiracionBucal()
	{
		return $this->respiracionBucal;
	}

	public function getOnicofagia()
	{
		return $this->onicofagia;
	}

	public function getChupon()
	{
		return $this->chupon;
	}

	public function getOtroHabito()
	{
		return $this->otroHabito;
	}

	public function getMarcaPasta()
	{
		return $this->marcaPasta;
	}

	public function getComportamientoInicial()
	{
		return $this->comportamientoInicial;
	}

	public function getComportamientoFrankl()
	{
		return $this->comportamientoFrankl;
	}

	public function getTrastornoLenguaje()
	{
		return $this->trastornoLenguaje;
	}

	public function getMorfologiaCraneofacial()
	{
		return $this->morfologiaCraneofacial;
	}

	public function getMorfologiaFacial()
	{
		return $this->morfologiaFacial;
	}

	public function getConvexividadFacial()
	{
		return $this->convexividadFacial;
	}

	public function getATM()
	{
		return $this->atm;
	}

	public function getNotas()
	{
		return $this->notas;
	}

	public function getLabios()
	{
		return $this->labios;
	}

	public function getCarillos()
	{
		return $this->carrillos;
	}

	public function getFrenillos()
	{
		return $this->frenillos;
	}

	public function getPaladar()
	{
		return $this->paladar;
	}

	public function getLengua()
	{
		return $this->lengua;
	}

	public function getPisoDeBoca()
	{
		return $this->pisoDeBoca;
	}

	public function getParodonto()
	{
		return $this->parodonto;
	}

	public function getUvula()
	{
		return $this->uvula;
	}

	public function getAmigdalas()
	{
		return $this->amigdalas;
	}

	public function getMordidaBordeBorde()
	{
		return $this->mordidaBordeBorde;
	}

	public function getSobremordidaVertical()
	{
		return $this->sobremordidaVertical;
	}

	public function getSobremordidaHorizontal()
	{
		return $this->sobremordidaHorizontal;
	}

	public function getMordidaAbiertaAnterior()
	{
		return $this->mordidaAbiertaAnterior;
	}

	public function getMordidaCruzadaAnterior()
	{
		return $this->mordidaCruzadaAnterior;
	}

	public function getMordidaCruzadaPosterior()
	{
		return $this->mordidaCruzadaPosterior;
	}

	public function getLineaMediaDental()
	{
		return $this->lineaMediaDental;
	}

	public function getLineaMediaEsqueletica()
	{
		return $this->lineaMediaEsqueletica;
	}

	public function getAlteracionTamanio()
	{
		return $this->alteracionTamanio;
	}

	public function getAlteracionForma()
	{
		return $this->alteracionForma;
	}

	public function getAlteracionNumero()
	{
		return $this->alteracionNumero;
	}

	public function getAlteracionEstructura()
	{
		return $this->alteracionEstructura;
	}

	public function getAlteracionTextura()
	{
		return $this->alteracionTextura;
	}

	public function getAlteracionColor()
	{
		return $this->alteracionColor;
	}

	public function getEscalonMesialDerecho()
	{
		return $this->escalonMesialDerecho;
	}

	public function getEscalonMesialIzquierdo()
	{
		return $this->escalonMesialIzquierdo;
	}

	public function getEscalonDistalDerecho()
	{
		return $this->escalonDistalDerecho;
	}

	public function getEscalonDistalIzquierdo()
	{
		return $this->escalonDistalIzquierdo;
	}

	public function getEscalonRectoDerecho()
	{
		return $this->escalonRectoDerecho;
	}

	public function getEscalonRectoIzquierdo()
	{
		return $this->escalonRectoIzquierdo;
	}

	public function getMesialExageradoDerecho()
	{
		return $this->mesialExageradoDerecho;
	}

	public function getMesialExageradoIzquierdo()
	{
		return $this->mesialExageradoIzquierdo;
	}

	public function getNoDeterminadoDerecho()
	{
		return $this->noDeterminadoDerecho;
	}

	public function getNoDeterminadoIzquierdo()
	{
		return $this->noDeterminadoIzquierdo;
	}

	public function getRelacionMolarDerechaI()
	{
		return $this->relacionMolarDerechaI;
	}

	public function getRelacionMolarDerechaII()
	{
		return $this->relacionMolarDerechaII;
	}

	public function getRelacionMolarDerechaIII()
	{
		return $this->relacionMolarDerechaIII;
	}

	public function getRelacionMolarIzquierdaI()
	{
		return $this->relacionMolarIzquierdaI;
	}

	public function getRelacionMolarIzquierdaII()
	{
		return $this->relacionMolarIzquierdaII;
	}

	public function getRelacionMoralIzquierdaIII()
	{
		return $this->relacionMolarIzquierdaIII;
	}

	public function getRelacionCaninaDerechaI()
	{
		return $this->relacionCaninaDerechaI;
	}

	public function getRelacionCaninaDerechaII()
	{
		return $this->relacionCaninaDerechaII;
	}

	public function getRelacionCaninaDerechaIII()
	{
		return $this->relacionCaninaDerechaIII;
	}

	public function getRelacionCaninaIzquierdaI()
	{
		return $this->relacionCaninaIzquierdaI;
	}

	public function getRelacionCaninaIzquierdaII()
	{
		return $this->relacionCaninaIzquierdaII;
	}

	public function getRelacionCaninaIzquierdaIII()
	{
		return $this->relacionCaninaIzquierdaIII;
	}

	public function getTipoArcoI()
	{
		return $this->tipoArcoI;
	}

	public function getPosturaRectaCaminar()
	{
		return $this->posturaRectaCaminar;
	}

	public function getMotivoVisitaDentista()
	{
		return $this->motivoVisitaDentista;
	}

	public function getTraumatismoBucal()
	{
		return $this->traumatismoBucal;
	}

	public function getPosturaRectaSentar()
	{
		return $this->posturaRectaSentar;
	}
	/////////////////////////////////////////////////////////////////////////////////

	public function setNombrePadre($nombrePadre)
	{
		$this->nombrePadre = $nombrePadre;
	}

	public function setNombreMadre($nombreMadre)
	{
		$this->nombreMadre = $nombreMadre;
	}

	public function setOcupacionPadre($ocupacionPadre)
	{
		$this->ocupacionPadre = $ocupacionPadre;
	}

	public function setOcupacionMadre($ocupacionMadre)
	{
		$this->ocupacionMadre = $ocupacionMadre;
	}

	public function setNombreEdadesHermanos($nombreEdadesHermanos)
	{
		$this->nombreEdadesHermanos = $nombreEdadesHermanos;
	}

	public function setFechaUltimoExamenBucal($fechaUltimoExamenBucal)
	{
		$this->fechaUltimoExamenBucal = $fechaUltimoExamenBucal;
	}

	public function setReaccionAnestesico($reaccionAnestesico)
	{
		$this->reaccionAnestesico = $reaccionAnestesico;
	}

	public function setEdadErupcionoPrimerDiente($edadErupcionoPrimerDiente)
	{
		$this->edadErupcionoPrimerDiente = $edadErupcionoPrimerDiente;
	}

	public function setDescripcionHabito($descripcionHabito)
	{
		$this->descripcionHabito = $descripcionHabito;
	}

	public function setEspecifiqueAuxiliar($especifiqueAuxiliar)
	{
		$this->especifiqueAuxiliar = $especifiqueAuxiliar;
	}

	public function setHaPresentadoDolorBoca($haPresentadoDolorBoca)
	{
		$this->haPresentadoDolorBoca = $haPresentadoDolorBoca;
	}

	public function setPresentaMalOlorBoca($presentaMalOlorBoca)
	{
		$this->presentaMalOlorBoca = $presentaMalOlorBoca;
	}

	public function setHaNotadoSangradoEncias($haNotadoSangradoEncias)
	{
		$this->haNotadoSangradoEncias = $haNotadoSangradoEncias;
	}

	public function setSienteDienteFlojo($sienteDienteFlojo)
	{
		$this->sienteDienteFlojo = $sienteDienteFlojo;
	}

	public function setDisartria($disartria)
	{
		$this->disartria = $disartria;
	}

	public function setDislalia($dislalia)
	{
		$this->dislalia = $dislalia;
	}

	public function setAfasia($afasia)
	{
		$this->afasia = $afasia;
	}

	public function setOtroTrastorno($otroTrastorno)
	{
		$this->otroTrastorno = $otroTrastorno;
	}

	public function setNegadoTrastorno($negadoTrastorno)
	{
		$this->negadoTrastorno = $negadoTrastorno;
	}

	public function setPrimeraVisitaDentista($primeraVisitaDentista)
	{
		$this->primeraVisitaDentista = $primeraVisitaDentista;
	}

	public function setLeHanColocadoAnestesico($leHanColocadoAnestesico)
	{
		$this->leHanColocadoAnestesico = $leHanColocadoAnestesico;
	}

	public function setTuvoMalaReaccionAnestesico($tuvoMalaReaccionAnestesico)
	{
		$this->tuvoMalaReaccionAnestesico = $tuvoMalaReaccionAnestesico;
	}

	public function setTipoCepilloAdulto($tipoCepilloAdulto)
	{
		$this->tipoCepilloAdulto = $tipoCepilloAdulto;
	}

	public function setVecesCepillaDiente($vecesCepillaDiente)
	{
		$this->vecesCepillaDiente = $vecesCepillaDiente;
	}

	public function setAlguienAyudaACepillarse($alguienAyudaACepillarse)
	{
		$this->alguienAyudaACepillarse = $alguienAyudaACepillarse;
	}

	public function setVecesComeDia($vecesComeDia)
	{
		$this->vecesComeDia = $vecesComeDia;
	}

	public function setHiloDental($hiloDental)
	{
		$this->hiloDental = $hiloDental;
	}

	public function setEnjuagueBucal($enjuagueBucal)
	{
		$this->enjuagueBucal = $enjuagueBucal;
	}

	public function setLimpiadorLingual($limpiadorLingual)
	{
		$this->limpiadorLingual = $limpiadorLingual;
	}

	public function setTabletasReveladoras($tabletasReveladoras)
	{
		$this->tabletasReveladoras = $tabletasReveladoras;
	}

	public function setOtroAuxiliar($otroAuxiliar)
	{
		$this->otroAuxiliar = $otroAuxiliar;
	}

	public function setSuccionDigital($succionDigital)
	{
		$this->succionDigital = $succionDigital;
	}

	public function setSuccionLingual($succionLingual)
	{
		$this->succionLingual = $succionLingual;
	}

	public function setBiberon($biberon)
	{
		$this->biberon = $biberon;
	}

	public function setBruxismo($bruxismo)
	{
		$this->bruxismo = $bruxismo;
	}

	public function setSuccionLabial($succionLabial)
	{
		$this->succionLabial = $succionLabial;
	}

	public function setRespiracionBucal($respiracionBucal)
	{
		$this->respiracionBucal = $respiracionBucal;
	}

	public function setOnicofagia($onicofagia)
	{
		$this->onicofagia = $onicofagia;
	}

	public function setChupon($chupon)
	{
		$this->chupon = $chupon;
	}

	public function setOtroHabito($otroHabito)
	{
		$this->otroHabito = $otroHabito;
	}

	public function setMarcaPasta(MarcaPasta $marcaPasta)
	{
		$this->marcaPasta = $marcaPasta;
	}

	public function setComportamientoInicial(ComportamientoInicial $comportamientoInicial)
	{
		$this->comportamientoInicial = $comportamientoInicial;
	}

	public function setComportamientoFrankl(ComportamientoFrankl $comportamientoFrankl)
	{
		$this->comportamientoFrankl = $comportamientoFrankl;
	}

	public function setTrastornoLenguaje(TrastornoLenguaje $trastornoLenguaje)
	{
		$this->trastornoLenguaje = $trastornoLenguaje;
	}

	public function setMorfologiaCraneofacial(MorfologiaCraneoFacial $morfologiaCraneofacial)
	{
		$this->morfologiaCraneofacial = $morfologiaCraneofacial;
	}

	public function setMorfologiaFacial(MorfologiaFacial $morfologiaFacial)
	{
		$this->morfologiaFacial = $morfologiaFacial;
	}

	public function setConvexividadFacial(ConvexividadFacial $convexividadFacial)
	{
		$this->convexividadFacial = $convexividadFacial;
	}

	public function setATM(ATM $atm)
	{
		$this->atm = $atm;
	}

	public function setNotas($notas)
	{
		$this->notas = $notas;
	}

	public function setLabios($labios)
	{
		$this->labios = $labios;
	}

	public function setCarrillos($carrillos)
	{
		$this->carrillos = $carrillos;
	}

	public function setFrenillos($frenillos)
	{
		$this->frenillos = $frenillos;
	}

	public function setPaladar($paladar)
	{
		$this->paladar = $paladar;
	}

	public function setLengua($lengua)
	{
		$this->lengua = $lengua;
	}

	public function setPisoDeBoca($pisoDeBoca)
	{
		$this->pisoDeBoca = $pisoDeBoca;
	}

	public function setParodonto($parodonto)
	{
		$this->parodonto = $parodonto;
	}

	public function setUvula($uvula)
	{
		$this->uvula = $uvula;
	}

	public function setAmigdalas($amigdalas)
	{
		$this->amigdalas = $amigdalas;
	}

	public function setMordidaBordeBorde($mordidaBordeBorde)
	{
		$this->mordidaBordeBorde = $mordidaBordeBorde;
	}

	public function setSobremordidaVertical($sobremordidaVertical)
	{
		$this->sobremordidaVertical = $sobremordidaVertical;
	}

	public function setMordidaHorizontal($sobremordidaHorizontal)
	{
		$this->sobremordidaHorizontal = $sobremordidaHorizontal;
	}

	public function setMordidaAbiertaAnterior($mordidaAbiertaAnterior)
	{
		$this->mordidaAbiertaAnterior = $mordidaAbiertaAnterior;
	}

	public function setMordidaCruzadaAnterior($mordidaCruzadaAnterior)
	{
		$this->mordidaCruzadaAnterior = $mordidaCruzadaAnterior;
	}

	public function setMordidaCruzadaPosterior($mordidaCruzadaPosterior)
	{
		$this->mordidaCruzadaPosterior = $mordidaCruzadaPosterior;
	}

	public function setLineaMediaDental($lineaMediaDental)
	{
		$this->lineaMediaDental = $lineaMediaDental;
	}

	public function setLineaMediaEsqueletica($lineaMediaEsqueletica)
	{
		$this->lineaMediaEsqueletica = $lineaMediaEsqueletica;
	}

	public function setAlteracionTamanio($alteracionTamanio)
	{
		$this->alteracionTamanio = $alteracionTamanio;
	}

	public function setAlteracionForma($alteracionForma)
	{
		$this->alteracionForma = $alteracionForma;
	}

	public function setAlteracionNumero($alteracionNumero)
	{
		$this->alteracionNumero = $alteracionNumero;
	}

	public function setAlteracionEstructura($alteracionEstructura)
	{
		$this->alteracionEstructura = $alteracionEstructura;
	}

	public function setAlteracionTextura($alteracionTextura)
	{
		$this->alteracionTextura = $alteracionTextura;
	}

	public function setAlteracionColor($alteracionColor)
	{
		$this->alteracionColor = $alteracionColor;
	}

	public function setEscalonMesialDerecho($escalonMesialDerecho)
	{
		$this->escalonMesialDerecho = $escalonMesialDerecho;
	}

	public function setEscalonMesialIzquierdo($escalonMesialIzquierdo)
	{
		$this->escalonMesialIzquierdo = $escalonMesialIzquierdo;
	}

	public function setEscalonDistalDerecho($escalonDistalDerecho)
	{
		$this->escalonDistalDerecho = $escalonDistalDerecho;
	}

	public function setEscalonDistalIZquierdo($escalonDistalIzquierdo)
	{
		$this->escalonDistalIzquierdo = $escalonDistalIzquierdo;
	}

	public function setEscalonRectoDerecho($escalonRectoDerecho)
	{
		$this->escalonRectoDerecho = $escalonRectoDerecho;
	}

	public function setEscalonRectoIzquierdo($escalonRectoIzquierdo)
	{
		$this->escalonRectoIzquierdo = $escalonRectoIzquierdo;
	}

	public function setMesialExageradoDerecho($mesialExageradoDerecho)
	{
		$this->mesialExageradoDerecho = $mesialExageradoDerecho;
	}

	public function setMesialExageradoIzquierdo($mesialExageradoIzquierdo)
	{
		$this->mesialExageradoIzquierdo = $mesialExageradoIzquierdo;
	}

	public function setNoDeterminadoDerecho($noDeterminadoDerecho)
	{
		$this->noDeterminadoDerecho = $noDeterminadoDerecho;
	}

	public function setNoDeterminadoIzquierdo($noDeterminadoIzquierdo)
	{
		$this->noDeterminadoIzquierdo = $noDeterminadoIzquierdo;
	}

	public function setRelacionMolarDerechaI($relacionMolarDerechaI)
	{
		$this->relacionMolarDerechaI = $relacionMolarDerechaI;
	}

	public function setRelacionMolarDerechaII($relacionMolarDerechaII)
	{
		$this->relacionMolarDerechaII = $relacionMolarDerechaII;
	}

	public function setRelacionMolarDerechaIII($relacionMolarDerechaIII)
	{
		$this->relacionMolarDerechaIII = $relacionMolarDerechaIII;
	}

	public function setRelacionMolarIzquierdaI($relacionMolarIzquierdaI)
	{
		$this->relacionMolarIzquierdaI = $relacionMolarIzquierdaI;
	}

	public function setRelacionMolarIzquierdaII($relacionMolarIzquierdaII)
	{
		$this->relacionMolarIzquierdaII = $relacionMolarIzquierdaII;
	}

	public function setRelacionMolarIzquierdaIII($relacionMolarIzquierdaIII)
	{
		$this->relacionMolarIzquierdaIII = $relacionMolarIzquierdaIII;
	}

	public function setRelacionCaninaDerechaI($relacionCaninaDerechaI)
	{
		$this->relacionCaninaDerechaI = $relacionCaninaDerechaI;
	}

	public function setRelacionCaninaDerechaII($relacionCaninaDerechaII)
	{
		$this->relacionCaninaDerechaI = $relacionCaninaDerechaI;
	}

	public function setRelacionCaninaDerechaIII($relacionCaninaDerechaIII)
	{
		$this->relacionCaninaDerechaIII = $relacionCaninaDerechaIII;
	}

	public function setRelacionCaninaIzquierdaI($relacionCaninaIzquierdaI)
	{
		$this->relacionCaninaIzquierdaI = $relacionCaninaIzquierdaI;
	}

	public function setRelacionCaninaIzquierdaII($relacionCaninaIzquierdaII)
	{
		$this->relacionCaninaIzquierdaII = $relacionCaninaIzquierdaII;
	}

	public function setRelacionCaninaIzquierdaIII($relacionCaninaIzquierdaIII)
	{
		$this->relacionCaninaIzquierdaIII = $relacionCaninaIzquierdaIII;
	}

	public function setTipoArcoI($tipoArcoI)
	{
		$this->tipoArcoI = $tipoArcoI;
	}

	public function setMotivoVisitaDentista($motivoVisitaDentista)
	{
		$this->motivoVisitaDentista = $motivoVisitaDentista;
	}

	public function setTraumatismoBucal($traumatismoBucal)
	{
		$this->traumatismoBucal = $traumatismoBucal;
	}

	public function setPosturaRectaCaminar($posturaRectaCaminar)
	{
		$this->posturaRectaCaminar = $posturaRectaCaminar;
	}

	public function setPosturaRectaSentar($posturaRectaSentar)
	{
		$this->posturaRectaSentar = $posturaRectaSentar;
	}

	//////////////////////OPERACIONES///////////////////////////

	/**
	 * comprobar que el trastorno especificado es el mismo que está asignado
	 * @param  TrastornoLenguaje $trastorno
	 * @return bool
	 */
	public function compruebaTrastorno(TrastornoLenguaje $trastorno)
	{
		if($this->trastornoLenguaje->getId() === $trastorno->getId()) {
			return true;
		}

		return false;
	}

	/**
	 * comprobar que la marca de pasta especificada es la misma que la asignada al expediente
	 * @param  MarcaPasta $marcaPasta
	 * @return bool
	 */
	public function compruebaMarcaPasta(MarcaPasta $marcaPasta)
	{
		if($this->marcaPasta->getId() === $marcaPasta->getId()) {
			return true;
		}

		return false;
	}
}