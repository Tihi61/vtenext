<?php

/* crmv@197423 */

namespace VteSyncLib\Connector\Vtiger\Model;

class Potentials extends GenericVtigerRecord {

	protected static $staticModule = 'Potentials';
	
	protected static $fieldMap = array(
		// Vtiger => CommonRecord
		'potentialname' => 'name',
		'related_to' => 'related_to',
		'campaignid' => 'campaignid',
		'sales_stage' => 'sales_stage',
		'closingdate' => 'closingdate',
		'amount' => 'amount',
		'probability' => 'probability',
		'opportunity_type' => 'type',
		'nextstep' => 'nextstep',
		'related_to' => 'related_to',
		'description' => 'description',
		
	);

	public static function extractId($data) {
		
		return $data['id'];
	}
	
	public static function extractOwner($data) {
		return $data['assigned_user_id'];
		
	}

	public static function extractCreatedTime($data) {
		$cDate = $data['createdtime'];
		$cDate = strtotime($cDate);
		$creationTime = new \DateTime();
		$creationTime->format('U = Y-m-d H:i:s.u');
		$creationTime->setTimestamp($cDate);
		return $creationTime;
	}
	
	public static function extractModifiedTime($data) {
		$date_data = $data['modifiedtime'];
		$date_data = strtotime($date_data);
		$modTime = new \DateTime();
		$modTime->format('U = Y-m-d H:i:s.u');
		$modTime->setTimestamp($date_data);
		return $modTime;
	}
	
	public static function extractEtag($data) {
		$lastmod = static::extractModifiedTime($data);
		$etag = strval($lastmod->getTimestamp().$lastmod->format('u'));
		return $etag;
	}
	
	public static function fromRawData($data) {
		
		$id = static::extractId($data);
		$ownerid = static::extractOwner($data);
		$creatTime = static::extractCreatedTime($data);
		$modTime = static::extractModifiedTime($data);
		$etag = static::extractEtag($data);	
				
			
		$owner = explode('x',$ownerid);
			
		$fields = array_intersect_key($data, static::$fieldMap);
		
		
		$record = new static(static::$staticModule, $id, $etag, $fields);
		$record->owner = $owner[1];
		$record->rawData = $data;
		$record->createdTime = $creatTime;
		$record->modifiedTime = $modTime;
		return $record;
	}
	
	// if needed, you can override methods and change fields/behaviour
}


