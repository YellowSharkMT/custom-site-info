<?php
add_action('init', array(new CSInfo_Admin_Hooks(), 'init'));

class CSInfo_Admin_Hooks{

    function init(){
		$CSInfo_Admin_Output = new CSInfo_Admin_Output();
		add_action('admin_init', array($CSInfo_Admin_Output, 'admin_styles'));
		add_action('admin_init', array($CSInfo_Admin_Output, 'admin_scripts'));
		add_action('admin_menu', array($CSInfo_Admin_Output, 'add_menu_pages'));
	}
}

class CSInfo_Admin_Output extends CSInfo_Template {
	function __construct($settings = array()){
		parent::__construct(array('echo'=>false));
	}

	function add_menu_pages() {
		add_menu_page('Site Info', 'Site Info', 'read', 'csinfo_home', array($this,'home'));
		add_submenu_page('csinfo_home', 'Style Guide', 'Style Guide', 'read', 'csinfo_style_guide', array($this, 'style_guide'));
	}

	function admin_styles(){
		wp_enqueue_style('csinfo_css',CSINFO_URL . '/css/admin.css');
		wp_enqueue_style('csinfo_jqui', '//code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css');
	}
	function admin_scripts(){
		wp_enqueue_script('jquery-ui-tabs',false,array('jquery,jquery-ui-core'));
		wp_enqueue_script('cssinfo_js',CSINFO_URL . '/js/admin.js',array('jquery-ui-tabs'));
	}

	function home(){
		echo $this->get_view('admin/home');
	}

	function style_guide(){
		echo $this->get_view('admin/style-guide');
	}

}
?>