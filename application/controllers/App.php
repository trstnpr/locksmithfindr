<?php

	class App extends CI_Controller {

		public function __construct()
        {
                parent::__construct();

                $this->load->helper('general');
                $this->load->helper('yellowpagesapi');
				$this->load->model('State_model');
				$this->load->model('City_model');
				$this->load->model('Page_model');
				$this->load->model('Configuration_model');
        }

		public function index($page = 'home') {

			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
				show_404();
			} else {

				
				$data['term'] = 'locksmith';
				$data['location'] = 'California';

				$yp = search($data['location']);
				$ypdata = $yp;
				$data['res_count'] = $ypdata['data']->searchResult->metaProperties->listingCount;

				if($data['res_count'] != 0) {
					$data['yp'] = $ypdata['data']->searchResult->searchListings->searchListing;
				} else {
					$data['yp'] = 0;
				}

				$data['title'] = the_config('site_title');
				// META
				$data['meta_title'] = the_config('meta_title');
				$data['meta_keyword'] = the_config('meta_keyword');
				$data['meta_description'] = the_config('meta_description');

				$popular_cities = $this->City_model->get_popular_city();
				
				$this->load->view('templates/header', $data);
				$this->load->view('pages/'.$page, $data);
				$this->load->view('templates/footer');
			}

		}

		public function states($page='states') {

			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
				show_404();
			} else {

				$data['title'] = 'Locksmiths by '.ucwords($page).' - '.the_config('site_name');

				$data['states'] = $this->State_model->get_states();
				$data['location'] = 'United States';

				$data['title'] = "Find Professional Locksmith Services by State - ".the_config('site_name');
				// META
				$data['meta_title'] = $data['title'];
				$data['meta_keyword'] = "";
				$data['meta_description'] = "LocksmithFindr helps you find locksmith experts in every State.";

				$this->load->view('templates/header', $data);
				$this->load->view('pages/'.$page, $data);
				$this->load->view('templates/footer');

			}
			
		}

		public function state($page = 'state') {

			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
				show_404();
			} else {

				$data['abbrev'] = $this->uri->segment(2, 0);

				$data['state_arr'] = $this->State_model->get_state_from_abbrev($data['abbrev']);

				if ($data['state_arr'] != 0) {

					$data['limit'] = 12;

					$data['city_count'] = count($this->City_model->get_city_from_state(strtolower($data['abbrev'])));

					// $data['cities'] = $this->City_model->get_few_cities_from_state(strtolower($data['abbrev']), $data['limit']);
					$data['cities'] = $this->City_model->get_city_from_state(strtolower($data['abbrev']));

					$data_state = $data['state_arr'][0];

					$rand_int = array_rand(range(1,12), 1);
					$data['banner_img'] = 'build/images/random/'.$rand_int.'.jpg';
					$data['ads_img'] = 'build/images/thumb-ad/'.$rand_int.'.jpg';

					$data['title'] = "Find Expert Locksmiths in ".$data_state->state." - ".the_config('site_name');
					// META
					$data['meta_title'] = $data['title'];
					$data['meta_keyword'] = "";
					$data['meta_description'] = "LocksmithFindr helps you find the most reliable locksmith companies in ".$data_state->state;
					
					$this->load->view('templates/header', $data);
					$this->load->view('pages/'.$page, $data);
					$this->load->view('templates/footer');
				} else {

					header('Location: '.base_url('states'));

				}
			}
		}

		public function city($page = 'city') {

			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
				show_404();
			} else {
				
				$slug = $this->uri->segment(2, 0);

				$city_data = $this->City_model->get_city_from_slug($slug);

				if($city_data != 0) {

					$data['city_data'] = $city_data[0];

					$city = $data['city_data']->name;

					$state_abbrev = strtoupper($data['city_data']->state);

					$state = $this->State_model->get_state_from_abbrev($state_abbrev);

					$data['state'] = $state[0];

					$data['location'] = $city.', '.$data['state']->abbrev;

					$location = 'location='.$data['city_data']->lat.','.$data['city_data']->lng;
					$keyword = preg_replace('/\s+/', '+', $data['location']);

					$data['yp'] = search($keyword);
					$ypdata = $data['yp'];
					$data['res_count'] = $ypdata['data']->searchResult->metaProperties->listingCount;


					if ($ypdata['result'] == 'success') {
						if($data['res_count'] != 0) {
							$results = $ypdata['data']->searchResult->searchListings->searchListing;
							$map_data = array();
							$hit = array();
							foreach($results as $yplace) {
								$map_data[] = '["'.addslashes($yplace->businessName).'", '.$yplace->latitude.', '.$yplace->longitude.']';

								if($yplace->city == $city) {
									$hit[] = 1;
								}
							}
							$data['map_data'] = $map_data;
							
							$exact = array_sum($hit).' Exact Results';
						}
					}

					$data['title'] = "Find 24 Hour Emergency Locksmiths in ".$city.", ".$state_abbrev." - ".the_config('site_name');
					// META
					$data['meta_title'] = $data['title'];
					$data['meta_keyword'] = "";
					$data['meta_description'] = "LocksmithFindr helps you find 24 hour emergency locksmiths in ".$city.", ".$state_abbrev;
					
					$this->load->view('templates/header', $data);
					$this->load->view('pages/'.$page, $data);
					$this->load->view('templates/footer');

				} else {

					show_404();

				}
			}			

		}

		public function zip($page = 'zip') {

			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
				show_404();
			} else {


				$data['zip'] = $this->uri->segment(2, 0);

				if(is_numeric($data['zip']) AND strlen($data['zip']) == 5) {

					$city_data = $this->City_model->get_city_from_zip($data['zip']);

					$data['city_data'] = $city_data[0];

					$data['state'] = $this->State_model->get_state_from_abbrev($data['city_data']->state)[0];

					$data['term'] = 'locksmith';
					$data['location'] = $data['city_data']->name.', '.strtoupper($data['city_data']->state).' '.$data['zip'];

					$location = 'location='.$data['city_data']->lat.','.$data['city_data']->lng;
					$keyword = preg_replace('/\s+/', '+', $data['location']);

					$data['yp'] = search($keyword);
					$ypdata = $data['yp'];
					$data['res_count'] = $ypdata['data']->searchResult->metaProperties->listingCount;

					if ($ypdata['result'] == 'success') {
						if($data['res_count'] != 0) {
							$results = $ypdata['data']->searchResult->searchListings->searchListing;
							$map_data = array();
							foreach($results as $yplace) {
								$map_data[] = '["'.addslashes($yplace->businessName).'", '.$yplace->latitude.', '.$yplace->longitude.']';
							}
							$data['map_data'] = $map_data;
						}
					}

					$data['title'] = "Find Reliable Locksmiths in ".$data['zip'].", ".strtoupper($data['city_data']->state)." - ".the_config('site_name');
					// META
					$data['meta_title'] = $data['title'];
					$data['meta_keyword'] = "";
					$data['meta_description'] = "LocksmithFindr helps you find competent locksmith experts in ".$data['zip'].", ".strtoupper($data['city_data']->state);
					
					$this->load->view('templates/header', $data);
					$this->load->view('pages/'.$page, $data);
					$this->load->view('templates/footer');

				} else {
					show_404();
				}
			}			

		}

		public function contactProcess() {

			$mdata = $this->input->post();

			$site_key = '6LcEcC4UAAAAAHMgDPR6k_58FCJteieQEtH101z3';
			$secret_key = '6LcEcC4UAAAAAHsoYXsx_zizGkR0jYMb53M-BEJ3';
			$site_verify = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$mdata['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR'];
			$response = file_get_contents($site_verify);
			$g_response = json_decode($response);

			if($g_response->success == 1) {

				$emailConfig = [
		            'protocol' => 'smtp', 
		            'smtp_host' => 'ssl://smtp.googlemail.com', 
		            'smtp_port' => 465, 
		            'smtp_user' => 'stevendaleohtylerr@gmail.com', 
		            'smtp_pass' => 'green5@123',
		            'mailtype' => 'html', 
		            'charset' => 'iso-8859-1'
		        ];

		        $from = [
		            'email' => $mdata['email'],
		            'name' => strtoupper($mdata['name']).' - '.the_config('site_name').' Contact Us'
		        ];
		       
		        // $to = array($mdata['email']);
		        $to = 'stevendaleohtylerr@gmail.com';
		        $subject = $mdata['subject'];
		      	$message = $mdata['message'];
		        $this->load->library('email', $emailConfig);
		        $this->email->set_newline("\r\n");
		        $this->email->from($from['email'], $from['name']);
		        $this->email->to($to);
		        $this->email->subject($subject);
		        $this->email->message($message);
		        if (!$this->email->send()) {
		            $response = json_encode(array('result' => 'error', 'message' => 'Oops! Please try again later.'));
		        } else {
		            $response = json_encode(array('result' => 'success', 'message' => 'Message successfully sent!'));
		        }

			} else {
				$response = json_encode(array('result' => 'error', 'message' => 'Invalid Captcha!'));
			}

	        echo $response;

		}


	}

