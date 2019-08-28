<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scrapper extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	require_once APPPATH . "third_party\support\web_browser.php";
	require_once APPPATH . "third_party\support\\tag_filter.php";

	// Retrieve the standard HTML parsing array for later use.
	$htmloptions = TagFilter::GetHTMLOptions();

	// Retrieve a URL (emulating Firefox by default).
	$url = "https://moving2canada.com/express-entry-draw/";
	$web = new WebBrowser();
	$result = $web->Process($url);

	// Check for connectivity and response errors.
	if (!$result["success"])
	{
		echo "Error retrieving URL.  " . $result["error"] . "\n";
		exit();
	}

	if ($result["response"]["code"] != 200)
	{
		echo "Error retrieving URL.  Server returned:  " . $result["response"]["code"] . " " . $result["response"]["meaning"] . "\n";
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
		if($j=='Draw'){
			$j = 'Date';
		}else if($j=='Date'){
			$j='Invitations';
		}else if($j=='Invitations'){
			$j='Points';
		}else if($j=='Points'){
			$j='Draw';
			$i++;
		}else if($j==''){
			$j='Draw';
		}
		if($i==0){
			$data[$i][$j] = $row->GetOuterHTML();
		}else if($data['0']['Draw']==$row->GetOuterHTML()){
			print_r($data);
			exit();
		}else{
			$data[$i][$j] = $row->GetOuterHTML();
		}
	}
	}
	public function test()
	{
		$this->load->view('welcome_message');
	}
}