<?php
class ModelCatalogManufacturer extends Model {
	public function getManufacturer($manufacturer_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_description md ON (m.manufacturer_id = md.manufacturer_id) LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m.manufacturer_id = '" . (int)$manufacturer_id . "' AND md.language_id = '" . (int)$this->config->get('config_language_id') . "' AND m2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");
	
		return $query->row;	
	}
	
	public function getManufacturers($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_description md ON (m.manufacturer_id = md.manufacturer_id) LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND md.language_id = '" . (int)$this->config->get('config_language_id') . "'";
			
			$sort_data = array(
				'name',
				'sort_order'
			);	
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY name";	
			}
			
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}
			
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}	
			
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}				
					
			$query = $this->db->query($sql);
			
			return $query->rows;
		} else {
			$manufacturer_data = $this->cache->get('manufacturer.' . (int)$this->config->get('config_store_id') . '.' . (int)$this->config->get('config_language_id'));
		
			if (!$manufacturer_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_description md ON (m.manufacturer_id = md.manufacturer_id) LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND md.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY name");
	
				$manufacturer_data = $query->rows;
			
				$this->cache->set('manufacturer.' . (int)$this->config->get('config_store_id') . '.' . (int)$this->config->get('config_language_id'), $manufacturer_data);
			}
		 
			return $manufacturer_data;
		}	
	} 

	//ocshop
	public function getManufacturersByCategory($category_id) {
			$sql = "	SELECT DISTINCT m.manufacturer_id, m.name, m.image FROM oc_manufacturer m LEFT JOIN oc_manufacturer_description md ON (m.manufacturer_id = md.manufacturer_id) LEFT JOIN `oc_product` p ON (m.manufacturer_id = p.manufacturer_id) LEFT JOIN `oc_product_to_category` p2c ON (p.product_id= p2c.product_id)";
			$sql .= "	LEFT JOIN oc_manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m2s.store_id = '0' AND category_id = ". (int)$category_id . " AND md.language_id = '1' GROUP BY m.manufacturer_id ORDER BY m.name ASC";
					    
            $query = $this->db->query($sql);

			return $query->rows;
	
	}

	public function getManufacturersByCategories($category_ids) {
		if (is_array($category_ids) && count($category_ids) > 0){
			$category_ids = implode(",", $category_ids);
			$query = $this->db->query("SELECT m.manufacturer_id, m.name, COUNT(p.product_id) AS products_total FROM " . DB_PREFIX . "product_to_category AS pc LEFT JOIN " . DB_PREFIX . "product AS p ON p.product_id = pc.product_id LEFT JOIN " . DB_PREFIX . "manufacturer AS m ON m.manufacturer_id = p.manufacturer_id WHERE pc.category_id IN (".$category_ids.") AND p.status = 1 AND p.quantity > 0 GROUP BY m.manufacturer_id ORDER BY m.name ASC");
			return $query->rows;
		}
		return false;
	}
	//ocshop
	
	}
?>