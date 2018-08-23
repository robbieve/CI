<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Overview_model extends CI_model {



#-----------------------------------
 	 public function email_list(){
 	 	return $data = $this->db->select('*')
 	 	->from('email_delivery')
 	 	->get()
 	 	->result();
 	 }
#----------------------------------
	public function total_sms(){
		
 	 	$cus_result = $this->db->select("*")
	 	 	->from('custom_sms_info')
	 	 	->get()
	 	 	->num_rows();
	 	$auto = $this->db->select("*")
	 	 	->from('sms_delivery')
	 	 	->get()
	 	 	->num_rows();
	 	 	return $total = $cus_result+$auto;
			
	}	

	public function today_sms(){
		$cus_result = $this->db->select("*")
	 	 	->from('custom_sms_info')
	 	 	->like('sms_date_time',date("Y-m-d"))
	 	 	->get()
	 	 	->num_rows();
	 	$auto = $this->db->select("*")
	 	 	->from('sms_delivery')
	 	 	->like('delivery_date_time',date("Y-m-d"))
	 	 	->get()
	 	 	->num_rows();
	 	return $total = $cus_result+$auto;
	}

	public function coustom_sms(){
		return $cus_result = $this->db->select("*")
	 	 	->from('custom_sms_info')
	 	 	->get()
	 	 	->result();
	 	
	}	

	public function auto_sms(){
		return $auto = $this->db->select("*")
	 	 	->from('sms_delivery')
	 	 	->get()
	 	 	->result();
	 	 	
	}	
#----------------------------------	

	#------------------------------------#
	# count all patient
	#------------------------------------#	
 	 public function total_patient()
 	 {
 	 	return	$this->db->count_all_results('patient_tbl');
 	 }

 	 #--- get last 30 day patient 
 	 public function patient_30_day(){
 	 	$result = $this->db->select("*")
	 	 	->from('patient_tbl')
	 	 	->where('create_date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()')
	 	 	->get()->num_rows();
			return $result; 
 	 }
 	 #--- get last 15 day patient 
 	 public function patient_15_day(){
 	 	$result = $this->db->select("*")
	 	 	->from('patient_tbl')
	 	 	->where('create_date BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW()')
	 	 	->get()->num_rows();
			return $result; 
 	 }
 	 #--- get last 7 day patient
 	 public function patient_7_day(){
 	 	$result = $this->db->select("*")
	 	 	->from('patient_tbl')
	 	 	->where('create_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()')
	 	 	->get()->num_rows();
			return $result; 
 	 }

 	 #--- today patient
 	 public function today_patient(){
 	 	$date = date("Y-m-d");
 	 	$result = $this->db->select("*")
	 	 	->from('patient_tbl')
	 	 	->like('create_date',$date)
	 	 	->get()
	 	 	->result();

			return $result; 
 	 }

#-----------------------------------------------
 	 #--- today prescription 
 	 public function today_prescription(){
 	 	$date = date("Y-m-d");
		$this->db->select("prescription.*,patient_tbl.*");
        $this->db->from("prescription");
        $this->db->join('patient_tbl', 'patient_tbl.patient_id = prescription.patient_id '); 
        $this->db->where('prescription.doctor_id',$this->session->userdata('doctor_id'));
        $this->db->like('prescription.create_date_time',$date);
        $query = $this->db->get();
        $result = $query->result();
        return $result;	
			
 	 }

 	 #--- total prescription 
 	 public function total_prescription(){
 	 	$date = date("Y-m-d");
 	 	$result = $this->db->select("*")
	 	 	->from('prescription')
	 	 	->get()->num_rows();
			return $result; 
 	 }
#---------------------------------------------


 	 public function total_appointment()
 	 {
	 	 	$result = $this->db->select("*")
	 	 	->from('appointment_tbl')
	 	 	->get()->num_rows();
			return $result;
 	 }
#------------------------------------#
# count to_day_appointment
#------------------------------------#	
 	public function to_day_appointment()
 	{
	 	    $tow_day = date('Y-m-d');
			
              $result = $this->db->select("action_serial.*,doctor_tbl.*,
                  patient_tbl.*,
                  venue_tbl.*,")

                  ->from('action_serial')

                  ->join('patient_tbl', 'patient_tbl.patient_id = action_serial.patient_id')
                  
                  ->join('doctor_tbl', 'doctor_tbl.doctor_id = action_serial.doctor_id')
                  
                  ->join('venue_tbl', ' venue_tbl.venue_id = action_serial.venue_id')
                  ->like('action_serial.date',$tow_day)
                  ->get()
                  ->result();

          return $result; 
 	}



#------------------------------------#
# count to_day_get_appointment
#------------------------------------#	
 	 public function to_day_get_appointment()
 	 {
 	 	$tow_day = date('Y-m-d');
		 

              $result = $this->db->select("action_serial.*,doctor_tbl.*,
                  patient_tbl.*,
                  venue_tbl.*,")

                  ->from('action_serial')

                  ->join('patient_tbl', 'patient_tbl.patient_id = action_serial.patient_id')
                  
                  ->join('doctor_tbl', 'doctor_tbl.doctor_id = action_serial.doctor_id')
                  
                  ->join('venue_tbl', ' venue_tbl.venue_id = action_serial.venue_id')
                  ->like('action_serial.get_date_time',$tow_day)
                  ->get()
                  ->result(); 

          return $result; 
 	 }

#-------------------------------------
 	 public function last_30(){
 	 	$result = $this->db->select("*")
	 	 	->from('appointment_tbl')
	 	 	->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()')
	 	 	->get()->num_rows();
			return $result; 
 	    }

 	 public function last_15(){
 	 	$result = $this->db->select("*")
	 	 	->from('appointment_tbl')
	 	 	->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW()')
	 	 	->get()->num_rows();
			return $result; 
 	    } 

 	 public function last_7(){
 	 	$result = $this->db->select("*")
	 	 	->from('appointment_tbl')
	 	 	->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()')
	 	 	->get()->num_rows();
			return $result; 
 	    }       



} 	 