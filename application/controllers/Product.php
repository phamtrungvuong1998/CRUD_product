<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_product');
		$this->load->library('pagination');
		$this->load->library('SmartyLibrary', 'smarty');
	}

	public function index()
	{
		$page = $this->uri->segment(2);
		if ($page == 0) {
			redirect("/danh-sach-san-pham/1");
		} else if ($page == "") {
			$page = 1;
		}
		$page1 = ($page - 1) * 3;
		$data['title'] = "Danh sách sản phẩm";
		$data['content'] = 'product/list_product.tpl';
		
		$data_model = $this->M_product->get_list($page1);
		$data['list'] = $data_model['list'];
		$total_page = round($data_model['total'] / 3);
		if ($page > $total_page) {
			redirect("/danh-sach-san-pham/1");
		}
		$config['base_url'] = base_url() . 'danh-sach-san-pham/';
		$config['total_rows'] = $data_model['total'];
		$config['per_page'] = 3;
		// custom paging configuration
		$config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;

		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';

		$config['next_link'] = 'Next Page';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = 'Prev Page';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class=""><span class="page-link" style="background: #3071a9; color: white">';
		$config['cur_tag_close'] = '</span></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();

		$this->smarty->assign('data', $data);
		$this->smarty->display('template/index.tpl');
	}

	public function show_edit_product($id)
	{
		$edit = $this->M_product->get_product($id);
		if (count($edit) == 0) {
			redirect("danh-sach-san-pham/1");
		} else {
			$data['edit'] = $edit;
			$data['title'] = "Chỉnh sửa sản phẩm";
			$data['content'] = 'product/edit_product.tpl';
			$this->smarty->assign('data', $data);
			$this->smarty->display('template/index.tpl');
		}
	}

	public function edit_product()
	{
		$id = $this->input->post('id');

		$data = [
			'name' => $this->input->post('name_product'),
			'code' => $this->input->post('code_product'),
			'price' => $this->input->post('price_product'),
			'updated_at' => time()
		];
		echo $this->M_product->edit_product($data, $id);
	}

	public function delete_product()
	{
		$id = $this->input->post('id');
		$this->M_product->delete_product($id);
		echo json_encode([
			'result' => true
		]);
	}

	public function show_form_add()
	{
		$data['title'] = "Thêm sản phẩm";
		$data['content'] = 'product/add_product.tpl';
		$this->smarty->assign('data', $data);
		$this->smarty->display('template/index.tpl');
	}

	public function add_product()
	{
		$name_product = $this->input->post('name_product');
		$code_product = $this->input->post('code_product');
		$price_product = $this->input->post('price_product');

		$data = [
			'name' => $name_product,
			'code' => $code_product,
			'price' => $price_product,
			'created_at' => time(),
			'updated_at' => time()
		];
		echo $this->M_product->add_product($data);
	}

	public function show()
	{
		$data['title'] = "Thêm sản phẩm";
		$this->smarty->assign('data', $data);
		$this->smarty->display('test.tpl');
	}

	public function test()
	{
		echo "Trang chủ";
	}
}
