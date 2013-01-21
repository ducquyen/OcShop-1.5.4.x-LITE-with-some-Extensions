<?php
class ControllerModuleYaslider extends Controller {
	private $error = array(); 
	 
	public function index() {   
		$this->load->language('module/yaslider');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addStyle('view/stylesheet/yaslider.css');
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('yaslider', $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		
		//ocshop language
		$this->data['text_language_settings'] = $this->language->get('text_language_settings');
		$this->data['text_buy_button_text'] = $this->language->get('text_buy_button_text');
		$this->data['text_details_button_text'] = $this->language->get('text_details_button_text');
		$this->data['text_heading'] = $this->language->get('text_heading');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['help_title_yaslider'] = $this->language->get('help_title_yaslider');
		$this->data['text_products_settings'] = $this->language->get('text_products_settings');
		$this->data['text_search_products'] = $this->language->get('text_search_products');
		$this->data['help_search_products'] = $this->language->get('help_search_products');
		$this->data['text_selected_products'] = $this->language->get('text_selected_products');
		$this->data['text_description'] = $this->language->get('text_description');
		$this->data['help_description'] = $this->language->get('help_description');
		$this->data['text_image_width_height'] = $this->language->get('text_image_width_height');
		$this->data['help_image_width_height'] = $this->language->get('help_image_width_height');
		$this->data['text_slider_settings'] = $this->language->get('text_slider_settings');
		$this->data['text_slideshow_timeout'] = $this->language->get('text_slideshow_timeout');
		$this->data['help_slideshow_timeout'] = $this->language->get('help_slideshow_timeout');
		$this->data['text_slideshow_effect'] = $this->language->get('text_slideshow_effect');
		$this->data['text_randomize_slides'] = $this->language->get('text_randomize_slides');
		$this->data['text_slider_width_height'] = $this->language->get('text_slider_width_height');
		$this->data['help_slider_width_height'] = $this->language->get('help_slider_width_height');
		$this->data['text_slider_style'] = $this->language->get('text_slider_style');
		$this->data['text_slider_color'] = $this->language->get('text_slider_color');
		$this->data['text_slider_badge'] = $this->language->get('text_slider_badge');
		$this->data['text_position_settings'] = $this->language->get('text_position_settings');
		$this->data['help_slider_placed'] = $this->language->get('help_slider_placed');
		//end ocshop language
		
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
		$this->data['tab_module'] = $this->language->get('tab_module');
		
		$this->data['token'] = $this->session->data['token'];

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/yaslider', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/yaslider', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['modules'] = array();

		if (isset($this->request->post['yaslider_module'])) {
			$this->data['modules'] = $this->request->post['yaslider_module'];
		} elseif ($this->config->get('yaslider_module')) { 
			$this->data['modules'] = $this->config->get('yaslider_module');
		}	

		$this->load->model('catalog/product');
      
		// add product by its ID
    foreach ($this->data['modules'] as $module=>$info) {
         		$prods = explode(',', $info['products_ids']);
                        $this->data['modules'][$module]['products'] = array();

                        foreach ($prods as $product_id) {
         			$product_info = $this->model_catalog_product->getProduct($product_id);
         			if ($product_info) {
         				$this->data['modules'][$module]['products'][] = array(
         					'product_id' => $product_info['product_id'],
         					'name'       => $product_info['name']
         				);
         			}
         		}
       
    }

    // add slider effect
		$this->data['slider_effect'] = array();

    $this->data['slider_effect'][] = array(
			'effect' => 'scrollHorz',
			'title'  => $this->data['text_horizontal_scroll'] = $this->language->get('text_horizontal_scroll'),
		);
		$this->data['slider_effect'][] = array(
			'effect' => 'scrollVert',
			'title'  => $this->data['text_vertical_scroll'] = $this->language->get('text_vertical_scroll'),
		);
		$this->data['slider_effect'][] = array(
			'effect' => 'fade',
			'title'  => $this->data['text_fade_scroll'] = $this->language->get('text_fade_scroll'),
		);
		$this->data['slider_effect'][] = array(
			'effect' => 'zoom',
			'title'  => $this->data['text_zoom_scroll'] = $this->language->get('text_zoom_scroll'),
		);
		$this->data['slider_effect'][] = array(
			'effect' => 'uncover',
			'title'  => $this->data['text_uncover_scroll'] = $this->language->get('text_uncover_scroll'),
		);

		// add slider style
		$this->data['slider_style'] = array();

                $this->data['slider_style'][] = array(
			'style' => 'ys-style-default',
			'title' => $this->data['text_style_default'] = $this->language->get('text_style_default'),
		);
		$this->data['slider_style'][] = array(
			'style' => 'ys-style-bubble',
			'title' => $this->data['text_style_bubble'] = $this->language->get('text_style_bubble'),
		);
		
		// add slider color
		$this->data['slider_color'] = array();

                $this->data['slider_color'][] = array(
			'color' => 'ys-color-grey',
			'title' => $this->data['text_color_grey'] = $this->language->get('text_color_grey'),
		);
		$this->data['slider_color'][] = array(
			'color' => 'ys-color-blue',
			'title' => $this->data['text_color_blue'] = $this->language->get('text_color_blue'),
		);
		$this->data['slider_color'][] = array(
			'color' => 'ys-color-red',
			'title' => $this->data['text_color_red'] = $this->language->get('text_color_red'),
		);
		$this->data['slider_color'][] = array(
			'color' => 'ys-color-green',
			'title' => $this->data['text_color_green'] = $this->language->get('text_color_green'),
		);
		$this->data['slider_color'][] = array(
			'color' => 'ys-color-orange',
			'title' => $this->data['text_color_orange'] = $this->language->get('text_color_orange'),
		);
		$this->data['slider_color'][] = array(
			'color' => 'ys-color-black',
			'title' => $this->data['text_color_black'] = $this->language->get('text_color_black'),
		);

		// add slider badge
		$this->data['slider_badge'] = array();

                $this->data['slider_badge'][] = array(
			'badge' => 'ys-badge-no',
			'title' => $this->data['text_badge_no'] = $this->language->get('text_badge_no'),
		);
		$this->data['slider_badge'][] = array(
			'badge' => 'ys-badge-top',
			'title' => $this->data['text_badge_top'] = $this->language->get('text_badge_top'),
		);
		$this->data['slider_badge'][] = array(
			'badge' => 'ys-badge-new',
			'title' => $this->data['text_badge_new'] = $this->language->get('text_badge_new'),
		);
		$this->data['slider_badge'][] = array(
			'badge' => 'ys-badge-hot',
			'title' => $this->data['text_badge_hot'] = $this->language->get('text_badge_hot'),
		);
		$this->data['slider_badge'][] = array(
			'badge' => 'ys-badge-best',
			'title' => $this->data['text_badge_best'] = $this->language->get('text_badge_best'),
		);

		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		$this->template = 'module/yaslider.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/yaslider')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>