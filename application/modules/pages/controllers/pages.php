<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Pages extends MX_Controller
{

/* major homepage of the app
redirects depending on user permission
and if modules is turned on or not
*/
public function home() 
    {

	$user = $this->session->userdata("username");
        if ($user != false) {
            if (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewMember") == "permitted") {
                redirect('/selfservice');
            } else if (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewAdmin") == "permitted") {
                redirect('/admin');
            }
        }
		
        $data['page_title'] = 'Armony';
        $data['module'] = 'pages';
        $data['view_file'] = 'main_page';

        echo Modules::run('templates/main_site', $data);
    }
	
	
	 public function admin()
    {
	
			Modules::run('login/is_logged_in');
			if (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewAdmin") != "permitted") {
            redirect('/');
			}
			

        $data['page_title'] = 'Administrator';
        $data['module'] = 'pages';
        $data['view_file'] = 'admin_area';

        echo Modules::run('templates/main_site', $data);
    }
	
	
	
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