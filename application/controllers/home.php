<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/my_controller.php"); 

class Home extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('ingreso_mdl');
		$this->load->model('gasto_mdl');
		$this->load->model('activo_mdl');
		$this->load->model('pasivo_mdl');
	}

	public function index(){
		$this->is_logged();

		
		$this->load->model('profesion_mdl');
		$profesion = null;
		if (!is_null($this->session->userdata('id_profesion')))
			$profesion = $this->profesion_mdl->fetch_by_id($this->session->userdata('id_profesion'));

		$data_header = array('profesion' => $profesion);

		$id_profesion = 0;
		$total_gastos = 0;
		$total_pasivos = 0;
		$total_ingreso_pasivo = 0;
		$salario = 0;
		if (!is_null($profesion)){
			$id_profesion = $profesion->id_profesion;
			$total_gastos = $this->gasto_mdl->total_monto($id_profesion);
			$total_pasivos = $this->pasivo_mdl->total_monto($id_profesion);	
			$total_ingreso_pasivo = (!is_null($this->ingreso_mdl->total_monto($id_profesion))) ? $this->ingreso_mdl->total_monto($id_profesion) : 0;
			$salario = $profesion->salario;
		}
		$total_ingreso = $total_ingreso_pasivo + $salario;
		

		$data = array(
			'profesion' => $profesion,
			'total_ingreso_pasivo' => $total_ingreso_pasivo,
			'total_gastos' => $total_gastos,
			'total_pasivos' => $total_pasivos
			);
		$this->load->view('page/page_header', $data_header);
		$this->load->view('cashflow', $data);
		$this->load->view('page/page_footer');
	}

	public function iniciar_valores($id_profesion){
		$this->load->model('profesion_mdl');
		$this->load->model('pasivo_mdl');
		$this->load->model('gasto_mdl');
		$this->load->model('datos_iniciales_mdl');
		$profesion = $this->profesion_mdl->fetch_by_id($id_profesion);
		if (!is_null($profesion)){
			//Eliminar datos de todas las tablas
			$this->pasivo_mdl->delete_by_profesion($id_profesion);
			$this->gasto_mdl->delete_by_profesion($id_profesion);
			
			//Cantidad de hijos
			$this->profesion_mdl->update_hijos($id_profesion, 0);

			//Asignar gastos iniciales (1: Gasto)
			$gastos_iniciales = $this->datos_iniciales_mdl->fetch_by_id($id_profesion, 1);
			foreach ($gastos_iniciales as $key => $datos) {
				$values = array(
					'descripcion' => $datos->nombre,
					'monto' => $datos->monto,
					'id_profesion' => $id_profesion,
					'color_etiqueta' => $datos->color_etiqueta
					);
				$this->gasto_mdl->insert($values);
			}
			
			//Asignar pasivos iniciales (2: Pasivo)
			$pasivos_iniciales = $this->datos_iniciales_mdl->fetch_by_id($id_profesion, 2);
			foreach ($pasivos_iniciales as $key => $datos) {
				$values = array(
					'descripcion' => $datos->nombre,
					'monto' => $datos->monto,
					'id_profesion' => $id_profesion,
					'color_etiqueta' => $datos->color_etiqueta	
					);
				$this->pasivo_mdl->insert($values);
			}
		}
		else
			echo 'error, no existe una profesion con esa id';
	}

	public function load_ingresos(){
		$output = '';
		$id_profesion = $this->session->userdata('id_profesion');

		if (!is_null($id_profesion)){
			$total_ingresos = $this->ingreso_mdl->total_monto($id_profesion);
			$ingresos = $this->ingreso_mdl->fetch_all($id_profesion);
			$i = 1;
			foreach ($ingresos as $key => $ingreso){
		        $color = (is_null($ingreso->color_etiqueta)) ? 'default': $ingreso->color_etiqueta;
		      	$porcentaje = ($ingreso->monto / $total_ingresos) * 100;
				$output .= '
				<tr>
		            <td>'.$i++.'</td>
		            <td>'.$ingreso->descripcion.'</td>
		            <td>
		              <div class="progress progress-xs">
		                <div class="progress-bar progress-bar-danger" style="width: '.$porcentaje.'%"></div>
		              </div>
		            </td>
		            <td><span class="badge bg-'.$color.'">'.$ingreso->monto.'</span></td>
		         </tr>      
				';
			}
		}
		
		echo $output;
	}

	public function load_gastos(){
		$output = '';
		$id_profesion = $this->session->userdata('id_profesion');

		if (!is_null($id_profesion)){
			$total_gastos = $this->gasto_mdl->total_monto($id_profesion);
			$gastos = $this->gasto_mdl->fetch_all($id_profesion);
			$i = 1;
			foreach ($gastos as $key => $gasto){
		        $color = (is_null($gasto->color_etiqueta)) ? 'default': $gasto->color_etiqueta;
		      	$porcentaje = ($gasto->monto / $total_gastos) * 100;
				$output .= '
				<tr>
		            <td>'.$i++.'</td>
		            <td>'.$gasto->descripcion.'</td>
		            <td>
		              <div class="progress progress-xs">
		                <div class="progress-bar progress-bar-danger" style="width: '.$porcentaje.'%"></div>
		              </div>
		            </td>
		            <td><span class="badge bg-'.$color.'">'.$gasto->monto.'</span></td>
		         </tr>      
				';
			}
		}
		
		echo $output;
	}

	public function load_activos(){
		$output = '';
		$id_profesion = $this->session->userdata('id_profesion');

		if (!is_null($id_profesion)){
			$total_activos = $this->activo_mdl->total_monto($id_profesion);
			$activos = $this->activo_mdl->fetch_all($id_profesion);
			$i = 1;
			foreach ($activos as $key => $activo){
		        $color = (is_null($activo->color_etiqueta)) ? 'default': $activo->color_etiqueta;
		      	$porcentaje = ($activo->monto / $total_activos) * 100;
				$output .= '
				<tr>
		            <td>'.$i++.'</td>
		            <td>'.$activo->descripcion.'</td>
		            <td>'.$activo->cantidad.'</td>
		            <td>'.$activo->precio_unitario.'</td>
		            <td>'.$activo->deposito.'</td>
		            <td>'.$activo->costo.'</td>
		            <td>
		              <div class="progress progress-xs">
		                <div class="progress-bar progress-bar-danger" style="width: '.$porcentaje.'%"></div>
		              </div>
		            </td>
		            <td><span class="badge bg-'.$color.'">'.$activo->monto.'</span></td>
		         </tr>      
				';
			}
		}
		
		echo $output;
	}

	public function load_pasivos(){
		$output = '';
		$id_profesion = $this->session->userdata('id_profesion');

		if (!is_null($id_profesion)){
			$total_pasivos = $this->pasivo_mdl->total_monto($id_profesion);
			$pasivos = $this->pasivo_mdl->fetch_all($id_profesion);
			$i = 1;
			foreach ($pasivos as $key => $pasivo){
		        $color = (is_null($pasivo->color_etiqueta)) ? 'default': $pasivo->color_etiqueta;
		      	$porcentaje = ($pasivo->monto / $total_pasivos) * 100;
				$output .= '
				<tr>
		            <td>'.$i++.'</td>
		            <td>'.$pasivo->descripcion.'</td>
		            <td>
		              <div class="progress progress-xs">
		                <div class="progress-bar progress-bar-danger" style="width: '.$porcentaje.'%"></div>
		              </div>
		            </td>
		            <td><span class="badge bg-'.$color.'">'.$pasivo->monto.'</span></td>
		         </tr>      
				';
			}
		}
		
		echo $output;
	}

	//Comprar acciones
	public function comprar_acciones(){
		$descripcion = $this->input->post('descripcion');
		$cant = $this->input->post('cant_acciones');
		$precio = $this->input->post('costo_accion');
		$total = $cant * $precio;

		$data = array(
			'descripcion' => $descripcion,
			'id_tipo_activo' => 1,
			'cantidad' => $cant,
			'precio_unitario' => $precio,
			'id_profesion' => $this->session->userdata('id_profesion'),
			'monto' => $total
		);
		$this->activo_mdl->insert($data);

		echo json_encode($data);
	}
}
