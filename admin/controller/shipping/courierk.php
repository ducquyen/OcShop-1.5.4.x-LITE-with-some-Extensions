<?php

class ControllerShippingcourierk extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('shipping/courierk');

        //$this->document->title = $this->language->get('heading_title');
	  $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
            $this->model_setting_setting->editSetting('courierk', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect(HTTPS_SERVER . 'index.php?route=extension/shipping&token=' . $this->session->data['token']);
        }

        // установка языковых переменных
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_all_zones'] = $this->language->get('text_all_zones');
        $this->data['text_none'] = $this->language->get('text_none');

        $this->data['entry_tax'] = $this->language->get('entry_tax');
        $this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $this->data['entry_delivery_price'] = $this->language->get('entry_delivery_price');
        $this->data['entry_min_total_for_free_delivery'] = $this->language->get('entry_min_total_for_free_delivery');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        $this->data['tab_general'] = $this->language->get('tab_general');

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
       		'text'      => $this->language->get('text_shipping'),
			'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('shipping/courierk', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

        // ссылки для кнопок Сохранить и Отменить
        $this->data['action'] = HTTPS_SERVER . 'index.php?route=shipping/courierk&token=' . $this->session->data['token'];

        $this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/shipping&token=' . $this->session->data['token'];

        if (isset($this->request->post['courierk_min_total_for_free_delivery'])) {
            $this->data['courierk_min_total_for_free_delivery'] = $this->request->post['courierk_min_total_for_free_delivery'];
        } else {
            $this->data['courierk_min_total_for_free_delivery'] = $this->config->get('courierk_min_total_for_free_delivery');
        }

        if (isset($this->request->post['courierk_delivery_price'])) {
            $this->data['courierk_delivery_price'] = $this->request->post['courierk_delivery_price'];
        } else {
            $this->data['courierk_delivery_price'] = $this->config->get('courierk_delivery_price');
        }

        if (isset($this->request->post['courierk_geo_zone_id'])) {
            $this->data['courierk_geo_zone_id'] = $this->request->post['courierk_geo_zone_id'];
        } else {
            $this->data['courierk_geo_zone_id'] = $this->config->get('courierk_geo_zone_id');
        }

        if (isset($this->request->post['courierk_status'])) {
            $this->data['courierk_status'] = $this->request->post['courierk_status'];
        } else {
            $this->data['courierk_status'] = $this->config->get('courierk_status');
        }

        if (isset($this->request->post['courierk_sort_order'])) {
            $this->data['courierk_sort_order'] = $this->request->post['courierk_sort_order'];
        } else {
            $this->data['courierk_sort_order'] = $this->config->get('courierk_sort_order');
        }

        $this->load->model('localisation/geo_zone');

        $this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        $this->template = 'shipping/courierk.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'shipping/courierk')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>