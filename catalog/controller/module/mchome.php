<?php
class ControllerModuleMchome extends Controller {
	protected function index() {
		$this->language->load('module/mchome');
		
		$this->load->model('tool/image');
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
		
		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}
		
		if (isset($parts[0])) {
			$this->data['category_id'] = $parts[0];
		} else {
			$this->data['category_id'] = 0;
		}
		
		if (isset($parts[1])) {
			$this->data['child_id'] = $parts[1];
		} else {
			$this->data['child_id'] = 0;
		}
							
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		
		$this->data['categories'] = array();
					
		$categories = $this->model_catalog_category->getCategories(0);
		
		foreach (array_slice($categories, 0, 10) as $category) {
			$children_data = array();
		
			$children = $this->model_catalog_category->getCategories($category['category_id']);
			
			foreach (array_slice($children, 0, 7) as $child) {
				$data = array(
					'filter_category_id'  => $child['category_id'],
					'filter_sub_category' => true
				);		
							
				$children_data[] = array(
					'category_id' => $child['category_id'],
					'name'        => $child['name'],
					
					'href'        => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])	
				);					
			}
			
			$data = array(
				'filter_category_id'  => $category['category_id'],
				'filter_sub_category' => true	
			);		
				
			if ($category['image']) {

				$image=	$category['image'];

				} else {

					$image = 'no_image.jpg';

				}
			$image = $this->model_tool_image->resize($image, 110, 110);	
			$this->data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'],
	     		'thumb'       => $image,
				'children'    => $children_data,
				'href'        => $this->url->link('product/category', 'path=' . $category['category_id'])
			);
			
			
			
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mchome.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/mchome.tpl';
		} else {
			$this->template = 'default/template/module/mchome.tpl';
		}
		
		$this->render();
  	}
}
?>