<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Pages extends MX_Controller
{

    public function index($slug)
    {

        $this->load->model('pagesmodel');
        $data['content'] = $this->pagesmodel->get_fullnews($slug);

        if (empty($data['content'])) {
            show_404();
        }
        // permissions plugged in to grant or revoke acces depending on role of user
        $access = $data['content']['access'];
        if ($access == 0) {
            $permit = "canViewAll";
        } elseif ($access == 1) {
            $permit = "canViewMember";
        } elseif ($access == 2) {
            $permit = "canViewAdmin";
        } else {
            show_404();
        }

		if ($permit == "canViewAll") {
			
			$data['page_title'] = $data['content']['title'];
            $data['module'] = 'pages';
            $data['view_file'] = 'page_view';

            echo Modules::run('templates/main_site', $data);
			
			} else 
			
			{
				
        if (modules::run('permissions/isPermitted', $this->session->userdata("username"), $permit) == "permitted") {

            $data['page_title'] = $data['content']['title'];
            $data['module'] = 'pages';
            $data['view_file'] = 'page_view';

            echo Modules::run('templates/main_site', $data);

        } else {
            echo "You do not have required permissions to view this page.";

				}
			}
			
			
	}
	
	

}