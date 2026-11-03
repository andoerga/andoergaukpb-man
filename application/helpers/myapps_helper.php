<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('pass_peserta_encode')){
	function pass_peserta_encode($text){
		$salt = 'Drkguq5EvjSVTn0NzkE7T8UtjT0G';
		$crypted = md5(md5($salt.$text.$salt));
		return $crypted;
		///return base64_encode(base64_encode($text));
	}
}

if( ! function_exists('pass_peserta_decode')){
	function pass_peserta_decode($text){
		return base64_decode(base64_decode($text));
	}
}

if( ! function_exists('show_json_error'))
{
	function show_json_error($error_message, $error_code = null){
		$data = array(
			'success' => false,
			'code' => $error_code,
			'message' => $error_message
		);
		print_json($data);
	}
}

if( ! function_exists('show_json'))
{
	function show_json($data){
		$data = array(
			'success' => true,
			'data' => $data
		);
		print_json($data);
	}
}

if( ! function_exists('print_json'))
{
	function print_json($json){
		header('Content-Type: application/json');
		echo json_encode($json);
		die();
	}
}

if ( ! function_exists('get_filename'))
{
	function get_filename($string)
	{
		$array = explode("/", $string);
		return $array[count($array)-1];
	}
}
if ( ! function_exists('is_sidebar_collapse'))
{
	function is_sidebar_collapse()
	{
		$CI =& get_instance();
		$sidebar_collapse = isset($_COOKIE['sidebar_collapse']) ? $_COOKIE['sidebar_collapse'] : false;
		if($sidebar_collapse == 'true'){
			return true;
		}else{
			return false;
		}
	}
}

if ( ! function_exists('print_name'))
{
	function print_name()
	{
		$CI =& get_instance();
		$user = $CI->session->userdata('user');
		return $user->name;
	}
}

if ( ! function_exists('get_profile_picture'))
{
	function get_profile_picture()
	{
		$CI =& get_instance();
		$user = $CI->session->userdata('user');
		if(property_exists($user, 'image') && $user->image != ''){
			return $user->image;
		}else{
			return 'includes/img/default-profile.png';
		}
		
	}
}

if ( ! function_exists('print_title'))
{
	function print_title($title)
	{
		return '<h1>'.$title.'</h1>';
	}
}


if ( ! function_exists('print_breadcrumb'))
{
	function print_breadcrumb($module)
	{
		$CI =& get_instance();
		
		$slug = array();
		$slug[] = $module;
		$have_parent = $module->parent_id ? true : false;
		while($have_parent){
			$module = $CI->module_model->get_row($module->parent_id);
			if($module){
				$slug[] = $module;
				$have_parent = $module->parent_id ? true : false;
			}else{
				$have_parent = false;
			}
		}
		
		$html = '<ol class="breadcrumb">';
		$html .= '<li><a href="">Home</a></li>';
		$i = count($slug)-1;
		for($i;$i>=0;$i--){
			if($i==0){
				$html .= '<li class="active">'.$slug[$i]->name.'</li>';
			}else{
				$html .= '<li>'.$slug[$i]->name.'</li>';
			}
		}
		$html .= '</ol>';
		return $html;
	}
}

if (! function_exists('get_tahun_anggaran'))
{
	function get_tahun_anggaran()
	{
		$CI =& get_instance();
		return $CI->session->userdata('tahun_anggaran');
	}
}

if (! function_exists('change_tahun_anggaran'))
{
	function change_tahun_anggaran()
	{
		$tahun_anggaran = get_tahun_anggaran();
		$currentYear = date('Y');
		
		$html = '<div class="tahun-change">';
		$html .= '<form method="post" action="'.site_url('home/change_tahun_anggaran').'">';
		$html .= '<b>Tahun Anggaran</b> : ';
		$html .= '<input type="hidden" name="callback" value="'.current_url().'" />';
		$html .= '<select id="tahun-anggaran" name="tahun_anggaran">';
		
		for($i=$currentYear-5; $i<=$currentYear; $i++){
			$html .= '<option value="'.$i.'" ';
			$html .= $i==$tahun_anggaran ? 'selected' : '';
			$html .= '>'.$i.'</option>';
		}
		$html .= '</select></form></div>';
		return $html;
	}
}