<?php  
class ControllerModuleManufacturer extends Controller {
	protected function index() {
		$this->language->load('module/manufacturer');
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
		
		if (isset($this->request->get['path'])) {            $path = '';            $parts = explode('_', (string)$this->request->get['path']);            foreach ($parts as $path_id) {                if (!$path) {                    $path = $path_id;                } else {                    $path .= '_' . $path_id;                }            }            $category_id = array_pop($parts);        } else {            $category_id = null;        }		
							
		$this->load->model('catalog/manufacturer');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		
		$this->data['manufactureres'] = array();
					
		if (isset($category_id)) {				$results = $this->model_catalog_manufacturer->getManufacturersByCategory($category_id);				} else {					   	$results = $this->model_catalog_manufacturer->getManufacturers(0);		}					foreach($results as $result)
		{
			
				if ($result['image']) {
						$image = $result['image'];
					} else {
						$image = 'no_image.jpg';
					}
			//									$url = '';						if (isset($this->request->get['sort'])) {				$url .= '&sort=' . $this->request->get['sort'];			}			//ocshop			if (isset($this->request->get['manufacturer_filter'])) {				$url .= '&manufacturer_filter=' . $this->request->get['manufacturer_filter'];			}				//ocshop			if (isset($this->request->get['order'])) {				$url .= '&order=' . $this->request->get['order'];			}							if (isset($this->request->get['limit'])) {				$url .= '&limit=' . $this->request->get['limit'];			}			//						if (isset($this->request->get['path'])) {							$url  = $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url . '&manufacturer_filter=' . $result['manufacturer_id']);							} else {						$url=$this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id']);						}			
			$this->data['manufactureres'][] = array(
				'thumb' 			=> $this->model_tool_image->resize($image, 60, 60),
				'manufacturer_id'   => $result['manufacturer_id'],
				'name'        		=> $result['name'] ,
				'href'				=> $url
	
		
			);
		}
	
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/manufacturer.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/manufacturer.tpl';
		} else {
			$this->template = 'default/template/module/manufacturer.tpl';
		}
		
		$this->render();
  	}
}
?>