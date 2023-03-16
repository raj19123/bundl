<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Files_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('string');
	}

	public function upload($file="", $config = array())
    {
        if( ($config) && (!empty($file)) ){
        	
        	$config['file_name'] = random_string('alnum', 10);

	        $this->load->library('upload', $config);
	        
	        if ( ! $this->upload->do_upload($file)){
	            return array('error' => $this->upload->display_errors());
	        }else{
	        	$user_id = isset($this->User) ? $this->User->id : '0';
	            $uploaded = $this->upload->data();
	            $file = array(
	            	'name' => $uploaded['file_name'],
	            	'type' => $uploaded['file_type'],
	            	'size' => $uploaded['file_size'],
	            	'created_by' => $user_id,
	            	'created_at' => date('Y-m-d H:i:s')
	            );
	            
	            $result = $this->db->insert('files', $file);
	            if($result){
	            	return array('id' => $this->db->insert_id());
	            }else{
	            	return array('error' => 'Database error: unable to update file detail in database.');
	            }
	        }
        }else{
        	return array('error' => 'Invalid data pass to upload!');
        }
    }

    public function multiUpload($field="", $config = array())
    {
        if( ($config) && (!empty($field)) ){
        	
	        $filesCount = count($_FILES[$field]['name']);
	        for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES[$field]['name'][$i];
                $_FILES['file']['type']     = $_FILES[$field]['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES[$field]['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES[$field]['error'][$i];
                $_FILES['file']['size']     = $_FILES[$field]['size'][$i];

                $config['file_name'] = random_string('alnum', 10);
	        	$this->load->library('upload', $config);
	        	$this->upload->initialize($config);
            
		        if ( ! $this->upload->do_upload('file')){
		            return array('error' => $this->upload->display_errors());
		        }else{
		        	$user_id = isset($this->User) ? $this->User->id : '0';
		            $uploaded = $this->upload->data();
		            $file = array(
		            	'name' => $uploaded['file_name'],
		            	'type' => $uploaded['file_type'],
		            	'size' => $uploaded['file_size'],
		            	'created_by' => $user_id,
		            	'created_at' => date('Y-m-d H:i:s')
		            );

		            //$vigo[] = array('id' => 'uploaded ' . $i, 'filesCount' => $filesCount);
		            
		            $result = $this->db->insert('files', $file);
		            if($result){
		            	$result_upload[] = $this->db->insert_id();
		            }else{
		            	$result_upload['error'] = 'Database error: unable to update file detail in database.';
		            }
		        }
	    	}
	    	return $result_upload;
        }else{
        	return array('error' => 'Invalid data pass to upload!');
        }
    }


    public function delete_by_name($fileName = "", $path="./uploads/icons/")
    {
    	if($fileName){
			$old_file_path = $path . $fileName;
			if(file_exists($old_file_path)){
	            unlink($old_file_path);
	            $result = $this->db->delete('files', ['name' => $fileName]);
				return ($result) ? true : false;
			}else{
				return false;
			}
    	}
    }

    public function delete_by_id($fileId = "", $path="./uploads/icons/")
    {
    	if($fileId){
    		$file = $this->db->get_where('files', ['id' => $fileId])->row_array();
    		$fileName = $file['name'];
			$old_file_path = $path . $fileName;
			if(file_exists($old_file_path)){
	            unlink($old_file_path);
	            $result = $this->db->delete('files', ['name' => $fileName]);
				return ($result) ? true : false;
			}else{
				return false;
			}
    	}
    }

    
    public function get_file_byName($name)
    {
        $this->db->select('*');
        $this->db->from('files');
        $this->db->where('name',$name);
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function file_size($size)
	{
		$bytes = (float)$size * 1024;
	    $unit=array('b','kb','mb','gb','tb','pb');
	    return round($bytes/pow(1024,($i=floor(log($bytes,1024)))),2).' '.$unit[$i];
	}
}