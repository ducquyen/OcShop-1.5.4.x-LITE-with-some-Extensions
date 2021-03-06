<?php
class ModelModuleSeoManager extends Model {

	public function deleteUrlAlias($url_alias_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `url_alias_id` = '" . (int)$url_alias_id . "'");
		$this->cache->delete('seo_pro');
		$this->cache->delete('seo_url');
	}

	public function updateUrlAlias($data) {
		if($data['query'] == '') return false;
		if($data['url_alias_id'] != 0 ) {
			$this->db->query("UPDATE `" . DB_PREFIX . "url_alias` SET `query` = '" . $this->db->escape($data['query']) . "', `keyword` = '" . $data['keyword'] . "' WHERE `url_alias_id` = '" . (int)$data['url_alias_id'] . "'");
		} else {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "url_alias` SET 
				`query` = '" .  $this->db->escape($data['query']) . "', 
				`keyword` = '" . $this->db->escape($data['keyword']) . "',
				`seo_mod` = 1");
		}
		$this->cache->delete('seo_pro');
		$this->cache->delete('seo_url');
		return true;
	}
	
	// Get List URL Alias
	public function getUrlAaliases($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM `" . DB_PREFIX . "url_alias` ua WHERE ua.seo_mod = '1'";

			$sort_data = array('ua.query', 'ua.keyword');

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY ua.query";
			}

			if (isset($data['order']) && ($data['order'] == 'ASC')) {
				$sql .= " ASC";
			} else {
				$sql .= " DESC";
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

			return  $query->rows;
		} else {
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "url_alias` ua WHERE ua.seo_mod = '1' ORDER BY ua.query");
			return $query->rows;
		}
	}

	// Total Aliases
	public function getTotalUrlAalias() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "url_alias` WHERE `seo_mod` = '1';");
		return $query->row['total'];
	}

	// Install/Uninstall
	public function install() {
		$query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "url_alias` WHERE Field = 'seo_mod'");
		if(count($query->rows) == 0 ) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "url_alias` ADD COLUMN seo_mod INT(1) DEFAULT 0;");
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "url_alias` ADD INDEX (seo_mod);");
		}
		$this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `seo_mod` = 1;");
		$sql = array();
		$sql[] = "INSERT INTO `" . DB_PREFIX . "url_alias` (query, keyword, seo_mod) VALUES ('product/special', 'specials', 1);";
		$sql[] = "INSERT INTO `" . DB_PREFIX . "url_alias` (query, keyword, seo_mod) VALUES ('product/manufacturer', 'brands', 1);";
		$sql[] = "INSERT INTO `" . DB_PREFIX . "url_alias` (query, keyword, seo_mod) VALUES ('information/contact', 'contact-us', 1);";
		$sql[] = "INSERT INTO `" . DB_PREFIX . "url_alias` (query, keyword, seo_mod) VALUES ('information/sitemap', 'sitemap', 1);";
		
		foreach ($sql as $_sql) {
			$this->db->query($_sql);
		}
		$this->cache->delete('seo_pro');
		$this->cache->delete('seo_url');
		return TRUE;
	}

	public function uninstall() {
		$query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "url_alias` WHERE Field = 'seo_mod'");
		if(count($query->rows) == 1 ) {
			$this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `seo_mod` = 1;");
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "url_alias` DROP INDEX seo_mod;");
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "url_alias` DROP COLUMN `seo_mod`;");
		}
		
		$this->cache->delete('seo_pro');
		$this->cache->delete('seo_url');
		return TRUE;
	}

}
?>