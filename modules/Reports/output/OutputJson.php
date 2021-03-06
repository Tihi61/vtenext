<?php

/* crmv@96742 */

require_once('modules/Reports/output/OutputArray.php');

/**
 *
 */
class ReportOutputJson extends ReportOutputArray {

	public function output($return = false) { // crmv@146653
		$jdata = array();
		$jdata['data'] = array();
		foreach ($this->data as $row) {
			$nrow = array();
			foreach ($row as $v) {
				$nrow[$v['column']] = $v;
			}
			$jdata['data'][] = $nrow;
		}
		$jdata['draw'] = intval($_REQUEST['draw']);
		$jdata['recordsTotal'] = $this->countTotal;
		$jdata['recordsFiltered'] = $this->countFiltered;
		
		return $jdata;
	}
	
}
