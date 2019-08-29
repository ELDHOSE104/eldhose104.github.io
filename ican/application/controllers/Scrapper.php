<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scrapper extends CI_Controller {
	public function __construct() {
	parent::__construct();
	$this->load->model('scrapper_model');
	}
	public function index()
	{
	require_once APPPATH . "third_party/support/web_browser.php";
	require_once APPPATH . "third_party/support/tag_filter.php";

	// Retrieve the standard HTML parsing array for later use.
	$htmloptions = TagFilter::GetHTMLOptions();

	// Retrieve a URL (emulating Firefox by default).
	$url = "https://moving2canada.com/express-entry-draw/";
	$web = new WebBrowser();
	$result = $web->Process($url);
	// Check for connectivity and response errors.
	if (!$result["success"])
	{
		// echo "Error retrieving URL.  " . $result["error"] . "\n";
		$data = $this->scrapper_model->get_draws();
		echo json_encode($data);
		exit();
	}

	if ($result["response"]["code"] != 200)
	{
		// echo "Error retrieving URL.  Server returned:  " . $result["response"]["code"] . " " . $result["response"]["meaning"] . "\n";
		$data = $this->scrapper_model->get_draws();
		echo json_encode($data);
		exit();
	}

	// Get the final URL after redirects.
	$baseurl = $result["url"];

	// Use TagFilter to parse the content.
	$html = TagFilter::Explode($result["body"], $htmloptions);

	// Retrieve a pointer object to the root node.
	$root = $html->Get();

	$rows = $root->Find("td");
	$i = 0;$j='';
	$data = array();
	foreach ($rows as $row)
	{
		// echo "\t" . $row->GetOuterHTML() . "\n\n";
		if($j=='draw'){
			$j = 'draw_date';
		}else if($j=='draw_date'){
			$j='invitations';
		}else if($j=='invitations'){
			$j='minimum_point';
		}else if($j=='minimum_point'){
			$j='draw';
			$i++;
		}else if($j==''){
			$j='draw';
		}
		if($i==0){
			$data[$i][$j] = $row->GetInnerHTML();
		}else if($data['0']['draw']==$row->GetInnerHTML()){
			$data = array_reverse($data);
			foreach ($data as $key ) {
				$key['draw'] = str_replace("<strong>","",$key['draw']);
				$key['draw'] = str_replace("</strong>","",$key['draw']);
				$count = $this->scrapper_model->insert($key);
				$draw_data[] = $key;
			}
			if($draw_data){
				$draw_data = array_reverse($draw_data);
				echo json_encode($draw_data);
			}else{
				$draw_data = $this->scrapper_model->get_draws();
				echo json_encode($draw_data);
			}
			die();
		}else{
			$data[$i][$j] = $row->GetInnerHTML();
		}
	}
	}
	public function last_draw()
	{
		$data = $this->scrapper_model->get_last_draw();
		echo json_encode($data);
	}
}